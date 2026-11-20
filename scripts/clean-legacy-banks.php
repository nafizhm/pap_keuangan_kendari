<?php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

// Legacy account IDs were inspected before this cleanup. Do not infer BNI's destination.
$names = [1 => 'REKENING GIRO BANK BTN', 4 => 'PATTY CASH', 8 => 'REKENING GIRO BRI', 7 => 'MANDIRI'];
if (isset($argv[1])) {
    if (!in_array($argv[1], config('finance-import.display_banks'), true)) {
        throw new RuntimeException('BNI destination must be an existing current account name');
    }
    $names[6] = $argv[1];
}
$columns = DB::select("SELECT TABLE_NAME,COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND COLUMN_NAME IN ('id_bank','id_bank_tujuan','rekening_asal','rekening_tujuan')");
$result = DB::transaction(function () use ($names, $columns) {
    $backup = ['bank' => DB::table('bank')->lockForUpdate()->get()->toArray(), 'relations' => []];
    foreach ($columns as $column) {
        $rows = DB::table($column->TABLE_NAME)->whereIn($column->COLUMN_NAME, array_keys($names))->lockForUpdate()->get();
        $backup['relations'][$column->TABLE_NAME.'.'.$column->COLUMN_NAME] = $rows->toArray();
    }
    $path = storage_path('app/private/backups/before-bank-cleanup-'.date('Ymd-His').'.json');
    if (file_put_contents($path, json_encode($backup, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR)) === false) {
        throw new RuntimeException('Backup failed');
    }
    $report = [];
    foreach ($names as $oldId => $targetName) {
        $old = DB::table('bank')->where('id', $oldId)->first();
        if (!$old) { continue; }
        $expectedName = [1=>'BTN',4=>'CASH',8=>'BRI',7=>'MANDIRI',6=>'BNI'][$oldId];
        if ($old->nama !== $expectedName) { throw new RuntimeException('Legacy ID/name mismatch'); }
        $newId = DB::table('bank')->where('nama', $targetName)->whereNotIn('id', [1,4,6,7,8])->value('id');
        if (!$newId) { $newId = DB::table('bank')->insertGetId(['nama'=>$targetName, 'no_rek'=>null, 'pemilik_rek'=>null]); }
        $updates = [];
        foreach ($columns as $column) {
            $count = DB::table($column->TABLE_NAME)->where($column->COLUMN_NAME, $oldId)->update([$column->COLUMN_NAME=>$newId]);
            if ($count) { $updates[$column->TABLE_NAME.'.'.$column->COLUMN_NAME] = $count; }
        }
        foreach ($columns as $column) {
            if (DB::table($column->TABLE_NAME)->where($column->COLUMN_NAME, $oldId)->exists()) {
                throw new RuntimeException('Remaining legacy relation');
            }
        }
        DB::table('bank')->where('id', $oldId)->delete();
        $report[] = ['old'=>$old->nama, 'current'=>$targetName, 'id'=>$newId, 'relations'=>$updates];
    }
    return ['backup'=>$path, 'changes'=>$report];
});
echo json_encode($result, JSON_PRETTY_PRINT).PHP_EOL;
