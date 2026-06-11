<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\CouponController;


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/authenticate', [AdminController::class, 'authenticate'])->name('authenticate');
    Route::get('/signup', [AdminController::class, 'signup'])->name('signup');
    Route::post('/register', [AdminController::class, 'register'])->name('register');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('index');
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::put('/profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');
        Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
        Route::put('orders/{order}/{action}', [OrderController::class, 'handleAction'])->name('orders.action');

        // Route::get('/payment', [AdminController::class, 'payment'])->name('payment');

        Route::resource('categories', CategoryController::class);

        Route::resource('products', ProductController::class);
        Route::get('products/{product}/gallery', [ProductController::class, 'gallery'])->name('products.gallery');
        Route::post('products/{product}/gallery', [ProductController::class, 'uploadGallery'])->name('products.gallery.upload');
        Route::delete('products/gallery/{image}', [ProductController::class, 'deleteGalleryImage'])->name('products.gallery.delete');

        Route::resource('users', UserController::class);
    });
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {



    Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

        Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');

        Route::post('/coupons', [CouponController::class, 'store'])->name('coupons.store');

        Route::delete('/coupons/{coupon}', [CouponController::class, 'destroy'])->name('coupons.destroy');
    });
});
