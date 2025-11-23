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
                <a href="#" class="d-block text-white">{{ Auth::guard('admin')->user()->name ?? 'Administrator' }}</a>
                <small class="text-light">Administrator</small>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/orders" class="nav-link {{ request()->is('admin/orders') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Orders</p>
                        <span class="badge badge-info right">5</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/packages" class="nav-link {{ request()->is('admin/packages') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-camera"></i>
                        <p>Packages</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/buyers" class="nav-link {{ request()->is('admin/buyers') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Buyers</p>
                    </a>
                </li>
            
                <li class="nav-item">
                    <a href="/admin/gallery" class="nav-link {{ request()->is('admin/gallery') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-images"></i>
                        <p>Gallery</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/settings" class="nav-link {{ request()->is('admin/settings') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>