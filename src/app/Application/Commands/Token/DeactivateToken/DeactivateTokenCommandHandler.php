<?php

namespace App\Application\Commands\Token\DeactivateToken;

use App\Application\Responses\Success;
use App\Application\Services\TokenService;
use App\Domain\UserToken\Contracts\UserTokenStorageInterface;
use LaravelMediator\Abstracts\Buses\Handlers\CommandHandler;

class DeactivateTokenCommandHandler extends CommandHandler
{

    public function __construct(
        private readonly TokenService $tokenService,
        private readonly UserTokenStorageInterface $userTokenStorage
    )
    {
    }

    public function handle(DeactivateTokenCommand $command): Success
    {
        $userToken = $this->tokenService->getValidTokenOrFail($command->getToken());
        $this->userTokenStorage->deactivate($userToken);
        return new Success(true);
    }
}
