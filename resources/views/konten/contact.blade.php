@extends('bagianAwal.main')

@section('title', 'Contact - WebSaya.Com')

@section('content')

<div class="container my-5">
    <h2 class="text-center mb-4" style="color: #1eaae9;">Contact</h2>
    
    <div class="row justify-content-between">
        <!-- Contact Form -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                        </div>
                        
                        <div class="mb-4">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-send w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Company Info -->
        <div class="col-md-5">
            <div class="company-info">
                <h4 class="mb-4">Get in Touch</h4>
                
                <div class="info-item mb-4">
                    <h5><i class="bi bi-geo-alt-fill me-2"></i>Address</h5>
                    <p>Jl. Ir. H. Juanda, Singajaya, Kec. Indramayu, Kabupaten Indramayu, Jawa Barat 45218</p>
                </div>
                
                <div class="info-item mb-4">
                    <h5><i class="bi bi-telephone-fill me-2"></i>Phone</h5>
                    <p>+6289513513586</p>
                </div>
                
                <div class="info-item mb-4">
                    <h5><i class="bi bi-envelope-fill me-2"></i>Email</h5>
                    <p>FanesyaFoto@gmail.com</p>
                </div>
                
                <div class="info-item">
                    <h5><i class="bi bi-clock-fill me-2"></i>Working Hours</h5>
                    <p>Monday - Friday: 8:00 AM - 9:00 PM<br>
                    Saturday - Sunday : 10:00 AM - 9:00 PM</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    .form-control {
        border-radius: 8px;
        padding: 10px 15px;
    }
    
    .form-control:focus {
        border-color: #1eaae9;
        box-shadow: 0 0 0 0.2rem rgba(30, 170, 233, 0.25);
    }
    
    .card {
        border-radius: 15px;
        border: none;
    }
    
    .btn-send {
        background-color: #1eaae9;
        color: white;
        border-radius: 30px;
        padding: 10px;
        transition: all 0.3s ease;
    }
    
    .btn-send:hover {
        background-color: white;
        color: #1eaae9;
        border: 2px solid #1eaae9;
    }
    
    .company-info {
        padding: 20px;
    }
    
    .info-item h5 {
        color: #1eaae9;
        font-size: 1.1rem;
    }
    
    .info-item p {
        color: #666;
        margin-left: 2px;
    }
    
    .bi {
        color: #1eaae9;
    }
</style>

@endsection