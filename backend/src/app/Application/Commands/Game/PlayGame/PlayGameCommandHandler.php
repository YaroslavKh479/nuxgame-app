<?php

namespace App\Application\Commands\Game\PlayGame;

use app\Application\Responses\Success;
use App\Application\Services\GameService;
use App\Application\Services\TokenService;
use App\Domain\GameHistory\Contracts\Storages\GameHistoryStorageInterface;
use App\Domain\GameHistory\Entities\GameHistory;
use LaravelMediator\Abstracts\Buses\Handlers\CommandHandler;

class PlayGameCommandHandler extends CommandHandler
{

    public function __construct(
        private readonly TokenService $tokenService,
        private readonly GameService $gameService,
        private readonly GameHistoryStorageInterface $gameHistoryStorage
    )
    {
    }

    public function handle(PlayGameCommand $command): Success
    {

        $userToken = $this->tokenService->getValidTokenOrFail($command->getToken());

        $gameResult = $this->gameService->playFeelingLucky();

        $newGameHistory = $this->gameHistoryStorage->save(new GameHistory(
            user_token:         $userToken,
            generated_number:   $gameResult->generatedNumber,
            result:             $gameResult->result,
            prize:              $gameResult->prize,
        ));

        return new Success([
            'number'    => $newGameHistory->getGeneratedNumber(),
            'result'    => $newGameHistory->getResult(),
            'prize'     => $newGameHistory->getPrize(),
        ]);
    }

}
