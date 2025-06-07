<?php

namespace App\Infrastructure\Providers;


use App\Domain\User\Contracts\Repository\UserRepositoryInterface;
use App\Domain\User\Contracts\Storage\UserStorageInterface;
use App\Domain\UserToken\Contracts\Storage\UserTokenStorageInterface;
use app\Infrastructure\Storage\User\UserStorage;
use app\Infrastructure\Storage\User\UserTokenStorage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repositories
        $this->app->bind(UserRepositoryInterface::class, UserRepositoryInterface::class);

        // Storages
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
