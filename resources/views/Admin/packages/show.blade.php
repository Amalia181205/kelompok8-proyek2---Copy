<!-- resources/views/admin/packages/show.blade.php -->
@extends('admin.layoutadmin.main')

@section('css')
<style>
    :root {
        --primary-blue: #1eaae9;
        --dark-blue: #0d8bc4;
        --light-blue: #e3f4fc;
    }
    
    .package-show-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .package-header {
        background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
        color: white;
        padding: 25px;
        border-radius: 10px 10px 0 0;
    }
    
    .package-header h1 {
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .package-category {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 15px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
    }
    
    .package-content {
        background: white;
        padding: 30px;
        border-radius: 0 0 10px 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    
    .package-image {
        width: 100%;
        height: 350px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .no-image {
        height: 350px;
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #6c757d;
    }
    
    .no-image i {
        font-size: 4rem;
        margin-bottom: 15px;
    }
    
    .info-section {
        margin-bottom: 30px;
    }
    
    .info-section-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .info-card {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid var(--primary-blue);
    }
    
    .info-label {
        font-size: 0.9rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }
    
    .info-value {
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
    }
    
    .price-card {
        background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
        color: white;
    }
    
    .price-label {
        color: rgba(255, 255, 255, 0.9);
    }
    
    .price-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: white;
    }
    
    .description-box {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        line-height: 1.6;
        color: #333;
    }
    
    .features-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .feature-tag {
        background: var(--light-blue);
        color: var(--dark-blue);
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .meta-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-top: 30px;
    }
    
    .meta-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    
    .meta-label {
        color: #6c757d;
        font-weight: 500;
    }
    
    .meta-value {
        color: #333;
    }
    
    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
    }
    
    .btn-edit {
        background: var(--primary-blue);
        border: none;
        color: white;
        padding: 12px 25px;
        border-radius: 5px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
    }
    
    .btn-edit:hover {
        background: var(--dark-blue);
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .btn-toggle {
        background: #ffc107;
        border: none;
        color: #212529;
        padding: 12px 25px;
        border-radius: 5px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
    }
    
    .btn-toggle:hover {
        background: #e0a800;
        color: #212529;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .btn-delete {
        background: #dc3545;
        border: none;
        color: white;
        padding: 12px 25px;
        border-radius: 5px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
    }
    
    .btn-delete:hover {
        background: #c82333;
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .btn-back {
        background: #6c757d;
        border: none;
        color: white;
        padding: 12px 25px;
        border-radius: 5px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
    }
    
    .btn-back:hover {
        background: #5a6268;
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 15px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .status-active {
        background: #28a745;
        color: white;
    }
    
    .status-inactive {
        background: #6c757d;
        color: white;
    }
    
    @media (max-width: 768px) {
        .package-show-container {
            padding: 10px;
        }
        
        .package-content {
            padding: 20px;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-edit,
        .btn-toggle,
        .btn-delete,
        .btn-back {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<div class="package-show-container">
    <!-- Package Header -->
    <div class="package-header">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
            <div>
                <h1>{{ $package->name }}</h1>
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <span class="package-category">
                        <i class="fas fa-{{ $package->category == 'wedding' ? 'ring' : 
                                      ($package->category == 'family' ? 'users' : 
                                      ($package->category == 'graduation' ? 'graduation-cap' : 
                                      ($package->category == 'maternity' ? 'baby' : 
                                      ($package->category == 'portrait' ? 'user' : 
                                      ($package->category == 'event' ? 'calendar-alt' : 'folder'))))) }}"></i>
                        {{ ucfirst($package->category) }}
                    </span>
                    <span class="status-badge {{ $package->is_active ? 'status-active' : 'status-inactive' }}">
                        <i class="fas fa-{{ $package->is_active ? 'eye' : 'eye-slash' }}"></i>
                        {{ $package->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
            </div>
            <a href="{{ route('admin.packages.index') }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>
    </div>

    <!-- Package Content -->
    <div class="package-content">
        <!-- Image Section -->
        <div class="row mb-5">
            <div class="col-12">
                @if($package->image)
                <img src="{{ asset('storage/' . $package->image) }}" 
                     class="package-image" 
                     alt="{{ $package->name }}">
                @else
                <div class="no-image">
                    <i class="fas fa-camera"></i>
                    <h4>No Image Available</h4>
                    <p class="mt-2">Paket ini belum memiliki gambar</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Info Grid -->
        <div class="info-grid">
            <!-- Duration -->
            <div class="info-card">
                <div class="info-label">Durasi</div>
                <div class="info-value">
                    <i class="fas fa-clock me-2"></i>{{ $package->duration }} jam
                </div>
            </div>

            <!-- Photo Count -->
            <div class="info-card">
                <div class="info-label">Jumlah Foto</div>
                <div class="info-value">
                    <i class="fas fa-camera me-2"></i>{{ $package->photo_count }} foto
                </div>
            </div>

            <!-- Category -->
            <div class="info-card">
                <div class="info-label">Kategori</div>
                <div class="info-value">
                    <i class="fas fa-folder me-2"></i>{{ ucfirst($package->category) }}
                </div>
            </div>

            <!-- Price -->
            <div class="info-card price-card">
                <div class="info-label price-label">Harga Paket</div>
                <div class="info-value price-value">
                    Rp {{ number_format($package->price, 0, ',', '.') }}
                </div>
            </div>
        </div>

        <!-- Description Section -->
        <div class="info-section">
            <h3 class="info-section-title">
                <i class="fas fa-align-left"></i> Deskripsi Paket
            </h3>
            <div class="description-box">
                {{ $package->description }}
            </div>
        </div>

        <!-- Features Section -->
        <div class="info-section">
            <h3 class="info-section-title">
                <i class="fas fa-star"></i> Fitur & Layanan
            </h3>
            <div class="features-container">
                @php
                    $features = is_array($package->features) ? $package->features : 
                               (is_string($package->features) ? explode(',', $package->features) : []);
                @endphp
                @foreach($features as $feature)
                @if(trim($feature))
                <span class="feature-tag">
                    <i class="fas fa-check-circle"></i>
                    {{ trim($feature) }}
                </span>
                @endif
                @endforeach
            </div>
        </div>

        <!-- Meta Information -->
        <div class="meta-section">
            <h4 class="mb-3">Informasi Paket</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="meta-item">
                        <span class="meta-label">
                            <i class="fas fa-calendar-plus me-2"></i>Dibuat
                        </span>
                        <span class="meta-value">
                            {{ $package->created_at->format('d M Y, H:i') }}
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="meta-item">
                        <span class="meta-label">
                            <i class="fas fa-calendar-check me-2"></i>Diperbarui
                        </span>
                        <span class="meta-value">
                            {{ $package->updated_at->format('d M Y, H:i') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="meta-item">
                        <span class="meta-label">
                            <i class="fas fa-user me-2"></i>Status
                        </span>
                        <span class="meta-value">
                            <span class="status-badge {{ $package->is_active ? 'status-active' : 'status-inactive' }}">
                                <i class="fas fa-{{ $package->is_active ? 'eye' : 'eye-slash' }}"></i>
                                {{ $package->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="meta-item">
                        <span class="meta-label">
                            <i class="fas fa-id-card me-2"></i>ID Paket
                        </span>
                        <span class="meta-value">
                            {{ $package->id }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('admin.packages.edit', $package->id) }}" 
                   class="btn-edit">
                    <i class="fas fa-edit"></i> Edit Paket
                </a>
                
                <form action="{{ route('admin.packages.toggleStatus', $package->id) }}" 
                      method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn-toggle">
                        <i class="fas fa-{{ $package->is_active ? 'ban' : 'check' }}"></i>
                        {{ $package->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                    </button>
                </form>
                
                <form action="{{ route('admin.packages.destroy', $package->id) }}" 
                      method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus paket {{ $package->name }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">
                        <i class="fas fa-trash"></i> Hapus Paket
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    // Simple confirmation for delete
    document.querySelector('.btn-delete').addEventListener('click', function(e) {
        if (!confirm('Apakah Anda yakin ingin menghapus paket ini?')) {
            e.preventDefault();
        }
    });
</script>
@endsection