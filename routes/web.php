<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\ProductController as CustomerProductController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [CustomerProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [CustomerProductController::class, 'show'])->name('products.show');
Route::get('/stores/{store:slug}', [HomeController::class, 'store'])->name('stores.show');

// Auth routes (guest only)
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// require __DIR__ . '/admin.php';
// require __DIR__ . '/vendor.php';
// require __DIR__ . '/auth.php';

// Dashboard redirect
// Route::get('/dashboard', function () {
//     if (auth('admin')->check()) {
//         return redirect()->route('admin.dashboard');
//     }

//     $user = auth()->user();
//     if ($user->isAdmin()) {
//         return redirect()->route('admin.dashboard');
//     }
//     if ($user->isVendor()) {
//         return redirect()->route('vendor.dashboard');
//     }

//     return redirect()->route('customer.orders');
// })->name('dashboard')->middleware('auth:web,admin');
