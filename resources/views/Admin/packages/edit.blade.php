<!-- resources/views/admin/packages/edit.blade.php -->
@extends('admin.layoutadmin.main')

@section('css')
<style>
    :root {
        --primary-blue: #1eaae9;
        --dark-blue: #0d8bc4;
        --light-blue: #e3f4fc;
    }
    
    .form-section {
        background: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    
    .form-title {
        color: var(--primary-blue);
        font-weight: 600;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
    }
    
    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    
    .required-star {
        color: #dc3545;
    }
    
    .feature-tag {
        background: var(--light-blue);
        color: var(--dark-blue);
        padding: 6px 12px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin: 5px;
        font-size: 0.9rem;
    }
    
    .feature-tag .remove-btn {
        background: none;
        border: none;
        color: #dc3545;
        cursor: pointer;
        font-size: 1.2rem;
        line-height: 1;
        padding: 0;
    }
    
    .current-image {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 15px;
        background: #f8f9fa;
    }
    
    .current-image img {
        max-width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 5px;
    }
    
    .image-upload-area {
        border: 2px dashed #dee2e6;
        border-radius: 10px;
        padding: 40px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        background: #f8f9fa;
    }
    
    .image-upload-area:hover {
        border-color: var(--primary-blue);
        background: #e3f4fc;
    }
    
    .image-upload-area i {
        font-size: 3rem;
        color: var(--primary-blue);
        margin-bottom: 15px;
    }
    
    .btn-custom-primary {
        background: var(--primary-blue);
        border: none;
        color: white;
        padding: 10px 25px;
        border-radius: 5px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-custom-primary:hover {
        background: var(--dark-blue);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .btn-custom-secondary {
        background: #6c757d;
        border: none;
        color: white;
        padding: 10px 25px;
        border-radius: 5px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-custom-secondary:hover {
        background: #5a6268;
        color: white;
    }
    
    .form-control:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 0.2rem rgba(30, 170, 233, 0.25);
    }
</style>
@endsection

@section('content')


    <!-- Success Message -->
    @if(session('success'))
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    </div>
    @endif

    <!-- Form Section -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="form-section">
                <h4 class="form-title">
                    <i class="fas fa-pencil-alt me-2"></i>
                    Form Edit Paket Foto
                </h4>

                <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nama Paket -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-tag me-1"></i> Nama Paket
                            <span class="required-star">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $package->name) }}"
                               placeholder="Contoh: Paket Wedding Premium"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-folder me-1"></i> Kategori
                            <span class="required-star">*</span>
                        </label>
                        <select name="category" 
                                class="form-control @error('category') is-invalid @enderror" 
                                required>
                            <option value="">Pilih Kategori</option>
                            <option value="wedding" {{ old('category', $package->category) == 'wedding' ? 'selected' : '' }}>Wedding</option>
                            <option value="family" {{ old('category', $package->category) == 'family' ? 'selected' : '' }}>Family</option>
                            <option value="graduation" {{ old('category', $package->category) == 'graduation' ? 'selected' : '' }}>Graduation</option>
                            <option value="maternity" {{ old('category', $package->category) == 'maternity' ? 'selected' : '' }}>Maternity</option>
                            <option value="portrait" {{ old('category', $package->category) == 'portrait' ? 'selected' : '' }}>Portrait</option>
                            <option value="event" {{ old('category', $package->category) == 'event' ? 'selected' : '' }}>Event</option>
                            <option value="other" {{ old('category', $package->category) == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-align-left me-1"></i> Deskripsi
                            <span class="required-star">*</span>
                        </label>
                        <textarea name="description" 
                                  rows="4"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Deskripsi lengkap paket"
                                  required>{{ old('description', $package->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Harga -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-money-bill-wave me-1"></i> Harga (Rp)
                            <span class="required-star">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" 
                                   name="price"
                                   class="form-control @error('price') is-invalid @enderror"
                                   value="{{ old('price', $package->price) }}"
                                   placeholder="2500000"
                                   min="0"
                                   step="1000"
                                   required>
                        </div>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Durasi & Jumlah Foto -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="fas fa-clock me-1"></i> Durasi (jam)
                                <span class="required-star">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" 
                                       name="duration"
                                       class="form-control @error('duration') is-invalid @enderror"
                                       value="{{ old('duration', $package->duration) }}"
                                       placeholder="3"
                                       min="1"
                                       required>
                                <span class="input-group-text">jam</span>
                            </div>
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="fas fa-camera me-1"></i> Jumlah Foto
                                <span class="required-star">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" 
                                       name="photo_count"
                                       class="form-control @error('photo_count') is-invalid @enderror"
                                       value="{{ old('photo_count', $package->photo_count) }}"
                                       placeholder="50"
                                       min="1"
                                       required>
                                <span class="input-group-text">foto</span>
                            </div>
                            @error('photo_count')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Fitur -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-star me-1"></i> Fitur
                            <span class="required-star">*</span>
                        </label>
                        
                        <!-- Input Fitur Baru -->
                        <div class="input-group mb-3">
                            <input type="text" 
                                   id="feature-input"
                                   class="form-control"
                                   placeholder="Tambahkan fitur (contoh: 1 Fotografer)">
                            <button type="button" 
                                    id="add-feature"
                                    class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                        </div>
                        
                        <!-- Fitur yang sudah ada -->
                        <div id="features-container" class="mb-3">
                            @php
                                $features = is_array($package->features) ? $package->features : 
                                           (is_string($package->features) ? explode(',', $package->features) : []);
                            @endphp
                            @foreach($features as $index => $feature)
                            @if(trim($feature))
                            <span class="feature-tag" id="feature-{{ $index }}">
                                <i class="fas fa-check-circle"></i>
                                {{ trim($feature) }}
                                <button type="button" 
                                        class="remove-btn"
                                        onclick="removeFeature({{ $index }})">
                                    ×
                                </button>
                            </span>
                            @endif
                            @endforeach
                        </div>
                        
                        <!-- Hidden input untuk fitur -->
                        <input type="hidden" 
                               name="features" 
                               id="features-input"
                               value="{{ old('features', is_array($package->features) ? implode(',', $package->features) : $package->features) }}">
                        
                        @error('features')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Gambar Saat Ini -->
                    @if($package->image)
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-image me-1"></i> Gambar Saat Ini
                        </label>
                        <div class="current-image">
                            <img src="{{ asset('storage/' . $package->image) }}" 
                                 alt="{{ $package->name }}">
                            <div class="mt-2">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Biarkan kosong jika tidak ingin mengubah gambar
                                </small>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Upload Gambar Baru -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-cloud-upload-alt me-1"></i> Upload Gambar Baru
                        </label>
                        
                        <div class="image-upload-area" onclick="document.getElementById('image').click()">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <h5>Klik untuk upload gambar baru</h5>
                            <p class="text-muted mb-0">Format: JPG, PNG, GIF | Maks: 2MB</p>
                        </div>
                        
                        <input type="file" 
                               name="image" 
                               id="image"
                               class="d-none"
                               accept="image/*"
                               onchange="previewImage(event)">
                        
                        <!-- Preview gambar baru -->
                        <div id="image-preview" class="mt-3"></div>
                        
                        @error('image')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input type="checkbox" 
                                   name="is_active"
                                   value="1"
                                   class="form-check-input"
                                   id="is_active"
                                   {{ old('is_active', $package->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                <i class="fas fa-toggle-on me-1"></i>
                                Aktifkan paket untuk ditampilkan
                            </label>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-3">
                        <button type="submit" class="btn-custom-primary">
                            <i class="fas fa-save me-2"></i> Update Paket
                        </button>
                        <a href="{{ route('admin.packages.show', $package->id) }}" 
                           class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let features = [];
        
        // Load existing features
        const initialFeatures = "{{ old('features', is_array($package->features) ? implode(',', $package->features) : $package->features) }}";
        if (initialFeatures) {
            features = initialFeatures.split(',').map(f => f.trim()).filter(f => f);
        }

        // Add feature
        document.getElementById('add-feature').addEventListener('click', addFeature);
        document.getElementById('feature-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addFeature();
            }
        });

        function addFeature() {
            const input = document.getElementById('feature-input');
            const feature = input.value.trim();
            
            if (feature && !features.includes(feature)) {
                features.push(feature);
                updateFeaturesDisplay();
                input.value = '';
                input.focus();
            }
        }

        window.removeFeature = function(index) {
            features.splice(index, 1);
            updateFeaturesDisplay();
        }

        function updateFeaturesDisplay() {
            const container = document.getElementById('features-container');
            const hiddenInput = document.getElementById('features-input');
            
            container.innerHTML = '';
            features.forEach((feature, index) => {
                const tag = document.createElement('span');
                tag.className = 'feature-tag';
                tag.id = `feature-${index}`;
                tag.innerHTML = `
                    <i class="fas fa-check-circle"></i>
                    ${feature}
                    <button type="button" class="remove-btn" onclick="removeFeature(${index})">
                        ×
                    </button>
                `;
                container.appendChild(tag);
            });
            
            hiddenInput.value = features.join(',');
        }

        // Image preview
        window.previewImage = function(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                preview.innerHTML = `
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>Gambar baru terpilih:</strong> ${file.name}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <img src="${e.target.result}" 
                         class="img-fluid rounded" 
                         style="max-height: 200px;">
                    <div class="mt-2">
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeImage()">
                            <i class="fas fa-trash me-1"></i> Hapus Gambar
                        </button>
                    </div>
                `;
            };
            reader.readAsDataURL(file);
        }

        window.removeImage = function() {
            document.getElementById('image').value = '';
            document.getElementById('image-preview').innerHTML = `
                <div class="text-muted text-center py-3">
                    <i class="fas fa-image fa-2x mb-2"></i>
                    <p>Gambar lama akan tetap digunakan</p>
                </div>
            `;
        }

        // Format harga
        const priceInput = document.querySelector('input[name="price"]');
        priceInput.addEventListener('blur', function() {
            const value = parseInt(this.value);
            if (!isNaN(value)) {
                this.value = value.toLocaleString('id-ID');
            }
        });

        priceInput.addEventListener('focus', function() {
            this.value = this.value.replace(/\./g, '');
        });

        // Initialize features display
        updateFeaturesDisplay();
    });
</script>
@endsection