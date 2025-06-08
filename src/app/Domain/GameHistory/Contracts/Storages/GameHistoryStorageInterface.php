<?php

namespace App\Domain\GameHistory\Contracts\Storages;

use App\Domain\GameHistory\Entities\GameHistory;

interface GameHistoryStorageInterface
{

    public function save(GameHistory $gameHistory): GameHistory;

}
