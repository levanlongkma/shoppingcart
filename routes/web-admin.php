<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function() {
    Route::get('/auth/login', [AuthController::class, 'showLoginForm']);
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/categories', [CategoryController::class, 'categories']);
    Route::get('/products', [ProductController::class, 'products']);
});
