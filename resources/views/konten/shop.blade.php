@extends('bagianAwal.main')

@section('title', 'Shop - WebSaya.Com')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-5" style="color: #1eaae9; font-weight: 600;">
        Pilih paket untuk menciptakan momen indah Anda
    </h2>

    <div class="row g-4">
        <!-- personal -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card product-card h-100 border-0 rounded-4 text-center">
                <div class="product-image">
                    <img src="{{ asset('png/fotoSingle FOTU.jpg') }}" class="img-fluid" alt="Personal">
                </div>
                <div class="card-body">
                    <h5 class="card-title mb-3">Personal Gallery</h5>
                        @if(auth()->check() && auth()->user()->hasBooked('Personal Gallery'))
                            <button class="btn btn-secondary" disabled>Booked</button>
                        @else
                            <a href="{{ route('booking.show', 'personal') }}" class="btn btn-menu-detail">BookNow</a>
                        @endif
                </div>
            </div>
        </div>

        <!-- Family -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card product-card h-100 border-0 rounded-4 text-center">
                <div class="product-image">
                    <img src="{{ asset('png/PaketKeluarga.jpg') }}" class="img-fluid" alt="Family">
                </div>
                <div class="card-body">
                    <h5 class="card-title mb-3">Family</h5>
                        @if(auth()->check() && auth()->user()->hasBooked('Family'))
                            <button class="btn btn-secondary" disabled>Booked</button>
                        @else
                            <a href="{{ route('booking.show', 'family') }}" class="btn btn-menu-detail">BookNow</a>
                        @endif
                </div>
            </div>
        </div>

        <!-- Maternity -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card product-card h-100 border-0 rounded-4 text-center">
                <div class="product-image">
                    <img src="{{ asset('png/PaketBayi.jpg') }}" class="img-fluid" alt="Maternity">
                </div>
                <div class="card-body">
                    <h5 class="card-title mb-3">Maternity & Baby</h5>
                        @if(auth()->check() && auth()->user()->hasBooked('Maternity & Baby'))
                            <button class="btn btn-secondary" disabled>Booked</button>
                        @else
                            <a href="{{ route('booking.show', 'maternity') }}" class="btn btn-menu-detail">BookNow</a>
                        @endif
                </div>
            </div>
        </div>

        <!-- Prewedding -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card product-card h-100 border-0 rounded-4 text-center">
                <div class="product-image">
                    <img src="{{ asset('png/PaketPengantin.jpg') }}" class="img-fluid" alt="Prewedding">
                </div>
                <div class="card-body">
                    <h5 class="card-title mb-3">Prewedding</h5>
                        @if(auth()->check() && auth()->user()->hasBooked('Prewedding'))
                            <button class="btn btn-secondary" disabled>Booked</button>
                        @else
                            <a href="{{ route('booking.show', 'prewedding') }}" class="btn btn-menu-detail">BookNow</a>
                        @endif
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    /* Product card visual style */
    .product-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 18px rgba(22,35,50,0.06);
        transition: transform 0.35s ease, box-shadow 0.35s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(14,76,124,0.08);
    }

    .product-image {
        height: 220px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.45s ease;
    }

    .product-card:hover .product-image img {
        transform: scale(1.05);
    }

    .card-body { padding: 1.25rem; }

    .card-title { color: #333; font-weight: 600; }

    /* Menu Detail button style */
    .btn-menu-detail {
        display: inline-block;
        background-color: #00aaff;
        color: #fff;
        padding: 10px 26px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 600;
        transition: transform 0.25s ease, box-shadow 0.25s ease, background-color 0.25s ease;
        border: none;
    }

    .btn-menu-detail:hover {
        background-color: #0088cc;
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0,136,204,0.12);
        color: #fff;
    }

    .btn-see-all {
        background-color: #00aaff;
        color: #fff;
        padding: 12px 36px;
        border-radius: 30px;
        font-weight: 700;
        display: inline-block;
        border: none;
    }

    .btn-see-all:hover {
        background-color: #0088cc;
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0,136,204,0.12);
    }

    @media (max-width: 576px) {
        .product-image { height: 180px; }
    }
</style>
@endsection