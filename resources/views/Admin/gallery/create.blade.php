<!-- resources/views/admin/packages/create.blade.php -->
@extends('admin.layoutadmin.main')

@section('css')
<style>
    .form-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    
    .card-header {
        background: #007bff;
        color: white;
        border-radius: 10px 10px 0 0 !important;
        padding: 20px;
    }
    
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
    }
    
    .required-star {
        color: #dc3545;
    }
    
    .feature-tag {
        display: inline-flex;
        align-items: center;
        background: #007bff;
        color: white;
        padding: 8px 15px;
        margin: 5px;
        border-radius: 20px;
        font-size: 0.9rem;
    }
    
    .feature-tag .remove-btn {
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        margin-left: 8px;
        font-size: 1.2rem;
        font-weight: bold;
        padding: 0;
        line-height: 1;
    }
    
    .image-upload-area {
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        padding: 30px;
        text-align: center;
        background: #f8f9fa;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .image-upload-area:hover {
        border-color: #007bff;
        background: #e3f4fc;
    }
    
    .image-upload-icon {
        font-size: 3rem;
        color: #007bff;
        margin-bottom: 10px;
    }
    
    .image-preview img {
        max-width: 100%;
        max-height: 200px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
            <div class="card form-card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Form Tambah Paket Foto</h4>
                </div>

                <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body p-4">
                        <!-- Nama Paket -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-tag me-1"></i> Nama Paket
                                <span class="required-star">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}"
                                   placeholder="Contoh: Paket Wedding Premium"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-folder me-1"></i> Kategori
                                <span class="required-star">*</span>
                            </label>
                            <select name="category" 
                                    class="form-control @error('category') is-invalid @enderror" 
                                    required>
                                <option value="">Pilih Kategori</option>
                                <option value="wedding" {{ old('category') == 'wedding' ? 'selected' : '' }}>Wedding</option>
                                <option value="family" {{ old('category') == 'family' ? 'selected' : '' }}>Family</option>
                                <option value="graduation" {{ old('category') == 'graduation' ? 'selected' : '' }}>Graduation</option>
                                <option value="maternity" {{ old('category') == 'maternity' ? 'selected' : '' }}>Maternity</option>
                                <option value="portrait" {{ old('category') == 'portrait' ? 'selected' : '' }}>Portrait</option>
                                <option value="event" {{ old('category') == 'event' ? 'selected' : '' }}>Event</option>
                                <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-align-left me-1"></i> Deskripsi
                                <span class="required-star">*</span>
                            </label>
                            <textarea name="description" 
                                      rows="4"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Deskripsi lengkap paket"
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Harga -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-money-bill-wave me-1"></i> Harga (Rp)
                                <span class="required-star">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" 
                                       name="price"
                                       class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price') }}"
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
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-clock me-1"></i> Durasi (jam)
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="number" 
                                           name="duration"
                                           class="form-control @error('duration') is-invalid @enderror"
                                           value="{{ old('duration') }}"
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
                                           value="{{ old('photo_count') }}"
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
                        <div class="mb-3">
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
                                @if(old('features'))
                                    @php
                                        $oldFeatures = explode(',', old('features'));
                                    @endphp
                                    @foreach($oldFeatures as $index => $feature)
                                    @if(trim($feature))
                                    <span class="feature-tag" id="feature-{{ $index }}">
                                        <i class="fas fa-check-circle me-1"></i>
                                        {{ trim($feature) }}
                                        <button type="button" 
                                                class="remove-btn"
                                                onclick="removeFeature({{ $index }})">
                                            ×
                                        </button>
                                    </span>
                                    @endif
                                    @endforeach
                                @endif
                            </div>
                            
                            <!-- Hidden input untuk fitur -->
                            <input type="hidden" 
                                   name="features" 
                                   id="features-input"
                                   value="{{ old('features') }}">
                            
                            @error('features')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Upload Gambar -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-image me-1"></i> Gambar Paket (Opsional)
                            </label>
                            
                            <div class="image-upload-area" onclick="document.getElementById('image').click()">
                                <i class="fas fa-cloud-upload-alt image-upload-icon"></i>
                                <h5>Klik untuk upload gambar</h5>
                                <p class="text-muted mb-0">Format: JPG, PNG, GIF | Maks: 2MB</p>
                            </div>
                            
                            <input type="file" 
                                   name="image" 
                                   id="image"
                                   class="d-none"
                                   accept="image/*"
                                   onchange="previewImage(event)">
                            
                            <!-- Preview gambar -->
                            <div id="image-preview" class="mt-3"></div>
                            
                            @error('image')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input type="checkbox" 
                                       name="is_active"
                                       value="1"
                                       class="form-check-input"
                                       id="is_active"
                                       checked>
                                <label class="form-check-label" for="is_active">
                                    <i class="fas fa-toggle-on me-1"></i>
                                    Aktifkan paket untuk ditampilkan
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="card-footer p-4">
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Simpan Gambar
                            </button>
                            <a href="{{ route('admin.packages.index') }}" 
                               class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i> Batal
                            </a>
                        </div>
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
        
        // Load existing features from old input
        const oldFeatures = "{{ old('features') }}";
        if (oldFeatures) {
            features = oldFeatures.split(',').map(f => f.trim()).filter(f => f);
            updateFeaturesDisplay();
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
                    <i class="fas fa-check-circle me-1"></i>
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
                        <strong>Gambar terpilih:</strong> ${file.name}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <img src="${e.target.result}" 
                         class="img-fluid rounded mt-2">
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
            document.getElementById('image-preview').innerHTML = '';
        }
    });
</script>
@endsection