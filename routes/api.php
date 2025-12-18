<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\OrdersController; // ✅ BENAR

Route::post('/midtrans/callback', [PaymentController::class, 'callback']);

Route::get('/orders', [OrdersController::class, 'index']);
Route::post('/orders', [OrdersController::class, 'store']);
Route::get('/orders/{id}', [OrdersController::class, 'show']);
Route::put('/orders/{id}', [OrdersController::class, 'update']);
Route::delete('/orders/{id}', [OrdersController::class, 'destroy']);
