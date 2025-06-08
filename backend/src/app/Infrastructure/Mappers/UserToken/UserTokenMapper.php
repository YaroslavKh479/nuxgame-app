<?php

namespace App\Infrastructure\Mappers\UserToken;

use App\Domain\UserToken\ValueObjects\Token;
use App\Infrastructure\Mappers\User\UserMapper;
use App\Infrastructure\Persistence\Models\UserToken as EloquentUserToken;
use App\Domain\UserToken\Entities\UserToken as DomainUserToken;
use Carbon\Carbon;

final class UserTokenMapper
{
    public static function fromEloquent(EloquentUserToken $eloquentUserToken): DomainUserToken
    {
        return new DomainUserToken(
            UserMapper::fromEloquent($eloquentUserToken->user),
            new Token($eloquentUserToken->token),
            Carbon::parse($eloquentUserToken->expires_at),
            $eloquentUserToken->is_active,
            $eloquentUserToken->id
        );
    }
}
