<?php

namespace app\Infrastructure\Storages\User;

use App\Domain\User\Contracts\Storage\UserStorageInterface;
use App\Domain\User\Entities\User;
use App\Domain\User\ValueObjects\PhoneNumber;
use App\Infrastructure\Persistence\Models\User as EloquentUser;

class UserStorage implements UserStorageInterface
{

    public function save(User $user): User
    {
        $eloquent = EloquentUser::find($user->id) ?? new EloquentUser();
        $eloquent->username = $user->name;
        $eloquent->phone = $user->phoneNumber->value();
        $eloquent->save();

        return new User($eloquent->username, new PhoneNumber($eloquent->phone), $eloquent->id);
    }

}
