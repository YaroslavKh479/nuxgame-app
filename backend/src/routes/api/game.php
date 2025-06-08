<?php

use App\Http\Controllers\Game\GameController;
use Illuminate\Support\Facades\Route;


Route::prefix('/token/{token}')->group(function () {
    Route::prefix('/game')->group(function () {
        //Route::get('', [TokenController::class, 'delete']);
        Route::post('', [GameController::class, 'play']);
    });

});

