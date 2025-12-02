<!-- resources/views/admin/packages/edit.blade.php -->
@extends('admin.layoutadmin.main')

@section('css')
<style>
    .feature-tag {
        display: inline-block;
        background: #e9ecef;
        padding: 5px 10px;
        margin: 5px;
        border-radius: 20px;
        font-size: 0.9rem;
    }
    .feature-tag .remove-feature {
        cursor: pointer;
        margin-left: 5px;
        color: #dc3545;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Paket: {{ $package->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.packages.index') }}">Packages</a></li>
                        <li class="breadcrumb-item active">Edit Paket</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Paket</h3>
                        </div>
                        <form action="{{ route('admin.packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <!-- Nama Paket -->
                                <div class="form-group">
                                    <label for="name">Nama Paket <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $package->name) }}" 
                                           placeholder="Contoh: Paket Wedding Premium" required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Kategori -->
                                <div class="form-group">
                                    <label for="category">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-control @error('category') is-invalid @enderror" 
                                            id="category" name="category" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="wedding" {{ old('category', $package->category) == 'wedding' ? 'selected' : '' }}>Wedding</option>
                                        <option value="family" {{ old('category', $package->category) == 'family' ? 'selected' : '' }}>Family</option>
                                        <option value="graduation" {{ old('category', $package->category) == 'graduation' ? 'selected' : '' }}>Graduation</option>
                                        <option value="maternity" {{ old('category', $package->category) == 'maternity' ? 'selected' : '' }}>Maternity</option>
                                        <option value="other" {{ old('category', $package->category) == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Deskripsi -->
                                <div class="form-group">
                                    <label for="description">Deskripsi <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="3" 
                                              placeholder="Deskripsi lengkap paket" required>{{ old('description', $package->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Harga -->
                                <div class="form-group">
                                    <label for="price">Harga (Rp) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                           id="price" name="price" value="{{ old('price', $package->price) }}" 
                                           placeholder="Contoh: 2500000" min="0" step="1000" required>
                                    @error('price')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <!-- Durasi -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="duration">Durasi (jam) <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                                                   id="duration" name="duration" value="{{ old('duration', $package->duration) }}" 
                                                   placeholder="Contoh: 3" min="1" required>
                                            @error('duration')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Jumlah Foto -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="photo_count">Jumlah Foto <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('photo_count') is-invalid @enderror" 
                                                   id="photo_count" name="photo_count" value="{{ old('photo_count', $package->photo_count) }}" 
                                                   placeholder="Contoh: 50" min="1" required>
                                            @error('photo_count')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Fitur -->
                                <div class="form-group">
                                    <label for="features">Fitur <span class="text-danger">*</span></label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" 
                                               id="feature-input" placeholder="Tambahkan fitur (tekan Enter)">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="add-feature">
                                                Tambah
                                            </button>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted mb-2">
                                        Pisahkan dengan koma atau tekan Enter. Contoh: Editing, Cetak 10R, Album
                                    </small>
                                    <div id="features-container" class="mb-2">
                                        <!-- Features will be added here -->
                                    </div>
                                    <input type="hidden" name="features" id="features-input" 
                                           value="{{ old('features', is_array($package->features) ? implode(',', $package->features) : $package->features) }}">
                                    @error('features')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Gambar -->
                                <div class="form-group">
                                    <label for="image">Gambar Paket</label>
                                    @if($package->image)
                                    <div class="mb-2">
                                        <p>Gambar saat ini:</p>
                                        <img src="{{ asset('storage/' . $package->image) }}" 
                                             class="img-fluid" style="max-height: 200px;">
                                    </div>
                                    @endif
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" 
                                               id="image" name="image" accept="image/*">
                                        <label class="custom-file-label" for="image">Pilih gambar baru (opsional)...</label>
                                        @error('image')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <small class="form-text text-muted">Ukuran maksimal 2MB, format: jpeg, png, jpg, gif</small>
                                    <div id="image-preview" class="mt-2"></div>
                                </div>

                                <!-- Status -->
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="is_active" name="is_active" value="1" 
                                               {{ old('is_active', $package->is_active) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_active">Aktifkan paket</label>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-2"></i> Update Paket
                                </button>
                                <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        let features = [];
        
        // Load existing features
        const initialFeatures = "{{ old('features', is_array($package->features) ? implode(',', $package->features) : $package->features) }}";
        if (initialFeatures) {
            features = initialFeatures.split(',').map(f => f.trim()).filter(f => f);
            updateFeaturesDisplay();
        }

        // Add feature on button click
        $('#add-feature').click(function() {
            addFeature();
        });

        // Add feature on Enter key
        $('#feature-input').keypress(function(e) {
            if (e.which == 13) {
                e.preventDefault();
                addFeature();
            }
        });

        function addFeature() {
            const feature = $('#feature-input').val().trim();
            if (feature && !features.includes(feature)) {
                features.push(feature);
                updateFeaturesDisplay();
                $('#feature-input').val('');
            }
        }

        function removeFeature(index) {
            features.splice(index, 1);
            updateFeaturesDisplay();
        }

        function updateFeaturesDisplay() {
            $('#features-container').empty();
            features.forEach((feature, index) => {
                $('#features-container').append(`
                    <span class="feature-tag">
                        ${feature}
                        <span class="remove-feature" onclick="removeFeature(${index})">×</span>
                    </span>
                `);
            });
            $('#features-input').val(features.join(','));
        }

        // Make removeFeature function available