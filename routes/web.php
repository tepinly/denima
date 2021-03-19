<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/',[HomeController::class, 'index']);

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/categories', [ProductController::class, 'index'])->name('categories_index');
Route::get('/categories/{category_id}', [ProductController::class, 'category'])->name('category');

Route::get('/products/{product_id}', [ProductController::class, 'product'])->name('product');
Route::get('/products/{product_id}/checkout', [ProductController::class, 'checkout'])->name('products.checkout');

/* Cart */
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/addcart/{product_id}', [CartController::class, 'addToCart'])->name('addcart');
Route::post('/removecart/{product_id}', [CartController::class, 'removeFromCart'])->name('deletecart');
Route::post('/checkoutcart/{product_id}', [CartController::class, 'checkoutCart'])->name('checkoutcart');

/* Stripe */
Route::post('products/{product}/purchase', [ProductController::class, 'purchase'])->name('products.purchase');
Route::post('/cart/purchase', [CartController::class, 'purchase'])->name('cart.purchase');
