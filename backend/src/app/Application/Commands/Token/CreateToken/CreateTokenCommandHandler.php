<?php

namespace App\Application\Commands\Token\CreateToken;

use App\Application\Responses\Success;
use App\Application\Services\TokenService;
use App\Domain\UserToken\Contracts\Storages\UserTokenStorageInterface;
use App\Domain\UserToken\Entities\UserToken;
use App\Domain\UserToken\ValueObjects\Token;
use Carbon\Carbon;
use LaravelMediator\Abstracts\Buses\Handlers\CommandHandler;

class CreateTokenCommandHandler extends CommandHandler
{

    public function __construct(
        private readonly TokenService $tokenService,
        private readonly UserTokenStorageInterface $userTokenStorage
    )
    {
    }

    public function handle(CreateTokenCommand $command): Success
    {
        $userToken = $this->tokenService->getValidTokenOrFail($command->getToken());

        $userToken = $this->userTokenStorage->save(new UserToken(
            $userToken->getUser(),
            Token::generate(),
            Carbon::now()->addDays((int)config('custom.token_expires_days'))
        ));

        return new Success($userToken->getToken()->getValue());
    }
}
