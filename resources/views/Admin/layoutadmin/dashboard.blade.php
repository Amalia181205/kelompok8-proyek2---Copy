@extends('Admin.layoutadmin.main')

@section('title', 'Dashboard Admin')

@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<style>
    .welcome-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
    }
    .badge-status {
        font-size: 0.75rem;
        padding: 4px 8px;
        border-radius: 12px;
    }
    .chart-container {
        position: relative;
        height: 320px;
    }
</style>
@endsection

@section('content')

{{-- WELCOME --}}
<div class="row">
    <div class="col-12">
        <div class="welcome-banner d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-1">Selamat Datang, {{ Auth::guard('admin')->user()->name }}</h4>
                <small id="currentDateTime">{{ now()->translatedFormat('l, d F Y H:i') }}</small>
            </div>
            <i class="fas fa-camera fa-3x opacity-50"></i>
        </div>
    </div>
</div>

{{-- STAT BOX --}}
<div class="row">

    <div class="col-lg-4 col-md-6 col-12 mb-4">
        <div class="small-box bg-info h-100">
            <div class="inner text-center">
                <h3>{{ $totalBooking }}</h3>
                <p>Total Booking</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <a href="{{ url('/admin/orders') }}" class="small-box-footer">
                Lihat semua booking <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-4">
        <div class="small-box bg-success h-100">
            <div class="inner text-center">
                <h3>{{ $todayBooking }}</h3>
                <p>Booking Hari Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-day"></i>
            </div>
            <a href="{{ route('admin.schedule.index') }}" class="small-box-footer">
                Lihat jadwal hari ini <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-md-12 col-12 mb-4">
        <div class="small-box bg-danger h-100">
            <div class="inner text-center">
                <h3>{{ $pendingPayment }}</h3>
                <p>Pembayaran Pending</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <a href="{{ route('admin.payment.index') }}" class="small-box-footer">
                Cek pembayaran <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>

{{-- CHART --}}
<div class="row">
    <div class="col-lg-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-bar mr-2"></i> Statistik Booking Bulanan
                </h3>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="bookingChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CHAT PESAN PELANGGAN --}}
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card direct-chat direct-chat-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-comments mr-2"></i>
                    Pesan Pelanggan Terbaru
                </h3>
                <div class="card-tools">
                    <span class="badge badge-primary">{{ $messages->count() }} Pesan</span>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="direct-chat-messages" style="height:300px;">
                    @forelse($messages as $msg)
                        <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-left">
                                    {{ $msg->name }}
                                </span>
                                <span class="direct-chat-timestamp float-right">
                                    {{ $msg->created_at->format('d M H:i') }}
                                </span>
                            </div>

                            <img class="direct-chat-img"
                                 src="{{ asset('adminlte/adminlte/dist/img/user3-128x128.jpg') }}"
                                 alt="User">

                            <div class="direct-chat-text">
                                {{ $msg->message }}
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted mt-3">
                            Belum ada pesan masuk
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>


{{-- RECENT ORDERS --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-shopping-cart mr-2"></i> Recent Orders
                </h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="bg-light text-center">
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Paket</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr class="text-center">
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? '-' }}</td>
                            <td>{{ $order->package_name ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->booking_date)->format('d M Y') }}</td>
                            <td>
                                @if($order->status === 'confirmed')
                                    <span class="badge badge-success badge-status">Confirmed</span>
                                @elseif($order->status === 'cancelled')
                                    <span class="badge badge-danger badge-status">Cancelled</span>
                                @else
                                    <span class="badge badge-warning badge-status">Pending</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">
                                Belum ada order
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script src="{{ asset('adminlte/adminlte/plugins/chart.js/Chart.min.js') }}"></script>

<script>
    const bookingData = @json(
        collect(range(1,12))->map(fn($m) => $bookingStats[$m] ?? 0)
    );

    const ctx = document.getElementById('bookingChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
            datasets: [{
                data: bookingData,
                backgroundColor: 'rgba(23,162,184,0.8)',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false }},
            scales: { y: { beginAtZero: true } }
        }
    });

    function updateDateTime() {
        document.getElementById('currentDateTime')
            .innerText = new Date().toLocaleString('id-ID');
    }
    setInterval(updateDateTime, 60000);
</script>
@endsection
