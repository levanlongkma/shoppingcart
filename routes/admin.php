<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromotionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function() {
    Route::group(['middleware' => 'authisadmin'], function() {
    // Admin role 1-2-3
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/categories', [CategoryController::class, 'categories']);
    Route::get('/products', [ProductController::class, 'products']);
    Route::get('/posts', [PostController::class, 'posts']);
    // Only role 1 + 2 can modify (edit, delete or add new) promotions and orders table
    Route::get('/promotions', [PromotionController::class, 'promotions']);
    Route::get('/orders', [OrderController::class, 'orders']);
    // Only admin with <strong>ROLE 1(one)</strong> can access these below features 
    Route::get('/manager/managerUsers', [ManagerController::class, 'managerUsers']);
    Route::get('/manager/managerAdmins', [ManagerController::class, 'managerAdmins']);
    });
    Route::get('/login', [AuthController::class, 'showLoginForm']);
});
