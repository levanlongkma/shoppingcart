<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Shopping\HomeController;
use App\Http\Controllers\Shopping\HomeController as ShoppingHomeController;
use Illuminate\Support\Facades\Auth;
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

Route::group(['as' => 'shopping.'], function() {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/blog-list', [HomeController::class, 'blogList'])->name('blog_list');
    Route::get('/blog-single', [HomeController::class, 'blogSingle'])->name('blog_single');
    Route::get('/products', [HomeController::class, 'products'])->name('products');
    Route::get('/product-details', [HomeController::class, 'productDetails'])->name('product_details');
    Route::get('/checkout', [HomeController::class, 'Checkout'])->name('checkout');
    Route::get('/cart', [HomeController::class, 'Cart'])->name('cart');
    Route::get('/login', [HomeController::class, 'Login'])->name('login');
    Route::get('/contact', [HomeController::class, 'ContactUs'])->name('contact');
    Route::get('/logout', [AuthController::class, 'LogOut'])->name('logout');
});
Route::post('/register', [AuthController::class,'SignUp']);
Route::post('/login', [AuthController::class, 'LogIn']);


