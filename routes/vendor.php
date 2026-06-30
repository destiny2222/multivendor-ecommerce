<?php

use App\Http\Controllers\Vendor\Auth\LoginController;
use App\Http\Controllers\Vendor\Auth\RegisterController;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\StoreController;
use Illuminate\Support\Facades\Route;

// Vendor guest routes
Route::middleware('guest')->prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Vendor protected routes
Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/store', [StoreController::class, 'edit'])->name('store.edit');
    Route::post('/store', [StoreController::class, 'store'])->name('store.store');
    Route::patch('/store', [StoreController::class, 'update'])->name('store.update');

    Route::resource('products', ProductController::class);

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{orderItem}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{orderItem}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
});
