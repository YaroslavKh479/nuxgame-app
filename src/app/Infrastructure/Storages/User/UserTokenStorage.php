<?php

namespace App\Infrastructure\Storages\User;


use App\Domain\UserToken\Contracts\UserTokenStorageInterface;
use App\Domain\UserToken\Entities\UserToken;
use App\Infrastructure\Mappers\UserToken\UserTokenMapper;
use App\Infrastructure\Persistence\Models\UserToken as EloquentUserToken;

class UserTokenStorage implements UserTokenStorageInterface
{

    public function save(UserToken $userToken): UserToken
    {
        $eloquent = EloquentUserToken::find($userToken->getId()) ?? new EloquentUserToken();
        $eloquent->user_id = $userToken->getUser()->getId();
        $eloquent->token = $userToken->getToken()->getValue();
        $eloquent->expires_at = $userToken->getExpiresAt();
        $eloquent->is_active = $userToken->isIsActive();
        $eloquent->save();

        return UserTokenMapper::fromEloquent($eloquent);
    }

    public function deactivate(UserToken $userToken): UserToken
    {
        $eloquent = EloquentUserToken::find($userToken->getId());
        $eloquent->is_active = false;
        $eloquent->save();

        return UserTokenMapper::fromEloquent($eloquent);
    }
}
