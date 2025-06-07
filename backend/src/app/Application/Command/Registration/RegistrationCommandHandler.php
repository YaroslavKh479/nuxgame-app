<?php

namespace App\Application\Command\Registration;

use App\Application\DTO\Result;
use App\Domain\User\Contracts\Storage\UserStorageInterface;
use App\Domain\User\Entities\User;
use App\Domain\User\ValueObjects\PhoneNumber;

use App\Domain\UserToken\Contracts\Storage\UserTokenStorageInterface;
use App\Domain\UserToken\Entities\UserToken\UserToken;
use App\Domain\UserToken\Entities\ValueObjects\Token;
use LaravelMediator\Abstracts\Buses\Handlers\CommandHandler;

class RegistrationCommandHandler extends CommandHandler
{

    public function __construct(
        private readonly UserStorageInterface $userStorage,
        private readonly UserTokenStorageInterface $userTokenStorage
    )
    {
    }

    public function handle(RegistrationCommand $command): Result
    {
        $user = $this->userStorage->save(new User(
                $command->getName(), new PhoneNumber($command->getPhoneNumber())
        ));

        $userToken = $this->userTokenStorage->save(new UserToken(
            $user,Token::generate()
        ));

        return new Result(data: [
            'id'    => $user->id,
            'name'  => $user->name,
            'token' => $userToken->token,
        ]);
    }
}
