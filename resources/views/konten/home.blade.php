
@extends('bagianAwal.main')

@section('title', 'FotoStudio - Your Trusted Photography Store')

@section('content')
<!-- Hero Banner -->
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<div class="hero-banner" id="hero">
    <div class="hero-content">
        <h1 class="animate-fade-in">Welcome To FotoStudio</h1>
        <p class="hero-subtitle animate-fade-in-delayed">Fanesya Photo Studio</p>
        <a href="{{ url('/contact') }}"  class="btn btn-primary btn-lg mt-4 animate-fade-in-delayed">Contact Us</a>
    </div>
    
    
    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
        <div class="mouse">
            <div class="wheel"></div>
        </div>
        <div class="arrow-scroll">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>

<!-- Intersection Observer Target -->
<div id="navbar-observer-target"></div>

<!-- Description Section -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <p class="lead">
                "Fanesya Photo menghadirkan studio fotografi profesional yang mengabadikan momen berharga Anda dengan hasil berkualitas tinggi dan sentuhan artistik. setiap sesi dirancang nyaman dan menyenangkan, menjadikan setiap momen tak terlupakan."</p>
        </div>
    </div>
</div>

<!-- Featured Products -->
<div class="container mb-5">
    <h3 mb-4>Fotografi Untuk Setiap Prestasi Dalam Hidup Anda</h3>
    <p> Ambil inspirasi dari galeri kami untuk menciptakan momen indah anda sendiri!</p>
    <div class="product-scroll">
        <div class="product-row">
            <!-- Product 1 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="/png/fotoSingle FOTU.jpg" alt="Product 2">
                </div>
                <div class="product-details">
                    <h3>Personal gallery</h3>
                    @if(auth()->check() && auth()->user()->hasBooked('Personal Gallery'))
                        <button class="btn btn-secondary" disabled>Booked</button>
                    @else
                        <a href="{{ route('booking.show', 'personal') }}" class="btn btn-primary">Menu Detail</a>
                    @endif
                </div>
            </div>
            
            <!-- Product 2 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="/png/PaketKeluarga.jpg" alt="Product 2">
                </div>
                <div class="product-details">
                    <h3>Family</h3>
                    @if(auth()->check() && auth()->user()->hasBooked('Family'))
                        <button class="btn btn-secondary" disabled>Booked</button>
                    @else
                        <a href="{{ route('booking.show', 'family') }}" class="btn btn-primary">Menu Detail</a>
                    @endif
                </div>
            </div>

             <!-- Product 3 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="png/PaketBayi.jpg" alt="Product 3">
                </div>
                <div class="product-details">
                    <h3>Maternity & baby</h3>
                    @if(auth()->check() && auth()->user()->hasBooked('Maternity & Baby'))
                        <button class="btn btn-secondary" disabled>Booked</button>
                    @else
                        <a href="{{ route('booking.show', 'maternity') }}" class="btn btn-primary">Menu Detail</a>
                    @endif
                </div>
            </div>
            
            <!-- Product 4 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="/png/PaketPengantin.jpg" alt="Product 3">
                </div>
                <div class="product-details">
                    <h3>Prewedding</h3>
                    @if(auth()->check() && auth()->user()->hasBooked('Prewedding'))
                        <button class="btn btn-secondary" disabled>Booked</button>
                    @else
                        <a href="{{ route('booking.show', 'prewedding') }}" class="btn btn-primary">Menu Detail</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-4">
        <a href="/shop" class="btn btn-lg btn-outline-primary">Liat Semua Product</a>
    </div>
</div>

<div class="container mb-5">
    <h3 mb-4>Produk lainnya</h3>
    <p> Pilih produk pelengkap untuk membuat momen spesial anda semakin berkesan</p>
    <div class="product-scroll">
        <div class="product-row">
            <!-- Product 1 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="/png/makeup.jpg" alt="Product 2">
                </div>
                <div class="product-details">
                    <h3>Makeup & Styling</h3>
                </div>
            </div>
            
            <!-- Product 2 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="/png/PaketPengantin.jpg" alt="Product 2">
                </div>
                <div class="product-details">
                    <h3>Wedding wardrobe</h3>
                </div>
            </div>

             <!-- Product 3 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="/png/baju adat.jpg" alt="Product 3">
                </div>
                <div class="product-details">
                    <h3>Custom wardrobe</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5">
    <h3 mb-4>Jangan pernah kehilangan momen berharga lagi</h3>
    <p>Abadikan setiap momen berharga bersama kami!</p>
    <div class="product-baru">
        <img src="png/Sosmed1.jpg" alt="Instagram" class="product-foto">
        <img src="png/Sosmed2.jpg" alt="Facebook" class="product-foto">
        <img src="png/Sosmed3.jpg" alt="Youtube" class="product-foto">
    </div>
</div>


<style>
    :root {
        --primary-color: #1eaae9;
    }

    /* Hero Banner */
    .hero-banner {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(30, 170, 233, 0.7)),
                    url('/png/fotoSingle FOTU.jpg') center/cover no-repeat fixed;
        height: 89vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        margin: 0;
        padding: 0;
        color: white;
        text-align: center;
    }

    .hero-content {
        max-width: 800px;
        padding: 0 20px;
        z-index: 2;
    }

    .hero-banner h1 {
        font-size: 4.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        opacity: 0;
        transform: translateY(20px);
    }

    .hero-subtitle {
        font-size: 1.8rem;
        opacity: 0;
        transform: translateY(20px);
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
    }

    /* Scroll Indicator */
    .scroll-indicator {
        position: absolute;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        opacity: 0.8;
        transition: opacity 0.3s ease;
    }

    .scroll-indicator:hover {
        opacity: 1;
    }

    .mouse {
        width: 26px;
        height: 40px;
        border: 2px solid #fff;
        border-radius: 20px;
        position: relative;
    }

    .wheel {
        width: 4px;
        height: 8px;
        background-color: #fff;
        border-radius: 2px;
        position: absolute;
        top: 6px;
        left: 50%;
        transform: translateX(-50%);
        animation: scroll 2s ease infinite;
    }

    .arrow-scroll {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
    }

    .arrow-scroll span {
        display: block;
        width: 10px;
        height: 10px;
        border-bottom: 2px solid #fff;
        border-right: 2px solid #fff;
        transform: rotate(45deg);
        animation: arrow 2s infinite;
        opacity: 0;
    }

    .arrow-scroll span:nth-child(2) {
        animation-delay: -0.2s;
    }

    .arrow-scroll span:nth-child(3) {
        animation-delay: -0.4s;
    }

    /* Animations */
    @keyframes scroll {
        0% { transform: translate(-50%, 0); opacity: 1; }
        50% { transform: translate(-50%, 10px); opacity: 0; }
        100% { transform: translate(-50%, 0); opacity: 1; }
    }

    @keyframes arrow {
        0% { opacity: 0; transform: rotate(45deg) translate(-20px, -20px); }
        50% { opacity: 1; }
        100% { opacity: 0; transform: rotate(45deg) translate(20px, 20px); }
    }

    .animate-fade-in {
        animation: fadeIn 1s ease forwards;
    }

    .animate-fade-in-delayed {
        animation: fadeIn 1s ease 0.5s forwards;
    }

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

    /* Navbar Observer Target */
    #navbar-observer-target {
        position: absolute;
        top: 90vh;
        left: 0;
        right: 0;
        height: 1px;
        visibility: hidden;
    }

    /* Products Section */
    .product-scroll {
        overflow-x: auto;
        padding: 20px 0;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none;  /* Internet Explorer 10+ */
    }

    .product-scroll::-webkit-scrollbar {
        display: none; /* WebKit */
    }

    .product-row {
        display: flex;
        gap: 2rem;
        padding: 0 15px;
        min-width: min-content;
    }

    .product-card {
        flex: 0 0 300px;
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
    }

    .product-image {
        height: 200px;
        overflow: hidden;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image img {
        transform: scale(1.05);
    }

    .product-details {
        padding: 1.5rem;
        text-align: center;
    }

    .product-details h3 {
        margin-bottom: 0.5rem;
        color: #333;
        font-size: 1.25rem;
    }

    .price {
        color: var(--primary-color);
        font-weight: bold;
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }

    .btn.btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        border-radius: 30px;
        padding: 8px 25px;
        transition: all 0.3s ease;
    }

    .btn.btn-primary:hover {
        background-color: white;
        color: var(--primary-color) !important;
        border-color: var(--primary-color);
    }

    .btn.btn-outline-primary {
        color: var(--primary-color);
        border-color: var(--primary-color);
        border-radius: 30px;
        padding: 10px 30px;
        transition: all 0.3s ease;
    }

    .btn.btn-outline-primary:hover {
        background-color: var(--primary-color);
        color: white !important;
        border-color: var(--primary-color);
    }

    /* Gallery Section */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        padding: 0 15px;
    }

    .gallery-item {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        aspect-ratio: 3/2;
        cursor: pointer;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.1);
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(30, 170, 233, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-caption {
        color: white;
        font-size: 1.2rem;
        font-weight: 500;
        text-align: center;
        padding: 1rem;
        transform: translateY(20px);
        transition: transform 0.3s ease;
    }

    .gallery-item:hover .gallery-caption {
        transform: translateY(0);
    }

    @media (max-width: 768px) {
        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .gallery-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Contact Section */
    .contact-section {
        background-color: #f8f9fa;
    }

    .contact-form {
        background: white;
        border-radius: 15px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
    }

    .contact-info {
        background: white;
        border-radius: 15px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
        height: 100%;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #dee2e6;
        padding: 0.75rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(30, 170, 233, 0.25);
    }

    .contact-item {
        display: flex;
        align-items: start;
        gap: 15px;
    }

    .contact-item i {
        color: var(--primary-color);
        font-size: 1.2rem;
    }

    .contact-item p {
        margin: 0;
        color: #666;
    }

    .social-links a {
        color: var(--primary-color);
        font-size: 1.5rem;
        transition: transform 0.3s ease;
        display: inline-block;
    }

    .social-links a:hover {
        transform: translateY(-3px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-banner {
            padding: 60px 20px;
            min-height: 300px;
        }

        .hero-banner h1 {
            font-size: 2.5rem;
            word-wrap: break-word;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            padding: 0 10px;
        }

        .product-scroll {
            margin: 0 -15px;
            padding: 20px 15px;
        }

        .product-card {
            flex: 0 0 250px;
        }

        .lead {
            padding: 0 20px;
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .hero-banner h1 {
            font-size: 2rem;
        }

        .product-card {
            flex: 0 0 200px;
        }

        .product-details h3 {
            font-size: 1.1rem;
        }
    }
    
    .product-baru {
    display: flex;
    justify-content: space-between; 
    gap: 20px; 
    align-items: center;
}

.product-foto {
    width: 30%; 
    height: auto;
    border-radius: 8px; 
    object-fit: cover;
}

</style>


<!-- Add Script Section -->


@endsection
