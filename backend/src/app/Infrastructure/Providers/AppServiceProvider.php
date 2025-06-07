<?php

namespace App\Infrastructure\Providers;



use App\Domain\User\Contracts\Repositories\UserRepositoryInterface;
use App\Domain\User\Contracts\Storages\UserStorageInterface;
use App\Domain\UserToken\Contracts\Storages\UserTokenStorageInterface;
use App\Infrastructure\Repositories\User\UserRepository;
use App\Infrastructure\Storages\User\UserStorage;
use App\Infrastructure\Storages\User\UserTokenStorage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repositories
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

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
