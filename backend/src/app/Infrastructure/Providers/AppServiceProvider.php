<?php

namespace App\Infrastructure\Providers;


use App\Domain\User\Contracts\Storage\UserStorageInterface;
use App\Domain\UserToken\Contracts\Storage\UserTokenStorageInterface;
use App\Infrastructure\Storage\UserStorage;
use App\Infrastructure\Storage\UserTokenStorage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserStorageInterface::class, UserStorage::class);
        $this->app->bind(UserTokenStorageInterface::class, UserTokenStorage::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       //
    }
}
