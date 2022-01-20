<?php
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DistrictController;
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
    Route::post('/productsOnCategory/{id}', [HomeController::class, 'productsOnCategory'])->name('productsOnCategory');
    Route::get('/blog-list', [HomeController::class, 'blogList'])->name('blog_list');
    Route::get('/blog-single', [HomeController::class, 'blogSingle'])->name('blog_single');
    Route::get('/products', [HomeController::class, 'products'])->name('products');
    Route::get('/product-details', [HomeController::class, 'productDetails'])->name('product_details');
    Route::get('/login', [HomeController::class, 'Login'])->name('login');
    Route::get('/contact', [HomeController::class, 'ContactUs'])->name('contact');
    Route::get('/logout', [AuthController::class, 'logOut'])->name('logout');
    Route::post('/login', [AuthController::class, 'logIn'])->name('login_post');

    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/register/verify/{code}', [AuthController::class, 'verify'])->name('verify');
    
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/checkout', [HomeController::class, 'Checkout'])->name('checkout');
        Route::get('/cart', [HomeController::class, 'Cart'])->name('cart');
        Route::get('/add-to-cart/{id}', [HomeController::class,'addToCart'])->name('add_to_cart');
        Route::patch('update-cart', [HomeController::class, 'update'])->name('update_cart');
        Route::delete('remove-from-cart', [HomeController::class, 'remove'])->name('remove_from_cart');
        Route::get('/show-district', [DistrictController::class, 'show'])->name('show_district');
    });
});
