@extends('Admin.layoutadmin.main')

@section('css')
<!-- Plugin CSS tambahan -->
<link rel="stylesheet" href="{{ asset('adminlte/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/adminlte/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/adminlte/plugins/summernote/summernote-bs4.min.css') }}">
<style>
    .stat-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    .stat-icon {
        font-size: 2.5rem;
        opacity: 0.8;
        transition: transform 0.3s ease;
    }
    .stat-card:hover .stat-icon {
        transform: scale(1.1);
    }
    .progress-sm {
        height: 6px;
    }
    .chat-card, .profile-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
    }
    .chat-card:hover, .profile-card:hover {
        transform: translateY(-3px);
    }
    .badge-status {
        font-size: 0.75rem;
        padding: 4px 8px;
        border-radius: 20px;
    }
    .direct-chat-messages {
        height: 300px;
        overflow-y: auto;
    }
    .chart-container {
        position: relative;
        height: 350px;
    }
    .welcome-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
    }
    .welcome-text {
        font-size: 1.5rem;
        font-weight: 300;
    }
    .date-time {
        font-size: 0.9rem;
        opacity: 0.9;
    }
</style>
@endsection

@section('content')
<!-- Welcome Banner -->
<div class="row">
    <div class="col-12">
        <div class="welcome-banner">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="welcome-text">Selamat Datang, {{ Auth::guard('admin')->user()->name }}!</h3>
                    <p class="mb-0 date-time" id="currentDateTime">{{ now()->format('l, d F Y H:i') }}</p>
                </div>
                <div class="col-md-4 text-right">
                    <i class="fas fa-camera fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info stat-card">
            <div class="inner">
                <h3>120</h3>
                <p>Total Booking</p>
                <div class="progress progress-sm mt-2">
                    <div class="progress-bar bg-white" style="width: 75%"></div>
                </div>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-check stat-icon"></i>
            </div>
            <a href="/admin/orders" class="small-box-footer">Lihat semua booking <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success stat-card">
            <div class="inner">
                <h3>8</h3>
                <p>Booking Hari Ini</p>
                <div class="progress progress-sm mt-2">
                    <div class="progress-bar bg-white" style="width: 45%"></div>
                </div>
            </div>
            <div class="icon">
                <i class="fas fa-camera-retro stat-icon"></i>
            </div>
            <a href="/admin/orders/today" class="small-box-footer">Lihat jadwal hari ini <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning stat-card">
            <div class="inner">
                <h3>45</h3>
                <p>Pelanggan Terdaftar</p>
                <div class="progress progress-sm mt-2">
                    <div class="progress-bar bg-white" style="width: 60%"></div>
                </div>
            </div>
            <div class="icon">
                <i class="fas fa-users stat-icon"></i>
            </div>
            <a href="/admin/buyers" class="small-box-footer">Lihat data pelanggan <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger stat-card">
            <div class="inner">
                <h3>3</h3>
                <p>Pembayaran Pending</p>
                <div class="progress progress-sm mt-2">
                    <div class="progress-bar bg-white" style="width: 25%"></div>
                </div>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill-wave stat-icon"></i>
            </div>
            <a href="/admin/payments/pending" class="small-box-footer">Cek pembayaran <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<!-- Main row -->
<div class="row">
    <!-- Left col: Statistik Booking -->
    <section class="col-lg-8 connectedSortable">
        <div class="card card-primary recent-orders-card">
            <div class="card-header border-bottom-0">
                <h3 class="card-title">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Statistik Booking Bulanan
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="chart-container">
                    <canvas id="bookingChart"></canvas>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Row: Recent Orders & Pesan Pelanggan (sebelah-sebelahan) -->
<div class="row">
    <section class="col-lg-6 connectedSortable">
        <!-- Recent Orders -->
        <div class="card card-info recent-orders-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-shopping-cart mr-2"></i>
                    Recent Orders
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="bg-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Package</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>#001</strong></td>
                                <td>John Doe</td>
                                <td>Premium Wedding</td>
                                <td>2024-01-15</td>
                                <td><span class="badge badge-success badge-status">Completed</span></td>
                            </tr>
                            <tr>
                                <td><strong>#002</strong></td>
                                <td>Jane Smith</td>
                                <td>Family Portrait</td>
                                <td>2024-01-14</td>
                                <td><span class="badge badge-warning badge-status">Pending</span></td>
                            </tr>
                            <tr>
                                <td><strong>#003</strong></td>
                                <td>Mike Johnson</td>
                                <td>Graduation</td>
                                <td>2024-01-13</td>
                                <td><span class="badge badge-info badge-status">In Progress</span></td>
                            </tr>
                            <tr>
                                <td><strong>#004</strong></td>
                                <td>Sarah Wilson</td>
                                <td>Maternity</td>
                                <td>2024-01-12</td>
                                <td><span class="badge badge-primary badge-status">Confirmed</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="/admin/orders" class="btn btn-sm btn-outline-info">View All Orders</a>
            </div>
        </div>
    </section>

    <section class="col-lg-6 connectedSortable">
        <!-- Pesan Pelanggan -->
        <div class="card direct-chat direct-chat-primary chat-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-comments mr-2"></i>
                    Pesan Pelanggan Terbaru
                </h3>
                <div class="card-tools">
                    <span class="badge badge-primary">3 Pesan Baru</span>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="direct-chat-messages">
                    <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-left">Rina Pratiwi</span>
                            <span class="direct-chat-timestamp float-right">13 Nov 09:20</span>
                        </div>
                        <img class="direct-chat-img" src="{{ asset('adminlte/adminlte/dist/img/user3-128x128.jpg') }}" alt="User Image">
                        <div class="direct-chat-text">
                            Kak, bisa booking paket family untuk hari Minggu?
                        </div>
                    </div>

                    <div class="direct-chat-msg right">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-right">Admin Studio</span>
                            <span class="direct-chat-timestamp float-left">13 Nov 09:25</span>
                        </div>
                        <img class="direct-chat-img" src="{{ asset('adminlte/adminlte/dist/img/user1-128x128.jpg') }}" alt="Admin Image">
                        <div class="direct-chat-text">
                            Bisa kak, slot jam 10 masih tersedia ya 
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="card-footer">
                <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    <span class="input-group-append">
                        <button type="button" class="btn btn-primary">Send</button>
                    </span>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Row: Admin Profile -->
<div class="row">
    <section class="col-lg-12 connectedSortable">
        <div class="card profile-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user mr-2"></i>
                    Admin Profile
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <p><strong><i class="fas fa-user-circle mr-2 text-primary"></i>Name:</strong> {{ Auth::guard('admin')->user()->name }}</p>
                                <p><strong><i class="fas fa-envelope mr-2 text-warning"></i>Email:</strong> {{ Auth::guard('admin')->user()->email }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p><strong><i class="fas fa-user-tag mr-2 text-success"></i>Role:</strong> Administrator</p>
                                <p><strong><i class="fas fa-clock mr-2 text-info"></i>Last Login:</strong> {{ now()->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="border rounded p-3 bg-light">
                            <i class="fas fa-shield-alt fa-2x text-primary mb-2"></i>
                            <p class="mb-0"><small>Account Status: <span class="text-success">Active</span></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('javascript')
<script src="{{ asset('adminlte/adminlte/plugins/chart.js/Chart.min.js') }}"></script>
<script>
    // Update real-time datetime
    function updateDateTime() {
        const now = new Date();
        const options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        };
        document.getElementById('currentDateTime').textContent = now.toLocaleDateString('id-ID', options);
    }
    
    setInterval(updateDateTime, 60000);
    updateDateTime();

    // Chart initialization
    const ctx = document.getElementById('bookingChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Jumlah Booking',
                data: [15, 25, 20, 30, 28, 35, 40, 38, 32, 28, 35, 42],
                backgroundColor: 'rgba(23, 162, 184, 0.8)',
                borderColor: 'rgba(23, 162, 184, 1)',
                borderWidth: 1,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    display: false 
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    padding: 12,
                    cornerRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    },
                    ticks: {
                        stepSize: 10
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endsection