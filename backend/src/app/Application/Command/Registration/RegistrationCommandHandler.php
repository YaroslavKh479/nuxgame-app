<?php

namespace App\Application\Command\Registration;

use App\Application\DTO\Result;
use App\Domain\User\Contracts\Storage\UserStorageInterface;
use App\Domain\User\Entities\User;
use App\Domain\User\ValueObjects\PhoneNumber;

use LaravelMediator\Abstracts\Buses\Handlers\CommandHandler;

class RegistrationCommandHandler extends CommandHandler
{

    public function __construct(
        private readonly UserStorageInterface $userStorage,
    )
    {
    }

    public function handle(RegistrationCommand $command): Result
    {

        $phoneVO = new PhoneNumber($command->getPhoneNumber());

        $user = new User($command->getName(), $phoneVO);

        $user->generateToken();

        $savedUser = $this->userStorage->save($user);

        return new Result(data: [
            'id'    => $savedUser->id,
            'name'  => $savedUser->name,
            'token' => $savedUser->token,
        ]);
    }

}
