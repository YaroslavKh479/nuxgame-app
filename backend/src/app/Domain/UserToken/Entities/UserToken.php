<?php

namespace App\Domain\UserToken\Entities;

use App\Domain\User\Entities\User;
use App\Domain\UserToken\ValueObjects\Token;
use Carbon\Carbon;


final readonly class UserToken
{
    public function __construct(
        private User   $user,
        private Token  $token,
        private Carbon $expiresAt,
        private bool   $is_active = true,
        private ?int   $id = null,
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

    public function isIsActive(): bool
    {
        return $this->is_active;
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
