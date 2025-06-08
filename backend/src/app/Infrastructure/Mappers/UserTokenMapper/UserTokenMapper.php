<?php

namespace App\Infrastructure\Mappers\UserTokenMapper;
use App\Domain\UserToken\ValueObjects\Token;
use App\Infrastructure\Mappers\UserMapper\UserMapper;
use App\Infrastructure\Persistence\Models\UserToken as EloquentUserToken;
use App\Domain\UserToken\Entities\UserToken as DomainUserToken;
use Carbon\Carbon;

final class UserTokenMapper
{
    public static function fromEloquent(EloquentUserToken $eloquentUserToken): DomainUserToken
    {
        $user = UserMapper::fromEloquent($eloquentUserToken->user);

        return new DomainUserToken(
            $user,
            new Token($eloquentUserToken->token),
            Carbon::parse($eloquentUserToken->expires_at),
            $eloquentUserToken->id
        );
    }
}
