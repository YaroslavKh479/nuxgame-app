<?php

namespace App\Infrastructure\Mappers\GameHistory;

use App\Domain\GameHistory\Entities\GameHistory as DomainGameHistory;
use App\Infrastructure\Mappers\UserToken\UserTokenMapper;
use App\Infrastructure\Persistence\Models\GameHistory as EloquentDomainGameHistory;

class GameHistoryMapper
{
    public static function fromEloquent(EloquentDomainGameHistory $eloquentUser): DomainGameHistory
    {
        return new DomainGameHistory(
            UserTokenMapper::fromEloquent($eloquentUser->user_token),
            $eloquentUser->generated_number,
            $eloquentUser->result,
            $eloquentUser->prize,
            $eloquentUser->id
        );
    }
}
