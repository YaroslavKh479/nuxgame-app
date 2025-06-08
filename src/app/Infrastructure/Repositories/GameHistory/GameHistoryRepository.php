<?php

namespace App\Infrastructure\Repositories\GameHistory;

use App\Domain\GameHistory\Contracts\Repositories\GameHistoryRepositoryInterface;
use Illuminate\Support\Collection;
use App\Infrastructure\Persistence\Models\GameHistory as EloquentGameHistory;
class GameHistoryRepository implements GameHistoryRepositoryInterface
{

    public function getAll(int $user_token_id, int $limit): Collection
    {
        return EloquentGameHistory::where('user_token_id', $user_token_id)
            ->select('generated_number','result','prize')
            ->latest()
            ->limit($limit)
            ->toBase()
            ->get();
    }
}
