<?php
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
use Illuminate\Support\Facades\DB;
$input = json_decode(file_get_contents($argv[1]), true, 512, JSON_THROW_ON_ERROR);
$prefix = 'XLS-'.substr($input['sha256'], 0, 16).'-';
if (DB::table('pemasukan')->where('no_kwitansi', 'like', $prefix.'%')->exists() || DB::table('pengeluaran')->where('no_tanda_terima', 'like', $prefix.'%')->exists()) {
    throw new RuntimeException('Workbook already imported');
}
$backup = [];
foreach (['bank', 'kategori_transaksi', 'pemasukan', 'pengeluaran'] as $table) {
    $backup[$table] = DB::table($table)->get();
}
$backupFile = storage_path('app/private/backups/before-import-'.date('Ymd-His').'.json');
if (file_put_contents($backupFile, json_encode($backup, JSON_THROW_ON_ERROR)) === false) { throw new RuntimeException('Backup failed'); }
$report = DB::transaction(function () use ($input, $prefix) {
    $bankIds = $coaIds = $counts = $expected = $unmapped = $classification = [];
    foreach (config('finance-import.display_banks') as $name) {
        $bankIds[$name] = DB::table('bank')->where('nama', $name)->value('id') ?? DB::table('bank')->insertGetId(['nama'=>$name]);
    }
    foreach (config('finance-import.coa') as $type => $rules) {
        foreach ($rules as [$code, $name, $pattern]) {
            $existing = DB::table('kategori_transaksi')->where('kode', $code)->first();
            if ($existing && ($existing->kategori !== $name || $existing->jenis_kategori !== strtoupper($type))) { throw new RuntimeException('COA conflict: '.$code); }
            $coaIds[$code] = $existing->id ?? DB::table('kategori_transaksi')->insertGetId(['kode'=>$code, 'kategori'=>$name, 'jenis_kategori'=>strtoupper($type), 'stt_fix'=>0]);
        }
    }
    foreach ($input['transactions'] as $item) {
        $type = $item['type'];
        $name = config('finance-import.banks')[$item['code']] ?? '';
        $bankIds[''] = 0;
        if ($name === '') { $unmapped[$item['code'] ?: '(kosong)'] = ($unmapped[$item['code'] ?: '(kosong)'] ?? 0) + 1; }
        foreach (config('finance-import.coa')[$type] as [$code, $category, $pattern]) {
            if (preg_match($pattern, strtoupper($item['description']))) { break; }
        }
        $classification[$code] = ($classification[$code] ?? 0) + 1;
        DB::table($type)->insert([
            'tanggal'=>$item['date'], 'nominal'=>$item['amount'], 'id_bank'=>$bankIds[$name],
            'id_kategori_transaksi'=>$coaIds[$code], 'id_metode_bayar'=>$item['code'] === 'PC' ? 1 : 2,
            'keterangan'=>$item['description']."\n[Sumber: ".$input['file'].' | '.$input['sheet'].' baris '.$item['row'].' | TR CODE: '.($item['code'] ?: '(kosong)').']',
            'lampiran'=>'', ($type === 'pemasukan' ? 'no_kwitansi' : 'no_tanda_terima')=>$prefix.$item['row'],
        ]);
        $counts[$type] = ($counts[$type] ?? 0) + 1;
        [$whole, $cents] = explode('.', $item['amount']);
        $expected[$type][$bankIds[$name]] = ($expected[$type][$bankIds[$name]] ?? 0) + (int)$whole * 100 + (int)$cents;
    }
    foreach ($expected as $type=>$banks) {
        foreach ($banks as $bankId=>$cents) {
            $actual = DB::table($type)->where($type === 'pemasukan' ? 'no_kwitansi' : 'no_tanda_terima', 'like', $prefix.'%')->where('id_bank', $bankId)->sum('nominal');
            if ((int)round((float)$actual * 100) !== $cents) { throw new RuntimeException('Reconciliation failed'); }
        }
    }
    return ['counts'=>$counts, 'unmapped'=>$unmapped, 'classification'=>$classification, 'reconciliation'=>'passed', 'skipped'=>$input['issues'], 'warnings'=>$input['warnings'], 'sha256'=>$input['sha256']];
});
$path = storage_path('app/private/imports/cash-import-report.json');
file_put_contents($path, json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR));
echo json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE).PHP_EOL;
