<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;

Route::get('/', [WebsiteController::class, 'index'])->name('website.index');
Route::get('/about', [WebsiteController::class, 'about'])->name('website.about');
Route::get('/cart', [CartController::class, 'index'])->name('website.cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('website.cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('website.cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('website.cart.remove');
Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('website.wishlist.add');
Route::post('/wishlist/remove', [WishlistController::class, 'removeFromWishlist'])->name('website.wishlist.remove');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('website.wishlist.index');
Route::get('/checkout', [OrderController::class, 'index'])->name('website.checkout');
Route::post('/orders/store', [OrderController::class, 'store'])->name('website.orders.store');
Route::get('/products/index', [ProductController::class, 'index'])->name('website.products.index');
Route::post('/products/store-review/{id}', [ProductController::class, 'storeRevieew'])->name('website.products.storeReviews');
Route::get('/products/{id?}', [ProductController::class, 'show'])->name('website.products.show');
Route::get('/details', [WebsiteController::class, 'details'])->name('website.details');
Route::get('/view', [WebsiteController::class, 'view'])->name('website.view');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('website.contact');

// Customer Authentication Routes
Route::name('customer.')->group(function () {
    Route::get('/login', [CustomerController::class, 'login'])->name('login');
    Route::post('/authenticate', [CustomerController::class, 'authenticate'])->name('authenticate');
    Route::get('/signup', [CustomerController::class, 'signup'])->name('signup');
    Route::post('/register', [CustomerController::class, 'register'])->name('register');
    Route::post('/logout', [CustomerController::class, 'logout'])->name('logout');

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
    });
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('customer.orders');
});
