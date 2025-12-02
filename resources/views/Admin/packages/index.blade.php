@extends('admin.layoutadmin.main')

@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<style>
    :root {
        --primary-blue: #1eaae9;
        --dark-blue: #0d8bc4;
        --light-blue: #e3f4fc;
    }

    /* Header Style */
    .content-header h1 {
        color: var(--primary-blue);
        font-weight: 600;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }

    /* Package Cards */
    .package-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(30, 170, 233, 0.15);
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #ffffff 0%, #f8fbff 100%);
    }

    .package-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(30, 170, 233, 0.25);
    }

    .package-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .package-card:hover .package-image {
        transform: scale(1.05);
    }

    /* Category Badges */
    .category-badge {
        font-size: 0.8rem;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
    }

    .badge-wedding {
        background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
        color: white;
    }

    .badge-family {
        background: linear-gradient(135deg, #4cd964, #5de877);
        color: white;
    }

    .badge-graduation {
        background: linear-gradient(135deg, #ffa500, #ffb733);
        color: white;
    }

    .badge-maternity {
        background: linear-gradient(135deg, #ff6b9d, #ff85ad);
        color: white;
    }

    .badge-other {
        background: linear-gradient(135deg, #8a2be2, #9b45e8);
        color: white;
    }

    /* Status Badges */
    .status-badge {
        font-size: 0.75rem;
        padding: 5px 10px;
        border-radius: 15px;
        font-weight: 500;
    }

    .badge-active {
        background: linear-gradient(135deg, #28a745, #34ce57);
        color: white;
    }

    .badge-inactive {
        background: linear-gradient(135deg, #6c757d, #868e96);
        color: white;
    }

    /* Price Display */
    .price-display {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-blue);
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }

    .price-label {
        font-size: 0.8rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-edit {
        background: linear-gradient(135deg, #17a2b8, #20c4d6);
        color: white;
    }

    .btn-view {
        background: linear-gradient(135deg, #007bff, #1a8cff);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #dc3545, #e74c5c);
        color: white;
    }

    .btn-toggle {
        background: linear-gradient(135deg, #ffc107, #ffd454);
        color: #212529;
    }

    .action-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    /* Add Package Button */
    .btn-add-package {
        background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
        border: none;
        border-radius: 30px;
        padding: 12px 25px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(30, 170, 233, 0.3);
    }

    .btn-add-package:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(30, 170, 233, 0.4);
        background: linear-gradient(135deg, var(--dark-blue), #0a6fa3);
    }

    /* Alert Styling */
    .alert-success {
        background: linear-gradient(135deg, #d4edda, #e8f5e9);
        border: none;
        border-radius: 10px;
        border-left: 4px solid #28a745;
    }

    .alert-info {
        background: linear-gradient(135deg, #e3f4fc, #f0f9ff);
        border: none;
        border-radius: 10px;
        border-left: 4px solid var(--primary-blue);
    }

    /* Empty State */
    .empty-state {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 15px;
        padding: 40px;
        text-align: center;
    }

    .empty-state-icon {
        font-size: 4rem;
        color: var(--primary-blue);
        opacity: 0.7;
        margin-bottom: 20px;
    }

    /* Feature List */
    .feature-tag {
        display: inline-block;
        background: var(--light-blue);
        color: var(--dark-blue);
        padding: 4px 10px;
        margin: 3px;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    /* Package Details */
    .detail-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .detail-icon {
        width: 30px;
        color: var(--primary-blue);
        font-size: 1.1rem;
    }

    .detail-label {
        font-weight: 600;
        color: #495057;
        min-width: 100px;
    }

    .detail-value {
        color: #6c757d;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .package-card {
            margin-bottom: 20px;
        }
        
        .action-buttons {
            justify-content: center;
        }
        
        .detail-item {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .package-card {
        animation: fadeIn 0.5s ease forwards;
    }

    .package-card:nth-child(1) { animation-delay: 0.1s; }
    .package-card:nth-child(2) { animation-delay: 0.2s; }
    .package-card:nth-child(3) { animation-delay: 0.3s; }
    .package-card:nth-child(4) { animation-delay: 0.4s; }
    .package-card:nth-child(5) { animation-delay: 0.5s; }
</style>
@endsection

@section('content')
    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Success Message -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
            @endif

            <!-- Add Package Button -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">Daftar Paket Foto</h3>
                            <p class="text-muted mb-0">Total {{ $packages->count() }} paket tersedia</p>
                        </div>
                        <a href="{{ route('admin.packages.create') }}" class="btn btn-add-package">
                            <i class="fas fa-plus mr-2"></i> Tambah Paket Baru
                        </a>
                    </div>
                </div>
            </div>

            <!-- Packages List -->
            @if($packages->count() > 0)
            <div class="row">
                @foreach($packages as $package)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card package-card">
                        <!-- Package Image -->
                        @if($package->image)
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $package->image) }}" 
                                 class="package-image" 
                                 alt="{{ $package->name }}">
                            <div class="position-absolute top-0 right-0 m-3">
                                @if($package->is_active)
                                <span class="status-badge badge-active">AKTIF</span>
                                @else
                                <span class="status-badge badge-inactive">NONAKTIF</span>
                                @endif
                            </div>
                        </div>
                        @else
                        <div class="package-image bg-light d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-camera fa-4x text-muted mb-3"></i>
                            <span class="text-muted">No Image</span>
                            <div class="position-absolute top-0 right-0 m-3">
                                @if($package->is_active)
                                <span class="status-badge badge-active">AKTIF</span>
                                @else
                                <span class="status-badge badge-inactive">NONAKTIF</span>
                                @endif
                            </div>
                        </div>
                        @endif
                        
                        <!-- Card Body -->
                        <div class="card-body">
                            <!-- Package Name & Category -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title mb-0 text-dark">{{ $package->name }}</h5>
                                <span class="category-badge badge-{{ $package->category }}">
                                    {{ ucfirst($package->category) }}
                                </span>
                            </div>
                            
                            <!-- Description -->
                            <p class="card-text text-muted mb-4">
                                <i class="fas fa-quote-left mr-2 text-primary"></i>
                                {{ Str::limit($package->description, 100) }}
                            </p>
                            
                            <!-- Package Details -->
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <div>
                                            <div class="detail-label">Durasi</div>
                                            <div class="detail-value">{{ $package->duration }} jam</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-images"></i>
                                        </div>
                                        <div>
                                            <div class="detail-label">Jumlah Foto</div>
                                            <div class="detail-value">{{ $package->photo_count }} foto</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Features -->
                            @if(is_array($package->features) && count($package->features) > 0)
                            <div class="mb-3">
                                <small class="text-muted d-block mb-2">Fitur:</small>
                                <div class="d-flex flex-wrap">
                                    @foreach(array_slice($package->features, 0, 3) as $feature)
                                    <span class="feature-tag">{{ $feature }}</span>
                                    @endforeach
                                    @if(count($package->features) > 3)
                                    <span class="feature-tag">+{{ count($package->features) - 3 }} lagi</span>
                                    @endif
                                </div>
                            </div>
                            @endif
                            
                            <!-- Price -->
                            <div class="text-center mb-3">
                                <div class="price-label">Harga Paket</div>
                                <div class="price-display">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                <div>
                                    <small class="text-muted">
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        {{ $package->created_at->format('d M Y') }}
                                    </small>
                                </div>
                                
                                <div class="action-buttons">
                                    <a href="{{ route('admin.packages.edit', $package->id) }}" 
                                       class="action-btn btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.packages.show', $package->id) }}" 
                                       class="action-btn btn-view" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.packages.toggleStatus', $package->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="action-btn btn-toggle" 
                                                title="{{ $package->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                            <i class="fas fa-{{ $package->is_active ? 'ban' : 'check' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.packages.destroy', $package->id) }}" 
                                          method="POST" class="d-inline" 
                                          onsubmit="return confirm('Hapus paket {{ $package->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- No Packages Message -->
            @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-camera"></i>
                </div>
                <h4 class="text-muted mb-3">Belum Ada Paket</h4>
                <p class="text-muted mb-4">Mulai dengan menambahkan paket foto pertama Anda</p>
                <a href="{{ route('admin.packages.create') }}" class="btn btn-add-package">
                    <i class="fas fa-plus mr-2"></i> Tambah Paket Pertama
                </a>
            </div>
            @endif
        </div>
    </section>
</div>
@endsection

@section('javascript')
<script src="{{ asset('adminlte/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Auto-hide alert after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);

        // Add smooth hover effect
        $('.package-card').hover(
            function() {
                $(this).find('.package-image').css('transform', 'scale(1.05)');
            },
            function() {
                $(this).find('.package-image').css('transform', 'scale(1)');
            }
        );

        // Add animation to action buttons
        $('.action-btn').hover(
            function() {
                $(this).css('transform', 'scale(1.15)');
            },
            function() {
                $(this).css('transform', 'scale(1)');
            }
        );
    });
</script>
@endsection