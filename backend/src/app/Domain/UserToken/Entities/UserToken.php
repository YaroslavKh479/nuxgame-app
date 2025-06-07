<?php

namespace App\Domain\UserToken\Entities\UserToken;

use App\Domain\User\Entities\User;
use App\Domain\UserToken\Entities\ValueObjects\Token;

final class UserToken
{
    public function __construct(
        public User $user,
        public Token $token,
        public ?int $id = null,
    )
    {
    }
}
