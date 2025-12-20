@extends('admin.layoutadmin.main')

@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="card card-primary mt-3">
            <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>
            </div>

            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">

                    <div class="form-group">
                        <label>Judul Galeri</label>
                        <input type="text" name="title" class="form-control" required placeholder="Masukkan judul">
                    </div>

                    {{-- <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div> --}}

                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="category" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="wedding">Wedding</option>
                            <option value="family">Familly</option>
                            <option value="prewedding">Prewedding</option>
                            <option value="babymaternity">BabyMaternity</option>
                            <option value="personal">PersonalGallery</option>
                            {{-- <option value="event">Event</option> --}}
                            <option value="other">Other</option>
                        </select>
                    </div>

                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>

    </div>
</section>

@endsection
