<?php

namespace App\Infrastructure\Repositories\User;

use App\Domain\User\Contracts\Repository\UserRepositoryInterface;
use app\Infrastructure\Persistence\Models\User as EloquentUser;

class UserRepository implements UserRepositoryInterface
{

    public function existsByPhone(string $phone): bool
    {
        return EloquentUser::where('phone',$phone)->exists();
    }
}
