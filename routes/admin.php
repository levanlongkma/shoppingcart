<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromotionController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/login', [AuthController::class, 'showLoginForm']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::group(['middleware' => ['auth:admin']], function () {
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
        // Admin
        
        Route::get('/manager/admins', [ManagerController::class, 'indexAdmins']);
        Route::get('/manager/admins/create', [ManagerController::class, 'createAdmin']);
        Route::post('/manager/admins/create', [ManagerController::class, 'storeAdmin']);
        Route::get('/manager/admins/{admin:name}/show', [ManagerController::class, 'showAdmin']);
        Route::get('/manager/admins/{admin:name}/edit', [ManagerController::class, 'editAdmin']);
        Route::post('/manager/admins/{admin:name}/edit', [ManagerController::class, 'updateAdmin']);
        Route::get('/manager/admins/{admin:name}/delete', [ManagerController::class, 'deleteAdmin']);
        // User
        Route::get('/manager/users', [ManagerController::class, 'indexUsers']);
        Route::get('/manager/users/create', [ManagerController::class, 'createUser']);
        Route::post('/manager/users/create', [ManagerController::class, 'storeUser']);
        Route::get('/manager/users/{user:name}/show', [ManagerController::class, 'showUser']);
        Route::get('/manager/users/{user:name}/edit', [ManagerController::class, 'editUser']);
        Route::post('/manager/users/{user:name}/edit', [ManagerController::class, 'updateUser']);
        Route::get('/manager/users/{user:name}/delete', [ManagerController::class, 'deleteUser']);
        // Post
        Route::get('/posts', [PostController::class, 'posts']);
        Route::get('/posts/create', [PostController::class, 'create']);
        Route::post('/posts/create', [PostController::class, 'store']);
        Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit']);
        Route::post('/posts/{post:slug}/edit', [PostController::class, 'update']);
        Route::get('/posts/{post:slug}/delete', [PostController::class, 'delete']);
        // });
        Route::get('/promotions', [PromotionController::class, 'promotions']);
        Route::get('/orders', [OrderController::class, 'orders']);
    });
});
