<?php

namespace App\Infrastructure\Storages\User;


use App\Domain\User\Contracts\Storages\UserStorageInterface;
use App\Domain\User\Entities\User;
use App\Infrastructure\Mappers\User\UserMapper;
use App\Infrastructure\Persistence\Models\User as EloquentUser;

class UserStorage implements UserStorageInterface
{

    public function save(User $user): User
    {
        $eloquent = EloquentUser::find($user->getId()) ?? new EloquentUser();
        $eloquent->name = $user->getName();
        $eloquent->phone = $user->getPhoneNumber()->value();
        $eloquent->save();

        return UserMapper::fromEloquent($eloquent);
    }

}
