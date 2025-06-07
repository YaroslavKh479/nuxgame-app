<?php

use App\Http\Controllers\Token\TokenController;
use Illuminate\Support\Facades\Route;

Route::prefix('/token/{token}')->group(function () {
    Route::post('', [TokenController::class, 'create']);
});

