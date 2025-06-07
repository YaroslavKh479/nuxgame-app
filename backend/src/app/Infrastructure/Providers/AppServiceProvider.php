<?php

namespace App\Infrastructure\Providers;


use App\Domain\User\Contracts\Storage\UserStorageInterface;
use App\Infrastructure\Storage\UserStorage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserStorageInterface::class, UserStorage::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       //
    }
}
