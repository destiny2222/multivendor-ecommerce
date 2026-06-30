<?php

use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SliderController as AdminSliderController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\VendorController as AdminVendorController;
use Illuminate\Support\Facades\Route;

// Admin guest routes
Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);
});

// Admin protected routes
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::resource('sliders', AdminSliderController::class);
    Route::resource('banners', AdminBannerController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('vendors', AdminVendorController::class)->only(['index', 'show', 'destroy']);
    Route::patch('/vendors/{user}/status', [AdminVendorController::class, 'updateStatus'])->name('vendors.update-status');
    Route::resource('products', AdminProductController::class)->only(['index', 'show', 'destroy']);
    Route::resource('users', AdminUserController::class)->only(['index', 'show', 'destroy']);
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show']);
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
});
