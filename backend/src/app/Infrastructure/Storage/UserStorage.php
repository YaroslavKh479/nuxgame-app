<?php

namespace App\Infrastructure\Storage;

use App\Domain\User\Contracts\Storage\UserStorageInterface;
use App\Domain\User\Entities\User;
use App\Domain\User\ValueObjects\PhoneNumber;
use App\Infrastructure\Persistence\Models\User as EloquentUser;

class UserStorage implements UserStorageInterface
{
    public function create(string $name, PhoneNumber $phoneNumber): User
    {
        $eloquent = new EloquentUser();
        $eloquent->username = $name;
        $eloquent->phone = $phoneNumber->value();
        $eloquent->save();

        return new User($eloquent->username, new PhoneNumber($eloquent->phone), $eloquent->id);
    }

    public function save(User $user): User
    {
        $eloquent = EloquentUser::find($user->id) ?? new EloquentUser();
        $eloquent->username = $user->name;
        $eloquent->phone = $user->phoneNumber->value();
        $eloquent->save();

        return new User($eloquent->username, new PhoneNumber($eloquent->phone), $eloquent->id);
    }
}
