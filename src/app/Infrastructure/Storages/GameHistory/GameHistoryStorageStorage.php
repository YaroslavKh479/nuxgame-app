<?php

namespace App\Infrastructure\Storages\GameHistory;

use App\Domain\GameHistory\Contracts\GameHistoryStorageInterface;
use App\Domain\GameHistory\Entities\GameHistory;
use App\Infrastructure\Mappers\GameHistory\GameHistoryMapper;
use App\Infrastructure\Persistence\Models\GameHistory as EloquentGameHistory;

class GameHistoryStorageStorage implements GameHistoryStorageInterface
{

    public function save(GameHistory $gameHistory): GameHistory
    {
        $eloquent = EloquentGameHistory::find($gameHistory->getId()) ?? new EloquentGameHistory();
        $eloquent->user_token_id = $gameHistory->getUserToken()->getId();
        $eloquent->generated_number = $gameHistory->getGeneratedNumber();
        $eloquent->result = $gameHistory->getResult();
        $eloquent->prize = $gameHistory->getPrize();
        $eloquent->save();

        return GameHistoryMapper::fromEloquent($eloquent);
    }
}
