<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.auth');
});

Route::get('/a/{token}', function (string $token) {
    return view('pages.token', ['token' => $token]);
});
