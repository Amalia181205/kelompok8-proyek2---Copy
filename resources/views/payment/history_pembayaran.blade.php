@extends('bagianAwal.main')

@section('title', 'Riwayat Pembayaran')

@section('content')

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary m-0">
            <i class="bi bi-receipt"></i> Riwayat Transaksi
        </h3>
        <a href="/" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            @if(empty($payments) || $payments->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-file-earmark-text display-4 text-muted"></i>
                    <p class="mt-3 text-muted">Belum ada transaksi.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>Tanggal</th>
                                <th>Booking ID</th>
                                <th>Paket</th>
                                <th>Jumlah</th>
                                <th>Metode</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $p)
                                <tr>
                                    <td>{{ $p->created_at->format('d M Y H:i') }}</td>
                                    <td>#{{ $p->booking->id }}</td>
                                    <td>{{ ucfirst($p->booking->package_name) }}</td>
                                    <td class="fw-bold text-success">
                                        {{-- PERBAIKAN DI SINI: gunakan gross_amount bukan amount --}}
                                        Rp {{ number_format($p->gross_amount, 0, ',', '.') }}
                                    </td>
                                    <td>{{ strtoupper($p->metode ?? '-') }}</td>
                                    <td>
                                        @if($p->status === 'paid')
                                            <span class="badge bg-success px-3 py-2">Paid</span>
                                        @else
                                            <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('payment.receipt', $p->id) }}" 
                                        class="btn btn-sm btn-outline-primary"
                                        target="_blank">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection