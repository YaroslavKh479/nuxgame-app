<?php

namespace App\Application\Commands\Registration;

use App\Application\Responses\ErrorResponse;
use App\Application\Responses\SuccessResponse;
use App\Domain\User\Contracts\Repositories\UserRepositoryInterface;
use App\Domain\User\Contracts\Storages\UserStorageInterface;
use App\Domain\User\Entities\User;
use App\Domain\User\ValueObjects\PhoneNumber;
use App\Domain\UserToken\Contracts\Storages\UserTokenStorageInterface;
use App\Domain\UserToken\Entities\UserToken;
use App\Domain\UserToken\ValueObjects\Token;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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

        /** @var UserToken $userToken */
        $userToken = DB::transaction(function () use ($command) {

            $user = $this->userStorage->save(new User(
                $command->getName(),
                new PhoneNumber($command->getPhoneNumber())
            ));

            return $this->userTokenStorage->save(new UserToken(
                $user,
                Token::generate(),
                Carbon::now()->addDays((int)config('custom.token_expires_days'))
            ));
        });

        return new SuccessResponse([
            'id'    => $userToken->user->id,
            'name'  => $userToken->user->name,
            'token' => $userToken->token->getValue(),
        ]);
    }
}
