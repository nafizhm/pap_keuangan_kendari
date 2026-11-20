<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardKeuanganController extends Controller
{
    public function __invoke()
    {
        $income = DB::table('pemasukan')->selectRaw('id_bank, SUM(nominal) as total')->groupBy('id_bank');
        $expenses = DB::table('pengeluaran')->selectRaw('id_bank, SUM(nominal) as total')->groupBy('id_bank');
        $banks = DB::table('bank')
            ->leftJoinSub($income, 'income', 'income.id_bank', '=', 'bank.id')
            ->leftJoinSub($expenses, 'expenses', 'expenses.id_bank', '=', 'bank.id')
            ->select('bank.id', 'bank.nama', 'bank.no_rek')
            ->selectRaw('COALESCE(income.total, 0) as pemasukan, COALESCE(expenses.total, 0) as pengeluaran')
            ->selectRaw('COALESCE(income.total, 0) - COALESCE(expenses.total, 0) as saldo')
            ->orderBy('bank.nama')->get()
            ->filter(fn ($bank) => $bank->pemasukan != 0 || $bank->pengeluaran != 0
                || in_array($bank->nama, config('finance-import.display_banks', [])))->values();
        $summary = [
            'pemasukan' => DB::table('pemasukan')->sum('nominal'),
            'pengeluaran' => DB::table('pengeluaran')->sum('nominal'),
        ];
        $summary['saldo'] = $summary['pemasukan'] - $summary['pengeluaran'];
        $withoutBank = DB::table('pemasukan')->where('id_bank', 0)->count()
            + DB::table('pengeluaran')->where('id_bank', 0)->count();
        $period = DB::query()->fromSub(
            DB::table('pemasukan')->select('tanggal')->unionAll(DB::table('pengeluaran')->select('tanggal')),
            'dates'
        )->selectRaw('MIN(tanggal) as start, MAX(tanggal) as end')->first();

        return view('admin.keuangan.dashboard', compact('banks', 'summary', 'period', 'withoutBank'));
    }
}
