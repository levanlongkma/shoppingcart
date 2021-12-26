<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('post_login');
    Route::get('/logout', [AuthController::class, 'logOut'])->name('logout');

    // Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        Route::get('/products', [ProductController::class, 'index'])->name('product');
        Route::get('/delete-product/{id}', [ProductController::class, 'delete'])->name('delete_product');
        Route::get('/edit-product/{id}', [ProductController::class, 'showEditForm'])->name('edit_product');
        Route::get('/create-form-product', [ProductController::class, 'showCreateForm'])->name('create_form_product');
        Route::post('/create-product', [ProductController::class, 'create'])->name('create_product');
        Route::post('/update-product/{id}', [ProductController::class, 'update'])->name('update_product');
        Route::get('/search-product', [ProductController::class, 'search'])->name('search_product');


        Route::get('/categories', [CategoryController::class, 'index'])->name('category');
        Route::get('/delete-category/{id}', [CategoryController::class, 'delete'])->name('delete_category');
        Route::get('/edit-category/{id}', [CategoryController::class, 'showEditForm'])->name('edit_category');
        Route::get('/create-form-category', [CategoryController::class, 'showCreateForm'])->name('create_form_category');
        Route::post('/create-category', [CategoryController::class, 'create'])->name('create_category');
        Route::post('/update-category/{id}', [CategoryController::class, 'update'])->name('update_category');
    // });
});
