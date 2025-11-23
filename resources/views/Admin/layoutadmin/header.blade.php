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