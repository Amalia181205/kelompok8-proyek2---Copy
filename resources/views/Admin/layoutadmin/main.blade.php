<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') - Fanesya Photo</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/adminlte/dist/css/adminlte.min.css') }}">

    <!-- Custom Styles -->
    <style>
        :root {
            --primary-blue: #007bff;
            --secondary-blue: #0056b3;
            --light-blue: #e3f2fd;
            --dark-blue: #004085;
        }
        
        .brand-link {
            background-color: var(--dark-blue);
        }
        
        .sidebar-blue {
            background-color: var(--dark-blue) !important;
        }
        
        .sidebar-blue .nav-link {
            color: white !important;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-blue .nav-link:hover {
            background-color: var(--primary-blue) !important;
        }
        
        .sidebar-blue .nav-link.active {
            background-color: var(--primary-blue) !important;
        }
        
        .navbar-blue {
            background-color: var(--primary-blue) !important;
        }
        
        .card-blue {
            border-left: 4px solid var(--primary-blue);
        }
    </style>

    @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('layoutadmin.header')

    @include('layoutadmin.sidebar')

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title', 'Dashboard')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">@yield('title', 'Dashboard')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>

    @include('layoutadmin.footer')

</div>

<!-- jQuery -->
<script src="{{ asset('adminlte/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/adminlte/dist/js/adminlte.min.js') }}"></script>

@yield('javascript')
</body>
</html>