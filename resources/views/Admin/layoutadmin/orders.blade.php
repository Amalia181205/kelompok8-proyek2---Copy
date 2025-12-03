@extends('Admin.layoutadmin.main') 
@section('title', 'Orders Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Card -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Orders List</h3>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped" id="ordersTable">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Total Price</th>
                                <th>Payment Method</th>
                                <th>Payment Status</th>
                                <th>Order Status</th>
                                <th>Notes</th>
                                <th>Barcode</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->booking_id }}</td>
                                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>{{ $order->payment_method ?? '-' }}</td>
                                <td>
                                    @if($order->payment_status == 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @else
                                        <span class="badge bg-warning">Unpaid</span>
                                    @endif
                                </td>
                                <td>
                                    @if($order->order_status == 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @elseif($order->order_status == 'processing')
                                        <span class="badge bg-info">Processing</span>
                                    @elseif($order->order_status == 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @else
                                        <span class="badge bg-secondary">Pending</span>
                                    @endif
                                </td>
                                <td>{{ $order->notes ?? '-' }}</td>
                                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col -->
    </div> <!-- /.row -->
</div> <!-- /.container-fluid -->
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#ordersTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@endsection
