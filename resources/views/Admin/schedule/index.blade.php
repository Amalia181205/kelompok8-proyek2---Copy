@extends('Admin.layoutadmin.main')

@section('title', 'Jadwal Booking')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="card-title text-white mb-0">
                <i class="fas fa-calendar-alt mr-2"></i> Jadwal Booking
            </h3>
        </div>

        <div class="card-body p-0">
            @if($bookings->isEmpty())
                <div class="text-center py-4">
                    <p class="text-muted mb-0">Belum ada jadwal booking</p>
                </div>
            @else
                <table class="table table-bordered table-sm mb-0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th>Tanggal</th>
                            <th>Customer</th>
                            <th>Paket</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $b)
                            <tr>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($b->booking_date)->format('d M Y') }}
                                </td>
                                <td>
                                    {{ $b->user->name ?? '-' }}
                                </td>
                                <td>
                                    {{ ucfirst($b->package_name) }}
                                </td>
                                <td class="text-center">
                                    @if($b->status === 'confirmed')
                                        <span class="badge badge-success">Confirmed</span>
                                    @elseif($b->status === 'cancelled')
                                        <span class="badge badge-danger">Cancelled</span>
                                    @else
                                        <span class="badge badge-secondary">Pending</span>
                                    @endif
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
