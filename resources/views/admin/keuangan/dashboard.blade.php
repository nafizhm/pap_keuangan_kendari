@extends('admin.layout_admin')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1>Dashboard Keuangan</h1>
                <p class="text-muted mt-2 mb-0">Saldo berdasarkan seluruh pemasukan dikurangi pengeluaran, termasuk saldo awal yang diimpor.</p>
                @if ($period->start)
                    <small class="text-muted">Periode data {{ \Carbon\Carbon::parse($period->start)->format('d/m/Y') }} – {{ \Carbon\Carbon::parse($period->end)->format('d/m/Y') }}</small>
                @endif
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                @if ($withoutBank > 0)
                    <div class="alert alert-info">
                        {{ $withoutBank }} transaksi memiliki rekening kosong. Nominalnya termasuk dalam total, tetapi tidak masuk saldo rekening mana pun.
                    </div>
                @endif
                <div class="row">
                    @foreach (['saldo' => ['Total Saldo', 'bg-primary'], 'pemasukan' => ['Total Pemasukan', 'bg-success'], 'pengeluaran' => ['Total Pengeluaran', 'bg-danger']] as $key => [$label, $color])
                        <div class="col-lg-4 col-md-6">
                            <div class="small-box {{ $color }}">
                                <div class="inner">
                                    <p>{{ $label }}</p>
                                    <h3 style="font-size: clamp(1.2rem, 2vw, 1.8rem);">Rp {{ number_format($summary[$key], 2, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <h2 class="h5 mb-3">Saldo per Bank / Kas</h2>
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 50px;">No</th>
                                        <th scope="col">Bank / Kas</th>
                                        <th scope="col" class="text-right">Pemasukan</th>
                                        <th scope="col" class="text-right">Pengeluaran</th>
                                        <th scope="col" class="text-right">Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($banks as $bank)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <th scope="row" class="font-weight-normal">
                                                {{ $bank->nama }}
                                                @if ($bank->no_rek)<small class="d-block text-muted">{{ $bank->no_rek }}</small>@endif
                                            </th>
                                            <td class="text-right text-nowrap">Rp {{ number_format($bank->pemasukan, 2, ',', '.') }}</td>
                                            <td class="text-right text-nowrap">Rp {{ number_format($bank->pengeluaran, 2, ',', '.') }}</td>
                                            <td class="text-right text-nowrap font-weight-bold {{ $bank->saldo < 0 ? 'text-danger' : 'text-success' }}">Rp {{ number_format($bank->saldo, 2, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="text-center text-muted">Belum ada rekening bank atau kas.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
