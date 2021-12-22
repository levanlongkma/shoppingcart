<?php

use App\Models\Admin;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromotionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/admin'], function() {
    Route::group(['middleware' => 'authisadmin'], function() {
        Route::group(['middleware' => 'adminisrole1'], function() {

            Route::get('/manager/admins/create', [ManagerController::class, 'createAdmin']);
            Route::post('/manager/admins/create', [ManagerController::class, 'storeAdmin']);
            Route::get('/manager/admins/{id}/view', [ManagerController::class, 'viewAdmin']);
            Route::get('/manager/admins/{id}/edit', [ManagerController::class, 'editAdmin']);
            Route::post('/manager/admins/{id}/edit', [ManagerController::class, 'updateAdmin']);
            Route::get('/manager/admins/{id}/delete', [ManagerController::class, 'deleteAdmin']);

            Route::get('/manager/users/create', [ManagerController::class, 'createUser']);
            Route::post('/manager/users/create', [ManagerController::class, 'storeUser']);
            Route::get('/manager/users/{id}/view', [ManagerController::class, 'viewUser']);
            Route::get('/manager/users/{id}/edit', [ManagerController::class, 'editUser']);
            Route::post('/manager/users/{id}/edit', [ManagerController::class, 'updateUser']);
            Route::get('/manager/users/{id}/delete', [ManagerController::class, 'deleteUser']);

        });
        Route::get('/dashboard', [DashboardController::class, 'dashboard']);
        Route::get('/categories', [CategoryController::class, 'categories']);
        Route::get('/products', [ProductController::class, 'products']);
        Route::get('/posts', [PostController::class, 'posts']);

        Route::get('/promotions', [PromotionController::class, 'promotions']);
        Route::get('/orders', [OrderController::class, 'orders']);
 
        Route::get('/manager/managerUsers', [ManagerController::class, 'managerUsers']);
        Route::get('/manager/managerAdmins', [ManagerController::class, 'managerAdmins']);
    });
    Route::get('/login', [AuthController::class, 'showLoginForm']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout']);
});
