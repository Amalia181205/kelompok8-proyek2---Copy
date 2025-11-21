@extends('bagianAwal.main')

@section('title', 'Gallery - WebSaya.Com')

@section('content')

<div class="container my-5">
    
    <div class="row g-4">
        <!-- Gallery Item 1 -->
        <div class="col-md-4">
            <div class="gallery-item">
                <img src="{{ asset('png/PaketKeluarga.jpg') }}" class="img-fluid" alt="Gallery 1">
                <div class="overlay">
                    <div class="overlay-content">
                        <h5>Family</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery Item 2 -->
        <div class="col-md-4">
            <div class="gallery-item">
                <img src="{{ asset('png/PaketBayi.jpg') }}" class="img-fluid" alt="Gallery 2">
                <div class="overlay">
                    <div class="overlay-content">
                        <h5>Maternity & baby</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery Item 3 -->
        <div class="col-md-4">
            <div class="gallery-item">
                <img src="{{ asset('png/fotoSingle FOTU.jpg') }}" class="img-fluid" alt="Gallery 3">
                <div class="overlay">
                    <div class="overlay-content">
                        <h5>Personal gallery</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery Item 4 -->
        <div class="col-md-4">
            <div class="gallery-item">
                <img src="{{ asset('png/BajuAdat3.jpg') }}" class="img-fluid" alt="Gallery 4">
                <div class="overlay">
                    <div class="overlay-content">
                        <h5>Bridal image</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery Item 5 -->
        <div class="col-md-4">
            <div class="gallery-item">
                <img src="{{ asset('png/PaketPengantin.jpg') }}" class="img-fluid" alt="Gallery 5">
                <div class="overlay">
                    <div class="overlay-content">
                        <h5>Wedding</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery Item 6 -->
        <div class="col-md-4">
            <div class="gallery-item">
                <img src="{{ asset('png/Personal2.jpg') }}" class="img-fluid" alt="Gallery 6">
                <div class="overlay">
                    <div class="overlay-content">
                        <h5>Personal gallery</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        cursor: pointer;
    }

    .gallery-item img {
        transition: transform 0.5s ease;
        border-radius: 15px;
    }

    .gallery-item:hover img {
        transform: scale(1.1);
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(30, 170, 233, 0.8);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
    }

    .gallery-item:hover .overlay {
        opacity: 1;
    }

    .overlay-content {
        color: white;
        text-align: center;
        padding: 20px;
    }

    .overlay-content h5 {
        margin-bottom: 10px;
    }

    .overlay-content p {
        margin: 0;
    }
</style>

@endsection