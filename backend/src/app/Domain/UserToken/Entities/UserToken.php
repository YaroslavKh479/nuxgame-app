<?php

namespace App\Domain\UserToken\Entities;

use App\Domain\User\Entities\User;
use App\Domain\UserToken\ValueObjects\Token;
use Carbon\Carbon;

/**
 * @property User $user
 * @property Token $token
 * @property Carbon $expiresAt
 * @property ?int $id
 */

final class UserToken
{
    public function __construct(
        public User $user,
        public Token $token,
        public Carbon $expiresAt,
        public ?int $id = null,
    )
    {
    }


    public function isExpired(): bool
    {
        return $this->expiresAt < Carbon::now();
    }

}
