<?php

namespace App\Infrastructure\Repositories\User;


use App\Domain\User\Contracts\Repositories\UserRepositoryInterface;
use App\Domain\User\Entities\User;
use App\Domain\User\ValueObjects\PhoneNumber;
use app\Infrastructure\Mappers\User\UserMapper;
use App\Infrastructure\Persistence\Models\User as EloquentUser;

class UserRepository implements UserRepositoryInterface
{

    public function existsByPhone(string $phone): bool
    {
        return EloquentUser::where('phone',$phone)->exists();
    }

    public function getByToken(string $token) : ?User
    {
        $eloquent = EloquentUser::whereHas(['tokens' => fn($q) => $q->where('token',$token) ])->first();
        if ($eloquent) {
            return UserMapper::fromEloquent($eloquent->user);
        }

        return null;
    }
}
