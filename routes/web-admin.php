<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function() {
    Route::get('/auth/login', [AuthController::class, 'showLoginForm']);
});
