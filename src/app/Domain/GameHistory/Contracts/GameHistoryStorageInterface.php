<?php

namespace App\Domain\GameHistory\Contracts;

use App\Domain\GameHistory\Entities\GameHistory;

interface GameHistoryStorageInterface
{

    public function save(GameHistory $gameHistory): GameHistory;

}
