<?php

namespace App\Application\Commands\Token\DeleteToken;

use App\Application\Responses\Success;
use App\Application\Services\TokenService;
use App\Domain\UserToken\Contracts\Storages\UserTokenStorageInterface;
use LaravelMediator\Abstracts\Buses\Handlers\CommandHandler;

class DeleteTokenCommandHandler extends CommandHandler
{

    public function __construct(
        private readonly TokenService $tokenService,
        private readonly UserTokenStorageInterface $userTokenStorage
    )
    {
    }

    public function handle(DeleteTokenCommand $command): Success | \DomainException
    {

        $userToken = $this->tokenService->getValidTokenOrFail($command->getToken());

        $this->userTokenStorage->delete($userToken->id);

        return new Success(true);
    }
}
