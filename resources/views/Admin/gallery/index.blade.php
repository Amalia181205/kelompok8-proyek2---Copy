<!-- resources/views/admin/gallery/index.blade.php -->
@extends('admin.layoutadmin.main')

@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<style>
    :root {
        --primary-blue: #1eaae9;
        --dark-blue: #0d8bc4;
        --light-blue: #e3f4fc;
    }

    /* Full width container */
    .full-width-content {
        margin: 0;
        padding: 0;
        width: 100%;
    }

    /* Header Section */
    .gallery-header {
        background: linear-gradient(135deg, #1eaae9, #0d8bc4);
        padding: 30px 0;
        margin-bottom: 30px;
        color: white;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .header-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .header-subtitle {
        font-size: 1rem;
        opacity: 0.9;
    }

    .stats-badge {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 8px 20px;
        font-weight: 600;
        font-size: 1.1rem;
        backdrop-filter: blur(10px);
    }

    /* Main Container */
    .gallery-container {
        padding: 0 20px;
        max-width: 100%;
    }

    /* Action Bar */
    .action-bar {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .action-title h2 {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 5px;
    }

    .action-title p {
        color: #6c757d;
        margin: 0;
    }

    /* Filter Section */
    .filter-section {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .filter-tabs {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .filter-tab {
        padding: 12px 25px;
        border-radius: 30px;
        background: white;
        border: 2px solid #dee2e6;
        color: #6c757d;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .filter-tab:hover,
    .filter-tab.active {
        background: var(--primary-blue);
        border-color: var(--primary-blue);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(30, 170, 233, 0.3);
    }

    /* Sort Section */
    .sort-section {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 25px;
        background: white;
        border-radius: 15px;
        margin-bottom: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .sort-label {
        font-weight: 600;
        color: #495057;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .sort-select {
        border: 2px solid #dee2e6;
        border-radius: 10px;
        padding: 10px 20px;
        color: #495057;
        background: white;
        cursor: pointer;
        font-size: 0.95rem;
        min-width: 200px;
        transition: all 0.3s ease;
    }

    .sort-select:focus {
        outline: none;
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 0.2rem rgba(30, 170, 233, 0.25);
    }

    /* Gallery Grid */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .gallery-item {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(30, 170, 233, 0.15);
        transition: all 0.3s ease;
        background: white;
    }

    .gallery-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(30, 170, 233, 0.25);
    }

    .gallery-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .gallery-item:hover .gallery-image {
        transform: scale(1.05);
    }

    /* Category Badges */
    .category-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        z-index: 2;
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

    .badge-portrait {
        background: linear-gradient(135deg, #8a2be2, #9b45e8);
        color: white;
    }

    .badge-event {
        background: linear-gradient(135deg, #17a2b8, #20c4d6);
        color: white;
    }

    .badge-other {
        background: linear-gradient(135deg, #6c757d, #868e96);
        color: white;
    }

    /* Status Badge */
    .status-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 2;
    }

    .badge-active {
        background: linear-gradient(135deg, #28a745, #34ce57);
        color: white;
    }

    .badge-inactive {
        background: linear-gradient(135deg, #6c757d, #868e96);
        color: white;
    }

    /* Gallery Info */
    .gallery-info {
        padding: 20px;
    }

    .gallery-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 3em;
    }

    .gallery-description {
        color: #6c757d;
        font-size: 0.95rem;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 4.5em;
    }

    /* Gallery Meta */
    .gallery-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid #e9ecef;
    }

    .meta-date, .meta-order {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #6c757d;
        font-size: 0.85rem;
    }

    /* Action Buttons */
    .gallery-actions {
        display: flex;
        gap: 8px;
        padding: 15px 20px;
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
    }

    .action-btn {
        flex: 1;
        padding: 10px;
        border-radius: 8px;
        border: none;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
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
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        text-decoration: none;
    }

    /* Add Gallery Button */
    .btn-add-gallery {
        background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
        border: none;
        border-radius: 30px;
        padding: 14px 30px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(30, 170, 233, 0.3);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-add-gallery:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(30, 170, 233, 0.4);
        background: linear-gradient(135deg, var(--dark-blue), #0a6fa3);
        text-decoration: none;
        color: white;
    }

    /* Empty State */
    .empty-gallery {
        text-align: center;
        padding: 80px 20px;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 20px;
        grid-column: 1 / -1;
        margin: 20px 0;
    }

    .empty-icon {
        font-size: 5rem;
        color: var(--primary-blue);
        opacity: 0.7;
        margin-bottom: 25px;
    }

    .empty-title {
        font-size: 1.8rem;
        color: #495057;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .empty-text {
        color: #6c757d;
        font-size: 1.1rem;
        margin-bottom: 30px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Breadcrumb Styling */
    .breadcrumb-custom {
        background: transparent;
        padding: 0;
        margin-bottom: 20px;
    }

    .breadcrumb-custom .breadcrumb-item a {
        color: var(--primary-blue);
        text-decoration: none;
        font-weight: 500;
    }

    .breadcrumb-custom .breadcrumb-item.active {
        color: #6c757d;
        font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        }
    }

    @media (max-width: 992px) {
        .header-content {
            flex-direction: column;
            align-items: flex-start;
            gap: 20px;
        }
        
        .action-bar {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .gallery-container {
            padding: 0 15px;
        }
        
        .filter-tabs {
            justify-content: center;
        }
        
        .filter-tab {
            padding: 10px 20px;
            font-size: 0.9rem;
        }
        
        .gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 15px;
        }
        
        .sort-section {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .sort-select {
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .gallery-grid {
            grid-template-columns: 1fr;
        }
        
        .header-title {
            font-size: 1.5rem;
        }
        
        .gallery-actions {
            flex-direction: column;
        }
        
        .action-btn {
            width: 100%;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .gallery-item {
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
    }

    .gallery-item:nth-child(1) { animation-delay: 0.1s; }
    .gallery-item:nth-child(2) { animation-delay: 0.2s; }
    .gallery-item:nth-child(3) { animation-delay: 0.3s; }
    .gallery-item:nth-child(4) { animation-delay: 0.4s; }
    .gallery-item:nth-child(5) { animation-delay: 0.5s; }
    .gallery-item:nth-child(6) { animation-delay: 0.6s; }
</style>
@endsection

@section('content')
    </section>

    <!-- Main Content -->
    <div class="gallery-container">

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

        <!-- Action Bar -->
        <div class="action-bar">
            <div class="action-title">
                <h2><i class="fas fa-list mr-2"></i>Daftar Galeri Foto</h2>
                <p>Total {{ $galleries->count() }} gambar dalam sistem</p>
            </div>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-add-gallery">
                <i class="fas fa-plus"></i> Tambah Galeri Baru
            </a>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <h4 class="mb-3"><i class="fas fa-filter mr-2"></i>Filter Kategori</h4>
            <div class="filter-tabs">
                <button class="filter-tab active" data-category="all">
                    <i class="fas fa-th-large"></i> Semua
                </button>
                <button class="filter-tab" data-category="wedding">
                    <i class="fas fa-ring"></i> Wedding
                </button>
                <button class="filter-tab" data-category="family">
                    <i class="fas fa-users"></i> Family
                </button>
                <button class="filter-tab" data-category="graduation">
                    <i class="fas fa-graduation-cap"></i> Graduation
                </button>
                <button class="filter-tab" data-category="maternity">
                    <i class="fas fa-baby"></i> Maternity
                </button>
                <button class="filter-tab" data-category="portrait">
                    <i class="fas fa-user"></i> Portrait
                </button>
                <button class="filter-tab" data-category="event">
                    <i class="fas fa-calendar-alt"></i> Event
                </button>
                <button class="filter-tab" data-category="other">
                    <i class="fas fa-ellipsis-h"></i> Lainnya
                </button>
            </div>
        </div>

        <!-- Sort Section -->
        <div class="sort-section">
            <div class="sort-label">
                <i class="fas fa-sort-amount-down-alt"></i> Urutkan:
            </div>
            <select class="sort-select" id="sortSelect">
                <option value="latest">Terbaru</option>
                <option value="oldest">Terlama</option>
                <option value="az">A-Z (Judul)</option>
                <option value="za">Z-A (Judul)</option>
                <option value="order_asc">Urutan (Kecil ke Besar)</option>
                <option value="order_desc">Urutan (Besar ke Kecil)</option>
            </select>
        </div>

        <!-- Gallery Grid -->
        @if($galleries->count() > 0)
        <div class="gallery-grid" id="galleryGrid">
            @foreach($galleries as $gallery)
            <div class="gallery-item" data-category="{{ $gallery->category }}" data-sort="{{ $gallery->sort_order }}" data-date="{{ $gallery->created_at->timestamp }}" data-title="{{ strtolower($gallery->title) }}">
                <!-- Gallery Image -->
                <img src="{{ asset('storage/' . $gallery->image) }}" 
                     class="gallery-image" 
                     alt="{{ $gallery->title }}"
                     loading="lazy">
                
                <!-- Category Badge -->
                <span class="category-badge badge-{{ $gallery->category }}">
                    <i class="fas fa-{{ $gallery->category == 'wedding' ? 'ring' : 
                                      ($gallery->category == 'family' ? 'users' : 
                                      ($gallery->category == 'graduation' ? 'graduation-cap' : 
                                      ($gallery->category == 'maternity' ? 'baby' : 
                                      ($gallery->category == 'portrait' ? 'user' : 
                                      ($gallery->category == 'event' ? 'calendar-alt' : 'ellipsis-h'))))) }} mr-1"></i>
                    {{ ucfirst($gallery->category) }}
                </span>
                
                <!-- Status Badge -->
                @if($gallery->is_active)
                <span class="status-badge badge-active">
                    <i class="fas fa-eye mr-1"></i>Aktif
                </span>
                @else
                <span class="status-badge badge-inactive">
                    <i class="fas fa-eye-slash mr-1"></i>Nonaktif
                </span>
                @endif
                
                <!-- Gallery Info -->
                <div class="gallery-info">
                    <h5 class="gallery-title">{{ $gallery->title }}</h5>
                    @if($gallery->description)
                    <p class="gallery-description">{{ Str::limit($gallery->description, 150) }}</p>
                    @endif
                    
                    <div class="gallery-meta">
                        <span class="meta-date">
                            <i class="far fa-calendar-alt"></i>
                            {{ $gallery->created_at->format('d M Y') }}
                        </span>
                        <span class="meta-order">
                            <i class="fas fa-sort-numeric-up"></i>
                            #{{ $gallery->sort_order }}
                        </span>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="gallery-actions">
                    <a href="{{ route('admin.gallery.edit', $gallery->id) }}" 
                       class="action-btn btn-edit">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.gallery.show', $gallery->id) }}" 
                       class="action-btn btn-view">
                        <i class="fas fa-eye"></i> View
                    </a>
                    <form action="{{ route('admin.gallery.toggleStatus', $gallery->id) }}" 
                          method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="action-btn btn-toggle">
                            <i class="fas fa-{{ $gallery->is_active ? 'eye-slash' : 'eye' }}"></i>
                            {{ $gallery->is_active ? 'Nonaktif' : 'Aktif' }}
                        </button>
                    </form>
                    <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" 
                          method="POST" class="d-inline"
                          onsubmit="return confirm('Hapus gambar {{ $gallery->title }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn btn-delete">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div class="empty-gallery">
            <div class="empty-icon">
                <i class="fas fa-images"></i>
            </div>
            <h3 class="empty-title">Belum Ada Galeri Foto</h3>
            <p class="empty-text">
                Mulai dengan menambahkan gambar pertama ke galeri studio Anda.
                Tampilkan karya terbaik Anda kepada pelanggan.
            </p>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-add-gallery">
                <i class="fas fa-plus mr-2"></i> Tambah Gambar Pertama
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('adminlte/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Auto-hide alert
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);

        // Filter functionality
        $('.filter-tab').click(function() {
            $('.filter-tab').removeClass('active');
            $(this).addClass('active');
            
            const category = $(this).data('category');
            filterGallery(category);
        });

        function filterGallery(category) {
            $('.gallery-item').each(function() {
                if (category === 'all' || $(this).data('category') === category) {
                    $(this).show().css('animation', 'fadeInUp 0.5s ease forwards');
                } else {
                    $(this).hide();
                }
            });
        }

        // Sort functionality
        $('#sortSelect').change(function() {
            const sortBy = $(this).val();
            sortGallery(sortBy);
        });

        function sortGallery(sortBy) {
            const $container = $('#galleryGrid');
            const $items = $container.children('.gallery-item');
            
            $items.sort(function(a, b) {
                const $a = $(a);
                const $b = $(b);
                
                switch(sortBy) {
                    case 'latest':
                        return $b.data('date') - $a.data('date');
                    case 'oldest':
                        return $a.data('date') - $b.data('date');
                    case 'az':
                        return $a.data('title').localeCompare($b.data('title'));
                    case 'za':
                        return $b.data('title').localeCompare($a.data('title'));
                    case 'order_asc':
                        return $a.data('sort') - $b.data('sort');
                    case 'order_desc':
                        return $b.data('sort') - $a.data('sort');
                    default:
                        return 0;
                }
            });
            
            $container.append($items);
        }

        // Image hover effect
        $('.gallery-item').hover(
            function() {
                $(this).css('transform', 'translateY(-8px)');
                $(this).find('.gallery-image').css('transform', 'scale(1.05)');
            },
            function() {
                $(this).css('transform', 'translateY(0)');
                $(this).find('.gallery-image').css('transform', 'scale(1)');
            }
        );

        // Better delete confirmation
       // $('.btn-delete').on('click', function(e) {
            //e.preventDefault();
            //const form = $(this).closest('form');
            //const title = form.closest('.gallery-item').find('.gallery-title').text();
            
            //if (confirm(`Apakah Anda yakin ingin menghapus "${title}"?`)) {
                //form.submit();
            //}
        //});
    //});
</script>
@endsection