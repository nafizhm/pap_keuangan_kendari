<?php

namespace Tests\Feature;

use App\Http\Controllers\Keuangan\DashboardKeuanganController;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class FinanceDashboardTest extends TestCase
{
    public function test_balances_keep_bank_identity_and_decimal_amounts(): void
    {
        Schema::create('bank', function (Blueprint $table) {
            $table->id(); $table->string('nama'); $table->string('no_rek')->nullable();
        });
        foreach (['pemasukan', 'pengeluaran'] as $name) {
            Schema::create($name, function (Blueprint $table) {
                $table->id(); $table->integer('id_bank'); $table->decimal('nominal', 20, 2); $table->date('tanggal');
            });
        }
        DB::table('bank')->insert([
            ['id'=>1, 'nama'=>'PATTY CASH'], ['id'=>3, 'nama'=>'REKENING GIRO BANK MANDIRI'],
        ]);
        DB::table('pemasukan')->insert([
            ['id_bank'=>1, 'nominal'=>'150.25', 'tanggal'=>'2026-01-01'],
            ['id_bank'=>0, 'nominal'=>'40.10', 'tanggal'=>'2026-01-02'],
        ]);
        DB::table('pengeluaran')->insert(['id_bank'=>1, 'nominal'=>'50.05', 'tanggal'=>'2026-01-03']);
        $data = (new DashboardKeuanganController)()->getData();
        $this->assertEqualsWithDelta(140.30, $data['summary']['saldo'], 0.001);
        $this->assertEqualsWithDelta(100.20, $data['banks']->firstWhere('id', 1)->saldo, 0.001);
        $this->assertEqualsWithDelta(0, $data['banks']->firstWhere('id', 3)->saldo, 0.001);
        $this->assertSame(1, $data['withoutBank']);
        $this->assertCount(2, $data['banks']);
        $this->assertSame('2026-01-01', $data['period']->start);
        $this->assertSame('2026-01-03', $data['period']->end);
    }
}
