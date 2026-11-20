<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class FinanceScopeTest extends TestCase
{
    public function test_guests_are_sent_to_login(): void
    {
        $this->get('/')->assertRedirect(route('login'));
        $this->get('/admin/keuangan/pemasukan')->assertRedirect(route('login'));
        $this->get('/admin/keuangan/dashboard')->assertRedirect(route('login'));
        $this->get('/hutang/sisa-bayar/1')->assertRedirect(route('login'));
        $this->get('/piutang/sisa-bayar/1')->assertRedirect(route('login'));
    }

    public function test_only_finance_modules_are_registered(): void
    {
        foreach (['pemasukan.index', 'pengeluaran.index', 'hutang.index', 'piutang.index',
            'mutasi-saldo.index', 'kategori-transaksi.index', 'laporan-arus-kas.index',
            'keuangan-retensi.index', 'bank-transaksi.index', 'finance.dashboard'] as $name) {
            $this->assertTrue(Route::has($name), $name);
        }
        foreach (['homepage', 'customer.index', 'akad.index', 'public.siteplan.index',
            'pengajuan-hold.index', 'beranda.index', 'dashboard.index'] as $name) {
            $this->assertFalse(Route::has($name), $name);
        }
        $this->get('/booking')->assertNotFound();
        $this->get('/homepage')->assertNotFound();
    }

    public function test_home_opens_finance_dashboard(): void
    {
        $this->actingAs(new User(['id' => 1]))
            ->get('/')->assertRedirect(route('finance.dashboard'));
    }
}
