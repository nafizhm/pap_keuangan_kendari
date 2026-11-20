<?php

// Read-only integration check. Does not submit transactions or change database data.
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
config(['session.driver' => 'array', 'cache.default' => 'array']);

try {
    Illuminate\Support\Facades\DB::connection()->getPdo();
    echo "Database connection: OK\n";
    $user = App\Models\User::where('status', '!=', 'BLOKIR')->firstOrFail();
    Illuminate\Support\Facades\Auth::login($user);
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $paths = ['/admin/keuangan/pemasukan', '/admin/keuangan/pengeluaran',
        '/admin/keuangan/hutang', '/admin/keuangan/piutang',
        '/admin/keuangan/kategori-transaksi', '/admin/keuangan/mutasi-saldo',
        '/admin/keuangan/laporan-arus-kas', '/admin/keuangan/retensi',
        '/admin/master/bank-transaksi'];
    $failed = false;
    foreach ($paths as $path) {
        $response = $kernel->handle(Illuminate\Http\Request::create($path));
        echo $response->getStatusCode()." $path\n";
        $failed = $failed || $response->getStatusCode() !== 200;
    }
    exit($failed ? 1 : 0);
} catch (Throwable $error) {
    fwrite(STDERR, get_class($error).': '.$error->getMessage()."\n");
    exit(1);
}
