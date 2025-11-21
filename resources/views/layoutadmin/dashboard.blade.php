@extends('layoutadmin.main')

@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/adminlte/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/adminlte/plugins/summernote/summernote-bs4.min.css') }}">
@endsection

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>120</h3>
                <p>Total Booking</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <a href="#" class="small-box-footer">Lihat semua booking <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>8</h3>
                <p>Booking Hari Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-camera-retro"></i>
            </div>
            <a href="#" class="small-box-footer">Lihat jadwal hari ini <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>45</h3>
                <p>Pelanggan Terdaftar</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">Lihat data pelanggan <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>3</h3>
                <p>Pembayaran Pending</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <a href="#" class="small-box-footer">Cek pembayaran <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-7 connectedSortable">
        <!-- Statistik Booking -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-bar mr-1"></i>
                    Statistik Booking Bulanan
                </h3>
            </div>
            <div class="card-body">
                <canvas id="bookingChart" style="height: 300px;"></canvas>
            </div>
        </div>

        <!-- Pesan Pelanggan -->
        <div class="card direct-chat direct-chat-primary">
            <div class="card-header">
                <h3 class="card-title">Pesan Pelanggan Terbaru</h3>
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
        </div>

        <!-- Agenda Pemotretan -->
        <div class="card">
            <div class="card-header bg-gradient-warning">
                <h3 class="card-title"><i class="fas fa-clipboard-list mr-1"></i> Agenda Pemotretan</h3>
            </div>
            <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                    <li>
                        <span class="handle"><i class="fas fa-ellipsis-v"></i><i class="fas fa-ellipsis-v"></i></span>
                        <span class="text">Prewedding - Andi & Rina (10.00 WIB)</span>
                        <small class="badge badge-success"><i class="far fa-clock"></i> Hari Ini</small>
                    </li>
                    <li>
                        <span class="handle"><i class="fas fa-ellipsis-v"></i><i class="fas fa-ellipsis-v"></i></span>
                        <span class="text">Graduation - SMAN 1 Indramayu</span>
                        <small class="badge badge-warning"><i class="far fa-clock"></i> Besok</small>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Right col -->
    <section class="col-lg-5 connectedSortable">
        <!-- Kalender -->
        <div class="card bg-gradient-success">
            <div class="card-header border-0">
                <h3 class="card-title"><i class="far fa-calendar-alt"></i> Kalender Booking</h3>
            </div>
            <div class="card-body pt-0">
                <div id="calendar" style="width: 100%"></div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('javascript')

<script src="{{ asset('adminlte/adminlte/plugins/chart.js/Chart.min.js') }}"></script>
<script>
    // Contoh data chart booking
    const ctx = document.getElementById('bookingChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Jumlah Booking',
                data: [15, 25, 20, 30, 28, 35],
                backgroundColor: '#17a2b8'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: false }
            }
        }
    });


</script>

@endsection