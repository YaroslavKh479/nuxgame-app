<?php

namespace App\Application\Command\Registration;

use app\Application\Responses\ErrorResponse;
use app\Application\Responses\SuccessResponse;
use App\Domain\User\Entities\User;
use App\Domain\User\ValueObjects\PhoneNumber;
use App\Domain\User\Contracts\Repositories\UserRepositoryInterface;
use App\Domain\User\Contracts\Storages\UserStorageInterface;
use App\Domain\UserToken\Contracts\Storages\UserTokenStorageInterface;
use App\Domain\UserToken\Entities\UserToken\UserToken;
use App\Domain\UserToken\Entities\ValueObjects\Token;
use LaravelMediator\Abstracts\Buses\Handlers\CommandHandler;
use Symfony\Component\HttpFoundation\Response;

class RegistrationCommandHandler extends CommandHandler
{

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserStorageInterface $userStorage,
        private readonly UserTokenStorageInterface $userTokenStorage
    )
    {
    }

    public function handle(RegistrationCommand $command): SuccessResponse | ErrorResponse
    {

        if ($this->userRepository->existsByPhone($command->getPhoneNumber())) {
            return new ErrorResponse(
                message: __('User already registered.'),
                statusCode: Response::HTTP_CONFLICT
            );
        }

        $user = $this->userStorage->save(new User(
            $command->getName(),
            new PhoneNumber($command->getPhoneNumber())
        ));

        $userToken = $this->userTokenStorage->save(new UserToken(
            $user,
            Token::generate()
        ));

        return new SuccessResponse([
            'id'    => $user->id,
            'name'  => $user->name,
            'token' => $userToken->token,
        ]);
    }
}
