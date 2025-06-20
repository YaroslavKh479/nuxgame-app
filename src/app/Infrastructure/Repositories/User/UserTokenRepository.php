<?php

namespace App\Infrastructure\Repositories\User;


use App\Domain\UserToken\Contracts\UserTokenRepositoryInterface;
use App\Domain\UserToken\Entities\UserToken;
use App\Infrastructure\Mappers\UserToken\UserTokenMapper;
use App\Infrastructure\Persistence\Models\UserToken as EloquentUserToken;

class UserTokenRepository implements UserTokenRepositoryInterface
{

    public function getByToken(string $token) : ?UserToken
    {
        $eloquent = EloquentUserToken::with('user')->where('token', $token)->first();
        if ($eloquent) {
            return UserTokenMapper::fromEloquent($eloquent);
        }
        return null;
    }
}
