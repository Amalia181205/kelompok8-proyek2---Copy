<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\SearchController;

Route::get('/search', [SearchController::class, 'search'])->name('search');

use App\Http\Controllers\BookingController;

Route::get('/booking/{type}', [BookingController::class, 'show'])->name('booking.show');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// Home
Route::get('/', function () {
    $tittle = "FotoStudio";
    $konten = "Selamat datang di FotoStudio - platform modern untuk produk dan galeri kami.";
    return view('konten.home', compact('tittle','konten'));
});

Route::get('/home', function () {
    return redirect('/');
});

// Pages
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::view('/shop', 'konten.shop');
Route::view('/gallery', 'konten.gallery');
Route::view('/contact', 'konten.contact');

use App\Http\Controllers\ContactController;

// Tampilkan form (GET)
Route::get('/contact/create', [ContactController::class, 'create'])->name('contact.create');
// Terima form (POST)
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

//dashboard
Route::get('/dashboard', function () {
    $title = 'Dashboard';
    $slug = 'dashboard';
    return view('layoutadmin.dashboard', compact('title','slug'));
});


