@extends('admin.layoutadmin.main')

@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="card card-primary mt-3">
            <div class="card-header">
                <h3 class="card-title">Edit Galeri: {{ $gallery->title }}</h3>
            </div>

            <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data"> 
                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="form-group">
                        <label>Judul Galeri</label>
                        <input type="text" name="title" class="form-control" value="{{ $gallery->title }}" required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3">{{ $gallery->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <br><label>Gambar Saat Ini</label><br>
                       <img src="{{ asset('storage/'.$gallery->image) }}" width="150" class="img-thumbnail mb-2">
                        {{-- <img src="{{ asset('uploads/gallery/'.$gallery->image) }}" width="150" class="img-thumbnail mb-2"> --}}
                    </div>

                    <div class="form-group">
                        <label>Ganti Gambar (Opsional)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="category" class="form-control" required>
                            <option value="wedding"     {{ $gallery->category == 'wedding' ? 'selected' : '' }}>Wedding</option>
                            <option value="family"      {{ $gallery->category == 'family' ? 'selected' : '' }}>Family</option>
                            <option value="prewedding"  {{ $gallery->category == 'prewedding' ? 'selected' : '' }}>Prewedding</option>
                            <option value="baby&maternity"   {{ $gallery->category == 'baby&maternity' ? 'selected' : '' }}>Baby&Maternity</option>
                            <option value="personal"    {{ $gallery->category == 'personal' ? 'selected' : '' }}>PersonalGallery</option>
                            {{-- <option value="event"       {{ $gallery->category == 'event' ? 'selected' : '' }}>Event</option> --}}
                            <option value="other"       {{ $gallery->category == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>

            </form>
        </div>

    </div>
</section>

@endsection
