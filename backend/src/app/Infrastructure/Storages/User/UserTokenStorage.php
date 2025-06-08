<?php

namespace App\Infrastructure\Storages\User;


use App\Domain\UserToken\Contracts\Storages\UserTokenStorageInterface;

use App\Domain\UserToken\Entities\UserToken;
use App\Domain\UserToken\ValueObjects\Token;
use App\Infrastructure\Mappers\UserTokenMapper\UserTokenMapper;
use App\Infrastructure\Persistence\Models\UserToken as EloquentUserToken;

class UserTokenStorage implements UserTokenStorageInterface
{

    public function save(UserToken $userToken): UserToken
    {
        $eloquent = EloquentUserToken::find($userToken->getId()) ?? new EloquentUserToken();
        $eloquent->user_id = $userToken->getUser()->getId();
        $eloquent->token = $userToken->getToken()->getValue();
        $eloquent->expires_at = $userToken->getExpiresAt();
        $eloquent->save();

        return UserTokenMapper::fromEloquent($eloquent);
    }

    public function delete(int $id): bool
    {
        return EloquentUserToken::where('id',$id)->delete();
    }
}
