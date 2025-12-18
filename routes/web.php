<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\GalleryUserController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', function () {
    $tittle = "FotoStudio";
    $konten = "Selamat datang di FotoStudio - platform modern untuk produk dan galeri kami.";
    return view('konten.home', compact('tittle', 'konten'));
});

Route::get('/home', fn () => redirect('/'));

// Shop & Gallery
Route::view('/shop', 'konten.shop')->name('shop');
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

/*
|--------------------------------------------------------------------------
| USER AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/auth', [AuthController::class, 'showLoginRegister'])->name('auth');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Redirect lama
Route::get('/login', fn () => redirect('/auth'));
Route::get('/register', fn () => redirect('/auth'));

/*
|--------------------------------------------------------------------------
| ADMIN AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| ADMIN PROTECTED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth:admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/orders', [OrdersController::class, 'index'])->name('orders');

        Route::get('/setting', function () {
            $title = 'Setting';
            $slug = 'setting';
            $users = \App\Models\User::all();
            $admins = \App\Models\Admin::all();
            return view('Admin.layoutadmin.setting', compact('title', 'slug', 'users', 'admins'));
        })->name('settings');

        // Packages
        Route::resource('packages', PackageController::class);
        Route::put('/packages/{package}/toggle-status',
            [PackageController::class, 'toggleStatus']
        )->name('packages.toggleStatus');

        // Gallery
        Route::prefix('gallery')->name('gallery.')->group(function () {
            Route::get('/', [GalleryController::class, 'index'])->name('index');
            Route::get('/create', [GalleryController::class, 'create'])->name('create');
            Route::post('/', [GalleryController::class, 'store'])->name('store');
            Route::get('/{gallery}', [GalleryController::class, 'show'])->name('show');
            Route::get('/{gallery}/edit', [GalleryController::class, 'edit'])->name('edit');
            Route::put('/{gallery}', [GalleryController::class, 'update'])->name('update');
            Route::delete('/{gallery}', [GalleryController::class, 'destroy'])->name('destroy');
            Route::put('/{gallery}/toggle-status',
                [GalleryController::class, 'toggleStatus']
            )->name('toggleStatus');
        });
    });

/*
|--------------------------------------------------------------------------
| USER PROTECTED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/user/dashboard', function () {
        $title = 'User Dashboard';
        $slug = 'dashboard';
        return view('user.dashboard', compact('title', 'slug'));
    })->name('user.dashboard');

    // Payment
    Route::get('/payment/menu/{booking}', [PaymentController::class, 'menu'])
        ->name('payment.menu');

    Route::post('/payment/create/{booking}', [PaymentController::class, 'create'])
        ->name('payment.create');

    Route::get('/payment/finish', [PaymentController::class, 'finish'])
        ->name('payment.finish');

    Route::get('/payment/history', [PaymentController::class, 'history'])
        ->name('payment.history');
});
