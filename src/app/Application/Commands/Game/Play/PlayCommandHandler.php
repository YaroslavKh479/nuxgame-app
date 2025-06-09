<?php

namespace App\Application\Commands\Game\Play;

use App\Application\Responses\Success;
use App\Application\Services\GameService;
use App\Application\Services\TokenService;
use App\Domain\GameHistory\Contracts\GameHistoryStorageInterface;
use App\Domain\GameHistory\Entities\GameHistory;
use App\Infrastructure\Common\Cache\CacheKey;
use Illuminate\Support\Facades\Cache;
use LaravelMediator\Abstracts\Buses\Handlers\CommandHandler;

class PlayCommandHandler extends CommandHandler
{

    public function __construct(
        private readonly TokenService $tokenService,
        private readonly GameService $gameService,
        private readonly GameHistoryStorageInterface $gameHistoryStorage
    )
    {
    }

    public function handle(PlayCommand $command): Success
    {

        $userToken = $this->tokenService->getValidTokenOrFail($command->getToken());

        $gameResult = $this->gameService->play();

        $newGameHistory = $this->gameHistoryStorage->save(new GameHistory(
            user_token:         $userToken,
            generated_number:   $gameResult->generatedNumber,
            result:             $gameResult->result,
            prize:              $gameResult->prize,
        ));

        Cache::forget(CacheKey::TOKEN_GAME_HISTORY->makeKey($userToken->getToken()));

        return new Success([
            'generated_number'      => $newGameHistory->getGeneratedNumber(),
            'result'                => $newGameHistory->getResult(),
            'prize'                 => $newGameHistory->getPrize(),
        ]);
    }

}
