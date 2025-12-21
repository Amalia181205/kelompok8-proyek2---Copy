@extends('Admin.layoutadmin.main')

@section('title', 'Orders')

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Orders List</h3>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover" id="ordersTable">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Booking ID</th>
                        <th>Paket</th>
                        <th>Total</th>
                        <th>Metode</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td>#{{ $order->booking->id }}</td>
                        <td>{{ ucfirst($order->booking->package_name) }}</td>
                        <td class="fw-bold text-success">
                            Rp {{ number_format($order->gross_amount, 0, ',', '.') }}
                        </td>
                        <td>{{ strtoupper($order->metode) }}</td>
                        <td>
                            @if($order->status === 'paid')
                                <span class="badge bg-success">Paid</span>
                            @elseif($order->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-danger">Failed</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
