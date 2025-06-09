<?php

namespace App\Infrastructure\Mappers\User;

use App\Domain\User\Entities\User as DomainUser;
use App\Domain\User\ValueObjects\PhoneNumber;
use App\Infrastructure\Persistence\Models\User as EloquentUser;

final class UserMapper
{
    public static function fromEloquent(EloquentUser $eloquentUser): DomainUser
    {
        return new DomainUser(
            $eloquentUser->name,
            new PhoneNumber($eloquentUser->phone),
            $eloquentUser->id
        );
    }
}
