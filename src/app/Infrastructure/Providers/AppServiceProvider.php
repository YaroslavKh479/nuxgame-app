<?php

namespace App\Infrastructure\Providers;



use App\Application\Contracts\ClockInterface;
use App\Domain\GameHistory\Contracts\GameHistoryRepositoryInterface;
use App\Domain\GameHistory\Contracts\GameHistoryStorageInterface;
use App\Domain\User\Contracts\UserRepositoryInterface;
use App\Domain\User\Contracts\UserStorageInterface;
use App\Domain\UserToken\Contracts\UserTokenRepositoryInterface;
use App\Domain\UserToken\Contracts\UserTokenStorageInterface;
use App\Infrastructure\Common\Clock\SystemClock;
use App\Infrastructure\Repositories\GameHistory\GameHistoryRepository;
use App\Infrastructure\Repositories\User\UserRepository;
use App\Infrastructure\Repositories\User\UserTokenRepository;
use App\Infrastructure\Storages\GameHistory\GameHistoryStorageStorage;
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
        $this->app->bind(UserTokenRepositoryInterface::class, UserTokenRepository::class);
        $this->app->bind(GameHistoryRepositoryInterface::class, GameHistoryRepository::class);

        // Storages
        $this->app->bind(UserStorageInterface::class, UserStorage::class);
        $this->app->bind(UserTokenStorageInterface::class, UserTokenStorage::class);
        $this->app->bind(GameHistoryStorageInterface::class, GameHistoryStorageStorage::class);

        // Clock system
        $this->app->singleton(ClockInterface::class, SystemClock::class);

        // For tests
       // $this->app->singleton(ClockInterface::class, FixedClock::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       //
    }
}
