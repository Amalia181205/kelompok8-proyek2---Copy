<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;

// ==================== PUBLIC ROUTES ====================

// Home
Route::get('/', function () {
    $tittle = "FotoStudio";
    $konten = "Selamat datang di FotoStudio - platform modern untuk produk dan galeri kami.";
    return view('konten.home', compact('tittle','konten'));
});

Route::get('/home', function () {
    return redirect('/');
});

// Shop & Gallery
Route::view('/shop', 'konten.shop')->name('shop');
Route::view('/gallery', 'konten.gallery')->name('gallery');

// Contact
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

// Search
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Booking
Route::get('/booking/{type}', [BookingController::class, 'show'])->name('booking.show');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// ==================== COMBINED AUTH ROUTES ====================

// Combined Login/Register Page for Users
Route::get('/auth', [AuthController::class, 'showLoginRegister'])->name('auth');

// Redirect old URLs to combined page
Route::get('/login', function () {
    return redirect('/auth');
});

Route::get('/register', function () {
    return redirect('/auth');
});

// Form submissions for users
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Pastikan route ini ada
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);


// ==================== ADMIN ROUTES ====================

// Admin Authentication
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::get('/setting', [SettingController::class, 'index'])->name('setting');

// Admin Protected Routes
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Tambahkan routes admin lainnya di sini
//     Route::get('/profile', function () {
//         $title = 'Admin Profile';
//         $slug = 'profile';
//         return view('admin.profile', compact('title','slug'));
//     })->name('profile');
    
//     Route::get('/orders', function () {
//         $title = 'Orders Management';
//         $slug = 'orders';
//         return view('admin.orders', compact('title','slug'));
//     })->name('orders');
    
//     Route::get('/packages', function () {
//         $title = 'Packages Management';
//         $slug = 'packages';
//         return view('admin.packages', compact('title','slug'));
//     })->name('packages');
    
//     Route::get('/buyers', function () {
//         $title = 'Buyers Management';
//         $slug = 'buyers';
//         return view('admin.buyers', compact('title','slug'));
//     })->name('buyers');
    
//     Route::get('/gallery', function () {
//         $title = 'Gallery Management';
//         $slug = 'gallery';
//         return view('admin.gallery', compact('title','slug'));
//     })->name('gallery');
    
<<<<<<< HEAD
//     Route::get('/setting', function () {
//         $title = 'Settings';
//         $slug = 'settings';
//         return view('admin.setting', compact('title','slug'));
//     })->name('setting');
 });
=======
    Route::get('/setting', function () {
        $title = 'Setting';
        $slug = 'setting';
        return view('admin.layoutadmin.setting', compact('title','slug'));
    })->name('settings');
});
>>>>>>> f8dfefc559ba12aea4e40360a5f3bda2f4276052

// ==================== USER PROTECTED ROUTES ====================
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', function () {
        $title = 'User Dashboard';
        $slug = 'dashboard';
        return view('user.dashboard', compact('title','slug'));
    })->name('user.dashboard');
});