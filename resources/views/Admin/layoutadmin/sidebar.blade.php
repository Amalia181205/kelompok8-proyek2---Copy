<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link text-center">
        <img src="{{ asset('adminlte/adminlte/dist/img/logo_fotustudio-removebg-preview.png') }}"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-bold" style="color: #495057;">FANESYA PHOTO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="/dashboard"
                       class="nav-link {{ ($slug == 'dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Pesanan -->
                <li class="nav-item">
                    <a href="/pesanan"
                       class="nav-link {{ ($slug == 'orders') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Orders</p>
                    </a>
                </li>

                <!-- CreatePaket -->
                <li class="nav-item">
                    <a href="/createpaket"
                       class="nav-link {{ ($slug == 'paket') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-camera"></i>
                        <p>Create Paket</p>
                    </a>
                </li>

                <!-- Buyer -->
                <li class="nav-item">
                    <a href="/buyers"
                       class="nav-link {{ ($slug == 'buyers') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Buyers</p>
                    </a>
                </li>
            
                <!-- Settings -->
                <li class="nav-item">
                    <a href="/settings"
                    class="nav-link {{ ($slug == 'setting') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>Settings</p>
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" 
                       class="nav-link text-danger"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>