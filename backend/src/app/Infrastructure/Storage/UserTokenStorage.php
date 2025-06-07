<?php

namespace App\Infrastructure\Storage;

use App\Domain\UserToken\Contracts\Storage\UserTokenStorageInterface;
use App\Domain\UserToken\Entities\UserToken\UserToken;
use App\Domain\UserToken\Entities\ValueObjects\Token;
use App\Infrastructure\Persistence\Models\UserToken as EloquentUserToken;

class UserTokenStorage implements UserTokenStorageInterface
{

    public function save(UserToken $userToken): UserToken
    {
        $eloquent = EloquentUserToken::find($userToken->id) ?? new EloquentUserToken();
        $eloquent->user_id = $userToken->user->id;
        $eloquent->token = $userToken->token->value();
        $eloquent->save();

        return new UserToken($eloquent->user_id, new Token($eloquent->token), $eloquent->id);
    }

}
