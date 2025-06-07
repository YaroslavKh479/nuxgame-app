<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::prefix('/auth')->group(function () {
    Route::post('/registration', [AuthController::class, 'registration']);
});
