<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Shopping\HomeController;
use App\Http\Controllers\Shopping\HomeController as ShoppingHomeController;
use App\Http\Controllers\Shopping\WishlistController;
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

    Route::group(['prefix' => 'products', 'as' =>'products.'], function(){
        Route::get('/{product:slug}', [HomeController::class, 'productDetails'])->name('productDetails');
    });
    Route::get('/login', [HomeController::class, 'Login'])->name('login');
    Route::get('/contact', [HomeController::class, 'ContactUs'])->name('contact');
    Route::get('/logout', [AuthController::class, 'logOut'])->name('logout');
    Route::post('/login', [AuthController::class, 'logIn'])->name('login_post');
    Route::post('/register', [AuthController::class,'signUp'])->name('register');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/checkout', [HomeController::class, 'Checkout'])->name('checkout');
        Route::get('/cart', [HomeController::class, 'Cart'])->name('cart');
        
        Route::group(['prefix' => 'favorites', 'as' => 'favorites.'], function(){
            Route::post('/store', [WishlistController::class, 'addToFavorite'])->name('addToFavorite');
            Route::post('/delete', [WishlistController::class, 'removeFromFavorite'])->name('removeFromFavorite');
        });
    });

});
