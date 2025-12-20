@extends('admin.layoutadmin.main')

@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="card card-primary mt-3">
            <div class="card-header">
                <h3 class="card-title">Detail Galeri: {{ $gallery->title }}</h3>
            </div>

            <div class="card-body">

                <div class="form-group">
                    <label>Judul Galeri:</label>
                    <p>{{ $gallery->title }}</p>
                </div>

                {{-- <div class="form-group">
                    <label>Deskripsi:</label>
                    <p>{{ $gallery->description ?? '-' }}</p>
                </div> --}}

                <div class="form-group">
                    <label>Gambar:</label><br>
                    
                    <img src="{{ asset('storage/'.$gallery->image) }}" class="img-fluid img-thumbnail" style="max-width: 200px;">
                </div>

                <div class="form-group">
                    <label>Kategori:</label>
                    <p>{{ ucfirst($gallery->category) }}</p>
                </div>

            </div>

            <div class="card-footer">
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Kembali</a>
                {{-- <a href="{{ route('admin.gallery.edit', $gallery->id) }}" class="btn btn-warning">Edit</a> --}}
            </div>
        </div>

    </div>
</section>

@endsection
