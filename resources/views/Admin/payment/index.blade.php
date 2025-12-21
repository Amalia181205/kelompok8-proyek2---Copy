@extends('Admin.layoutadmin.main')

@section('title', 'Cek Pembayaran')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-header bg-success">
            <h3 class="card-title text-white mb-0">
                <i class="fas fa-money-check-alt mr-2"></i> Cek Pembayaran
            </h3>
        </div>

        <div class="card-body p-0">
            @if($payments->isEmpty())
                <div class="text-center py-4">
                    <p class="text-muted mb-0">Belum ada data pembayaran</p>
                </div>
            @else
                <table class="table table-bordered table-sm mb-0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Paket</th>
                            <th>Jumlah</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $i => $p)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td><strong>{{ $p->order_id }}</strong></td>
                                <td>{{ $p->booking->user->name ?? '-' }}</td>
                                <td>{{ ucfirst($p->booking->package_name ?? '-') }}</td>
                                <td class="text-right">
                                    Rp {{ number_format($p->gross_amount, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    {{ strtoupper($p->metode ?? '-') }}
                                </td>
                                <td class="text-center">
                                    @if($p->status === 'paid')
                                        <span class="badge badge-success">Paid</span>
                                    @elseif($p->status === 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($p->status === 'cancelled')
                                        <span class="badge badge-danger">Cancelled</span>
                                    @else
                                        <span class="badge badge-secondary">{{ ucfirst($p->status) }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ $p->created_at->format('d M Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</div>
@endsection
