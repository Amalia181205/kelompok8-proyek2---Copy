<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('png/logo_fotustudio-removebg-preview.png') }}" alt="Logo" width="60" class="me-2">
        </a>

        <!-- Tombol toggle untuk mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Isi Navbar -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Search Bar -->
            <form action="{{ url('/search') }}" method="GET" class="d-flex ms-auto" style="width: 300px;">
                <input class="form-control me-2" type="search" name="query" placeholder="Cari sesuatu...">
                <button class="btn btn-outline-primary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            <!-- Menu Navigasi -->
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}" style="color:#1eaae9;">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/shop') }}" style="color: #1eaae9;">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/gallery') }}" style="color: #1eaae9;">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}" style="color:#1eaae9;">Contact</a></li>
                
                <!-- User Section -->
                @auth
                <li class="nav-item dropdown ms-3">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false" style="color:#1eaae9;">
                        👤 {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/profile">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ url('/payment/history') }}">Riwayat Ahmed cekout bahan sus</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ url('/logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item ms-3">
                    <a href="{{ url('/auth') }}" class="nav-link" style="color:#1eaae9;">
                        <i class="bi bi-person-circle fs-5"></i> Login
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>