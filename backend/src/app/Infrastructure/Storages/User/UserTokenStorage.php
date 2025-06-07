<?php

namespace App\Infrastructure\Storages\User;


use App\Domain\UserToken\Contracts\Storages\UserTokenStorageInterface;

use App\Domain\UserToken\Entities\UserToken;
use App\Domain\UserToken\ValueObjects\Token;
use App\Infrastructure\Persistence\Models\UserToken as EloquentUserToken;

class UserTokenStorage implements UserTokenStorageInterface
{

    public function save(UserToken $userToken): UserToken
    {
        $eloquent = EloquentUserToken::find($userToken->id) ?? new EloquentUserToken();
        $eloquent->user_id = $userToken->user->id;
        $eloquent->token = $userToken->token->getValue();
        $eloquent->expires_at = $userToken->expiresAt;
        $eloquent->save();

        return new UserToken($userToken->user, new Token($eloquent->token), $userToken->expiresAt, $eloquent->id);
    }

    public function delete(int $id): bool
    {
        return EloquentUserToken::where('id',$id)->delete();
    }
}
