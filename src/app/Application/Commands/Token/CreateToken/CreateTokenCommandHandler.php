<?php

namespace App\Application\Commands\Token\CreateToken;

use App\Application\Contracts\ClockInterface;
use App\Application\Responses\Success;
use App\Domain\UserToken\Contracts\UserTokenRepositoryInterface;
use App\Domain\UserToken\Contracts\UserTokenStorageInterface;
use App\Domain\UserToken\Entities\UserToken;
use App\Domain\UserToken\ValueObjects\Token;
use LaravelMediator\Abstracts\Buses\Handlers\CommandHandler;

class CreateTokenCommandHandler extends CommandHandler
{

    public function __construct(
        private readonly ClockInterface $clock,
        private readonly UserTokenRepositoryInterface $userTokenRepository,
        private readonly UserTokenStorageInterface $userTokenStorage
    )
    {
    }

    public function handle(CreateTokenCommand $command): Success
    {
        $userToken = $this->userTokenRepository->getByToken($command->getToken());

        $newUserToken = $this->userTokenStorage->save(new UserToken(
            $userToken->getUser(),
            Token::generate(),
            $this->clock->now()->addDays((int)config('custom.token_expires_days'))
        ));

        return new Success($newUserToken->getToken()->getValue());
    }
}
