<?php

namespace App\Application\Services;

use App\Domain\UserToken\Contracts\UserTokenRepositoryInterface;
use App\Domain\UserToken\Entities\UserToken;

class TokenService
{
    public function __construct(
        private readonly UserTokenRepositoryInterface $userTokenRepository,
    ) {}

    public function getValidTokenOrFail(string $token): UserToken
    {
        $userToken = $this->userTokenRepository->getByToken($token);

        if (!$userToken || $userToken->isExpired() || !$userToken->isIsActive()) {
            throw new \DomainException(__('Token is invalid or expired.'));
        }

        return $userToken;
    }
}
