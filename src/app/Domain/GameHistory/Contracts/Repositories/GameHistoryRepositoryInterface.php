<?php

namespace App\Domain\GameHistory\Contracts\Repositories;

use Illuminate\Support\Collection;

interface GameHistoryRepositoryInterface
{
    public function getAll(int $user_token_id, int $limit) : Collection;

}
