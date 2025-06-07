<?php

use app\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->group(function () {
    Route::post('/registration', [AuthController::class, 'registration']);
});
