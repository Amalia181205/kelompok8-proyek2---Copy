<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Fanesya Photo</title>

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
            --secondary-blue: #00b3aa;
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
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light navbar-blue">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/admin/dashboard" class="nav-link text-white">Home</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link text-white" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i>
                    <span class="d-none d-md-inline">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">Admin Profile</span>
                    <div class="dropdown-divider"></div>
                    <a href="/admin/profile" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i> My Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="/admin/logout" class="dropdown-item" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                    <form id="logout-form" action="/admin/logout" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-blue">
        <!-- Brand Logo -->
        <a href="/admin/dashboard" class="brand-link text-center">
            <i class="fas fa-camera brand-image img-circle elevation-3"></i>
            <span class="brand-text font-weight-light">FANESYA ADMIN</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <i class="fas fa-user-shield img-circle elevation-2"></i>
                </div>
                <div class="info">
                    <a href="#" class="d-block text-white">{{ Auth::guard('admin')->user()->name }}</a>
                    <small class="text-light">Administrator</small>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="/admin/dashboard" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/orders" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Orders</p>
                            <span class="badge badge-info right">5</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/packages" class="nav-link">
                            <i class="nav-icon fas fa-camera"></i>
                            <p>Packages</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/buyers" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Buyers</p>
                        </a>
                    </li>
                
                    <li class="nav-item">
                        <a href="/admin/gallery" class="nav-link">
                            <i class="nav-icon fas fa-images"></i>
                            <p>Gallery</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/settings" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>Settings</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>156</h3>
                                <p>Total Orders</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <a href="/admin/orders" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53</h3>
                                <p>New Users</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="/admin/buyers" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>44</h3>
                                <p>Photo Sessions</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-camera"></i>
                            </div>
                            <a href="/admin/packages" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>
                                <p>Gallery Items</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-images"></i>
                            </div>
                            <a href="/admin/gallery" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Main row -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-blue">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-bar mr-1"></i>
                                    Recent Orders
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
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
                                                <td>#001</td>
                                                <td>John Doe</td>
                                                <td>Premium Wedding</td>
                                                <td>2024-01-15</td>
                                                <td><span class="badge badge-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>#002</td>
                                                <td>Jane Smith</td>
                                                <td>Family Portrait</td>
                                                <td>2024-01-14</td>
                                                <td><span class="badge badge-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>#003</td>
                                                <td>Mike Johnson</td>
                                                <td>Graduation</td>
                                                <td>2024-01-13</td>
                                                <td><span class="badge badge-info">In Progress</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-gradient-info">
                                <h3 class="card-title text-white">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Quick Stats
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        Pending Orders
                                        <span class="badge badge-warning">3</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        Completed This Month
                                        <span class="badge badge-success">28</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        New Customers
                                        <span class="badge badge-info">12</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        Revenue This Month
                                        <span class="badge badge-primary">$5,240</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-user mr-1"></i>
                                    Admin Profile
                                </h3>
                            </div>
                            <div class="card-body">
                                <p><strong>Name:</strong> {{ Auth::guard('admin')->user()->name }}</p>
                                <p><strong>Email:</strong> {{ Auth::guard('admin')->user()->email }}</p>
                                <p><strong>Role:</strong> Administrator</p>
                                <p><strong>Last Login:</strong> {{ now()->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2024 <a href="#">Fanesya Photo Studio</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>
</div>

<!-- jQuery -->
<script src="{{ asset('adminlte/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/adminlte/dist/js/adminlte.min.js') }}"></script>

</body>
</html>