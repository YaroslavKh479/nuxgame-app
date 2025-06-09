<?php

use App\Http\Controllers\Game\GameController;
use Illuminate\Support\Facades\Route;


Route::prefix('/token/{token}')->group(function () {
    Route::prefix('/game')->group(function () {
        Route::post('', [GameController::class, 'play']);
        Route::get('/history', [GameController::class, 'history']);
    });

});

