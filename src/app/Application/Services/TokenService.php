<?php

namespace App\Application\Services;

use App\Application\Contracts\ClockInterface;
use App\Domain\UserToken\Contracts\UserTokenRepositoryInterface;
use App\Domain\UserToken\Entities\UserToken;

class TokenService
{
    public function __construct(
        private readonly ClockInterface $clock,
        private readonly UserTokenRepositoryInterface $userTokenRepository,
    ) {}

    public function getValidTokenOrFail(string $token): UserToken
    {
        $userToken = $this->userTokenRepository->getByToken($token);

        if (!$userToken || $userToken->isExpired($this->clock) || !$userToken->isIsActive()) {
            throw new \DomainException(__('Token is invalid or expired.'));
        }

        return $userToken;
    }
}
