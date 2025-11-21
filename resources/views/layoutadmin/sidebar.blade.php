<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('adminlte/adminlte/dist/img/logo_fotustudio-removebg-preview.png') }}"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">FANESYA PHOTO</span>
    </a>

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

                <!-- Account -->
                <li class="nav-item">
                    <a href="/profil"
                       class="nav-link {{ ($slug == 'profil') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Account</p>
                    </a>
                </li>

                <!-- Pesanan -->
                <li class="nav-item">
                    <a href="/mahasiswa"
                       class="nav-link {{ ($slug == 'mahasiswa') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Pesanan</p>
                    </a>
                </li>

                <!-- CreatePaket -->
                <li class="nav-item">
                    <a href="/prodi"
                       class="nav-link {{ ($slug == 'prodi') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Create Paket</p>
                    </a>
                </li>

                <!-- Buyer -->
                <li class="nav-item">
                    <a href="/buyer"
                       class="nav-link {{ ($slug == 'buyer') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>Buyer</p>
                    </a>
                </li>
            
                <li class="nav-item">
                <a href="/settings"
                class="nav-link {{ ($slug == 'setting') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>Settings</p>
                </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>