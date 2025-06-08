<?php

namespace App\Application\Commands\Registration;

use App\Application\Contracts\ClockInterface;
use App\Application\Responses\Success;
use App\Domain\User\Contracts\Repositories\UserRepositoryInterface;
use App\Domain\User\Contracts\Storages\UserStorageInterface;
use App\Domain\User\Entities\User;
use App\Domain\User\ValueObjects\PhoneNumber;
use App\Domain\UserToken\Contracts\Storages\UserTokenStorageInterface;
use App\Domain\UserToken\Entities\UserToken;
use App\Domain\UserToken\ValueObjects\Token;
use Illuminate\Support\Facades\DB;
use LaravelMediator\Abstracts\Buses\Handlers\CommandHandler;

class RegistrationCommandHandler extends CommandHandler
{

    public function __construct(
        private readonly ClockInterface $clock,
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserStorageInterface $userStorage,
        private readonly UserTokenStorageInterface $userTokenStorage
    )
    {
    }

    public function handle(RegistrationCommand $command): Success
    {

        if ($this->userRepository->existsByPhone($command->getPhoneNumber())) {
            throw new \DomainException(__('User already registered.'));
        }

        $userToken = DB::transaction(function () use ($command) {

            $user = $this->userStorage->save(new User(
                $command->getName(),
                new PhoneNumber($command->getPhoneNumber())
            ));

            return $this->userTokenStorage->save(new UserToken(
                $user,
                Token::generate(),
                $this->clock->now()->addDays((int)config('custom.token_expires_days'))
            ));

        });

        return new Success($userToken->getToken()->getValue());
    }
}
