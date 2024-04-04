<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\AuthController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('settings')->group(function (){
    Route::get('/', [HomeController::class, 'index'])->name('front.index');

    Route::get('/about', [AboutController::class, 'index'])->name('about');

    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/kisi/{slug?}', [ProductController::class, 'index'])->name('productkisi');
    Route::get('/qadin/{slug?}', [ProductController::class, 'index'])->name('productqadin');
    Route::get('/usaq/{slug?}', [ProductController::class, 'index'])->name('productusaq');
    Route::get('/big-sale', [ProductController::class, 'productBigSale'])->name('bigSale');
    Route::get('/product/{slug}', [ProductController::class, 'productDetail'])->name('productDetail');

    //cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/checkout', [CartController::class, 'cartCheckout'])->name('cart.checkout');
    Route::post('/cart/payment-confirm', [CartController::class, 'paymentConfirm'])->name('cart.payment-confirm');

    // Auth
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginStore']);

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerStore']);

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Coupon
    Route::post('/apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
});
