<!-- resources/views/admin/packages/show.blade.php -->
@extends('admin.layoutadmin.main')

@section('css')
<style>
    .package-detail-card {
        border-left: 4px solid #007bff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .feature-badge {
        display: inline-block;
        background: #e9ecef;
        padding: 8px 15px;
        margin: 5px;
        border-radius: 20px;
        font-size: 0.9rem;
    }
    .detail-label {
        font-weight: 600;
        color: #495057;
        min-width: 150px;
    }
    .package-image-large {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 8px;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card package-detail-card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Paket</h3>
                            <div class="card-tools">
                                <span class="badge badge-{{ $package->category == 'wedding' ? 'danger' : ($package->category == 'family' ? 'success' : 'warning') }}">
                                    {{ ucfirst($package->category) }}
                                </span>
                                @if($package->is_active)
                                <span class="badge badge-success ml-2">Aktif</span>
                                @else
                                <span class="badge badge-secondary ml-2">Nonaktif</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <!-- Gambar Paket -->
                            @if($package->image)
                            <div class="text-center mb-4">
                                <img src="{{ asset('storage/' . $package->image) }}" 
                                     class="package-image-large" 
                                     alt="{{ $package->name }}">
                            </div>
                            @endif

                            <!-- Informasi Dasar -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="info-item mb-3">
                                        <div class="detail-label">Nama Paket:</div>
                                        <h4>{{ $package->name }}</h4>
                                    </div>
                                    
                                    <div class="info-item mb-3">
                                        <div class="detail-label">Kategori:</div>
                                        <span class="badge badge-{{ $package->category == 'wedding' ? 'danger' : ($package->category == 'family' ? 'success' : 'warning') }}">
                                            {{ ucfirst($package->category) }}
                                        </span>
                                    </div>
                                    
                                    <div class="info-item mb-3">
                                        <div class="detail-label">Harga:</div>
                                        <h3 class="text-primary">Rp {{ number_format($package->price, 0, ',', '.') }}</h3>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="info-item mb-3">
                                        <div class="detail-label">Durasi:</div>
                                        <h5>{{ $package->duration }} jam</h5>
                                    </div>
                                    
                                    <div class="info-item mb-3">
                                        <div class="detail-label">Jumlah Foto:</div>
                                        <h5>{{ $package->photo_count }} foto</h5>
                                    </div>
                                    
                                    <div class="info-item mb-3">
                                        <div class="detail-label">Status:</div>
                                        @if($package->is_active)
                                        <span class="badge badge-success">Aktif</span>
                                        @else
                                        <span class="badge badge-secondary">Nonaktif</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-4">
                                <div class="detail-label">Deskripsi:</div>
                                <div class="border rounded p-3 bg-light">
                                    {{ $package->description }}
                                </div>
                            </div>

                            <!-- Fitur -->
                            <div class="mb-4">
                                <div class="detail-label">Fitur:</div>
                                <div class="mt-2">
                                    @if(is_array($package->features))
                                        @foreach($package->features as $feature)
                                        <span class="feature-badge">{{ $feature }}</span>
                                        @endforeach
                                    @else
                                        <span class="feature-badge">{{ $package->features }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Informasi Tambahan -->
                            <div class="row mt-4 pt-3 border-top">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="detail-label">Dibuat:</div>
                                        <small class="text-muted">{{ $package->created_at->format('d M Y H:i') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="detail-label">Terakhir Diperbarui:</div>
                                        <small class="text-muted">{{ $package->updated_at->format('d M Y H:i') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                                    </a>
                                </div>
                                
                                <div>
                                    <a href="{{ route('admin.packages.edit', $package->id) }}" 
                                       class="btn btn-primary mr-2">
                                        <i class="fas fa-edit mr-2"></i> Edit
                                    </a>
                                    
                                    <form action="{{ route('admin.packages.toggleStatus', $package->id) }}" 
                                          method="POST" class="d-inline mr-2">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-{{ $package->is_active ? 'warning' : 'success' }}">
                                            <i class="fas fa-{{ $package->is_active ? 'ban' : 'check' }} mr-2"></i>
                                            {{ $package->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.packages.destroy', $package->id) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Hapus paket ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash mr-2"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection