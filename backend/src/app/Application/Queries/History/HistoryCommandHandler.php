<?php

namespace App\Application\Queries\History;

use App\Application\Contracts\ClockInterface;
use App\Application\Responses\Success;
use App\Application\Services\TokenService;
use App\Domain\GameHistory\Contracts\Repositories\GameHistoryRepositoryInterface;
use App\Infrastructure\Cache\CacheKey;
use Illuminate\Support\Facades\Cache;
use LaravelMediator\Abstracts\Buses\Handlers\CommandHandler;

class HistoryCommandHandler extends CommandHandler
{

    public function __construct(
        private readonly ClockInterface $clock,
        private readonly TokenService $tokenService,
        private readonly GameHistoryRepositoryInterface $gameHistoryRepository,
    )
    {
    }

    public function handle(HistoryCommand $command): Success
    {
        $userToken = $this->tokenService->getValidTokenOrFail($command->getToken());
        return new Success(
            Cache::remember(
                CacheKey::TOKEN_GAME_HISTORY->makeKey($userToken->getToken()),
                $this->clock->now()->addHour(),
                fn() => $this->gameHistoryRepository->getAll($userToken->getId(), 3)
            )
        );
    }

}
