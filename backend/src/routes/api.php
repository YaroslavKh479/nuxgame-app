<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

Route::middleware(['api'])
    ->group(function () {
        $files = File::files(base_path('/routes/api/'));
        foreach ($files as $file) {
            require $file->getPathname();
        }
    });
