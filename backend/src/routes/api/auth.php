<?php

use app\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/registration', [AuthController::class, 'registration']);
