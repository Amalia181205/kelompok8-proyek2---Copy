<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BuyersController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryUserController;

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
//Route::view('/gallery', 'konten.gallery')->name('gallery');

Route::get('/gallery', [GalleryUserController::class, 'index'])->name('gallery');
Route::get('/gallery/{kategori}', [GalleryUserController::class, 'detail'])->name('gallery.detail');

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

// ==================== ADMIN ROUTES ====================

// Admin Authentication
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Setting route di luar middleware (jika perlu diakses tanpa login)
Route::get('/setting', [SettingController::class, 'index'])->name('setting');

// Admin Protected Routes

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Orders
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders');

    // Settings
    Route::get('/setting', function () {
        $title = 'Setting';
        $slug = 'setting';
        
        $users = \App\Models\User::all();
        $admins = \App\Models\Admin::all();
        return view('Admin.layoutadmin.setting', compact('title', 'slug', 'users', 'admins'));
    })->name('settings');

    // ============= PACKAGE ROUTES =============
    // Package Routes (CRUD)
    Route::resource('packages', PackageController::class);
    Route::put('/packages/{package}/toggle-status', [PackageController::class, 'toggleStatus'])
        ->name('packages.toggleStatus');

    // Gallery
    Route::prefix('gallery')->name('gallery.')->group(function () {
        Route::get('/', [GalleryController::class, 'index'])->name('index');
        Route::get('/create', [GalleryController::class, 'create'])->name('create');
        Route::post('/', [GalleryController::class, 'store'])->name('store');
        Route::get('/{gallery}', [GalleryController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [GalleryController::class, 'edit'])->name('edit');
        Route::put('/{gallery}', [GalleryController::class, 'update'])->name('update');
        Route::delete('/{id}', [GalleryController::class, 'destroy'])->name('destroy');
        Route::put('/{gallery}/toggle-status', [GalleryController::class, 'toggleStatus'])->name('toggleStatus');
    });

});
    
    // Routes admin lainnya (tetap dikomentari jika belum dibutuhkan)
    /*
    Route::get('/profile', function () {
        $title = 'Admin Profile';
        $slug = 'profile';
        return view('admin.profile', compact('title','slug'));
    })->name('profile');
    
    Route::get('/orders', function () {
        $title = 'Orders Management';
        $slug = 'orders';
        return view('admin.orders', compact('title','slug'));
    })->name('orders');
    
    Route::get('/buyers', function () {
        $title = 'Buyers Management';
        $slug = 'buyers';
        return view('admin.buyers', compact('title','slug'));
    })->name('buyers');
    
    Route::get('/gallery', function () {
        $title = 'Gallery Management';
        $slug = 'gallery';
        return view('admin.gallery', compact('title','slug'));
    })->name('gallery');
    */
//});

// ==================== USER PROTECTED ROUTES ====================
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', function () {
        $title = 'User Dashboard';
        $slug = 'dashboard';
        return view('user.dashboard', compact('title','slug'));
    })->name('user.dashboard');
});