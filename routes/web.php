<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\FeaturedCategoryController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AuthController::class, 'admin'])->name('admin.dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('product-categories', ProductCategoryController::class)->except(['show']);
        Route::put('product-categories/{product_category}/order', [ProductCategoryController::class, 'updateOrder'])->name('product-categories.update-order');
        Route::resource('products', ProductController::class)->except(['show']);
        Route::delete('product-images/{product_image}', [ProductImageController::class, 'destroy'])->name('product-images.destroy');
        Route::resource('featured-categories', FeaturedCategoryController::class)->only(['index','store','update','destroy']);
    });
});

// Halaman publik
Route::get('/landing', [LandingController::class, 'index']);
Route::get('/kategori', [LandingController::class, 'kategori'])->name('kategori');
Route::get('/kategori/{slug}', [LandingController::class, 'kategoriShow'])->name('kategori.show');
Route::get('/produk/{slug}', [LandingController::class, 'productShow'])->name('produk.show');
Route::get('/tentang', [LandingController::class, 'tentang'])->name('tentang');
