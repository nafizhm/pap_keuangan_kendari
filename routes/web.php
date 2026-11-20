<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Keuangan\HutangController;
use App\Http\Controllers\Keuangan\DashboardKeuanganController;
use App\Http\Controllers\Keuangan\KwitansiController;
use App\Http\Controllers\Keuangan\KategoriTransaksiController;
use App\Http\Controllers\Keuangan\LaporanArusKasController;
use App\Http\Controllers\Keuangan\MutasiSaldoController;
use App\Http\Controllers\Keuangan\PemasukanController;
use App\Http\Controllers\Keuangan\PengeluaranController;
use App\Http\Controllers\Keuangan\PiutangController;
use App\Http\Controllers\Keuangan\RetensiController as KeuanganRetensiController;
use App\Http\Controllers\Master\BankTransaksiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (! Auth::check()) {
        return redirect()->route('login');
    }
    return redirect()->route('finance.dashboard');
})->name('finance.home');
Route::middleware('guest')->group(function () {
    Route::get('admin/login', [AuthController::class, 'getLogin'])->name('login');
    Route::post('admin/post-login', [AuthController::class, 'postLogin'])->name('admin.loginPost');
});
Route::middleware('auth')->group(function () {
    Route::get('admin/keuangan/dashboard', DashboardKeuanganController::class)->name('finance.dashboard');
    Route::prefix('admin/keuangan')->group(function () {
        Route::get('/laporan-arus-kas/filter', [LaporanArusKasController::class, 'filter'])->name('laporan-arus-kas.filter');
        Route::get('laporan-arus-kas/export-pdf', [LaporanArusKasController::class, 'exportPdf'])->name('laporan-arus-kas.exportPDF');
        Route::get('laporan-arus-kas/export-excel', [LaporanArusKasController::class, 'exportExcel'])->name('laporan-arus-kas.exportExcel');

        Route::get('pemasukan/{id}/cetak', [KwitansiController::class, 'pemasukan'])->name('pemasukan.cetak');
        Route::get('pengeluaran/{id}/kwitansi', [KwitansiController::class, 'pengeluaran'])->name('pengeluaran.kwitansi');
        Route::resource('pemasukan', PemasukanController::class);
        Route::get('pengeluaran/{id}/cetak', [PengeluaranController::class, 'cetak'])->name('pengeluaran.cetak');
        Route::resource('pengeluaran', PengeluaranController::class);
        Route::resource('hutang', HutangController::class);
        Route::resource('piutang', PiutangController::class);
        Route::resource('kategori-transaksi', KategoriTransaksiController::class);
        Route::resource('mutasi-saldo', MutasiSaldoController::class);
        Route::resource('laporan-arus-kas', LaporanArusKasController::class);
        Route::get('retensi', [KeuanganRetensiController::class, 'index'])->name('keuangan-retensi.index');
    });
    Route::prefix('admin/master')->group(function () {
        Route::resource('bank-transaksi', BankTransaksiController::class);
        Route::get('bank/data/list', [BankTransaksiController::class, 'getBankList'])->name('bank.list');
    });
    Route::get('/hutang/sisa-bayar/{id}', [HutangController::class, 'getSisaBayar']);
    Route::get('/piutang/sisa-bayar/{id}', [PiutangController::class, 'getSisaBayar']);
    Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
});
Route::get('/refresh-csrf', fn () => response()->json(['token' => csrf_token()]))->name('refresh.csrf');
