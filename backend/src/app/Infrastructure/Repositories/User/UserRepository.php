<?php

namespace App\Infrastructure\Repositories\User;


use App\Domain\User\Contracts\Repositories\UserRepositoryInterface;
use App\Infrastructure\Persistence\Models\User as EloquentUser;

class UserRepository implements UserRepositoryInterface
{

    public function existsByPhone(string $phone): bool
    {
        return EloquentUser::where('phone',$phone)->exists();
    }
}
