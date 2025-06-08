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
        private readonly User $user,
        private readonly Token $token,
        private readonly Carbon $expiresAt,
        private readonly ?int $id = null,
    )
    {
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getToken(): Token
    {
        return $this->token;
    }

    public function getExpiresAt(): Carbon
    {
        return $this->expiresAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function isExpired(): bool
    {
        return $this->expiresAt < Carbon::now();
    }

}
