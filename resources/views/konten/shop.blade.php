@extends('bagianAwal.main')

@section('title', 'Shop - FotoStudio')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Paket Foto Studio</h1>
    
    @if(isset($hasDatabaseData) && $hasDatabaseData)
        <p class="text-center text-success mb-5">
            <i class="fas fa-check-circle"></i> Menampilkan paket premium dari database
        </p>
    @else
        <p class="text-center text-info mb-5">
            <i class="fas fa-info-circle"></i> Menampilkan paket standar kami
        </p>
    @endif

    @if(count($packages) > 0)
    <div class="row">
        @foreach($packages as $key => $package)
        <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                
                <!-- Badge -->
                @if(isset($package['is_dummy']) && $package['is_dummy'])
                <span class="position-absolute top-0 start-0 m-2 badge bg-info">Standard</span>
                @else
                <span class="position-absolute top-0 start-0 m-2 badge bg-success">Premium</span>
                @endif

                <!-- Gambar -->
                <div class="card-img-top" style="height: 200px; overflow: hidden;">
                    <img src="{{ $package['image'] }}" 
                         alt="{{ $package['title'] }}" 
                         class="w-100 h-100 object-fit-cover"
                         onerror="this.src='{{ asset('png/default.jpg') }}'">
                </div>

                <!-- Card Body -->
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $package['title'] }}</h5>
                    
                    <!-- Info Tambahan -->
                    @if(isset($package['duration']) || isset($package['photo_count']))
                    <div class="mb-2 small text-muted">
                        @if(isset($package['duration']))
                        <span><i class="fas fa-clock"></i> {{ $package['duration'] }} jam</span>
                        @endif
                        @if(isset($package['photo_count']))
                        <span class="ms-2"><i class="fas fa-camera"></i> {{ $package['photo_count'] }} foto</span>
                        @endif
                    </div>
                    @endif
                    
                    <!-- Deskripsi -->
                    <p class="card-text text-muted small mb-3" style="min-height: 40px;">
                        {{ Str::limit(strip_tags($package['description']), 80) }}
                    </p>
                    
                    <!-- Harga -->
                    <div class="mt-auto">
                        <h4 class="text-primary">{{ $package['price'] }}</h4>
                        
                        <!-- Tombol -->
                        <div class="d-grid mt-3">
                            @if(isset($package['is_dummy']) && $package['is_dummy'])
                            <a href="{{ route('booking.show-static', str_replace('dummy_', '', $key)) }}" 
                               class="btn btn-primary btn-sm">
                                <i class="fas fa-calendar-plus me-1"></i> Booking
                            </a>
                            @else
                            <a href="{{ route('booking.package', $package['db_id'] ?? 0) }}" 
                               class="btn btn-success btn-sm">
                                <i class="fas fa-star me-1"></i> Booking Premium
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-5">
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
            <h4>Data tidak ditemukan</h4>
            <p class="mb-0">Silakan hubungi admin untuk informasi lebih lanjut.</p>
        </div>
    </div>
    @endif
    
    <!-- Debug Info (Hapus di production) -->
    @if(app()->environment('local'))
    <div class="mt-5 p-3 bg-light rounded">
        <h6>Debug Info:</h6>
        <p>Jumlah paket: {{ count($packages) }}</p>
        <p>Has DB Data: {{ $hasDatabaseData ? 'Ya' : 'Tidak' }}</p>
    </div>
    @endif
</div>

<style>
    .card {
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .badge {
        font-size: 0.7rem;
        padding: 4px 8px;
    }
</style>
@endsection