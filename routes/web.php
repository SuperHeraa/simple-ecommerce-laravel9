<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Redirect::route('product.index');
});

Auth::routes();
Route::get('/product/index', [ProductController::class, 'index_products'])->name('product.index');

Route::middleware('admin')->group(function () {
    Route::get('/product/create', [ProductController::class, 'create_product'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit_product'])->name('product.edit');
    Route::patch('/product{product}/update', [ProductController::class, 'update_product'])->name('product.update');
    Route::delete('/product/{product}', [ProductController::class, 'delete_product'])->name('product.delete');
    Route::post('/order/{order}/confirm', [OrderController::class, 'confirm_payment'])->name('order.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('/product/{product}', [ProductController::class, 'show_product'])->name('product.detail');
    Route::post('/cart/{product}', [CartController::class, 'add_to_cart'])->name('add_to_cart');
    Route::get('/cart', [CartController::class, 'show_cart'])->name('cart.show');
    Route::patch('/cart/{cart}', [CartController::class, 'edit_cart'])->name('cart.edit');
    Route::delete('/cart/delete/{cart}', [CartController::class, 'delete_cart'])->name('cart.delete');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [OrderController::class, 'index_order'])->name('order.index');
    Route::get('/order/{order}', [OrderController::class, 'show_order'])->name('order.show');
    Route::post('/order/{order}/pay', [OrderController::class, 'submit_payment_receipt'])->name('order.payment');
    Route::get('/profile', [ProfileController::class, 'show_profile'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'edit_profile'])->name('profile.edit');
});
