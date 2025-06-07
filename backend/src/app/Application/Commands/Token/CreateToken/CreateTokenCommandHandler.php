<?php

namespace App\Application\Commands\Token\CreateToken;

use App\Application\Responses\ErrorResponse;
use App\Application\Responses\SuccessResponse;
use App\Domain\User\Entities\User;
use App\Domain\User\ValueObjects\PhoneNumber;
use App\Domain\UserToken\Contracts\Repositories\UserTokenRepositoryInterface;
use App\Domain\UserToken\Contracts\Storages\UserTokenStorageInterface;
use App\Domain\UserToken\Entities\UserToken;
use App\Domain\UserToken\ValueObjects\Token;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use LaravelMediator\Abstracts\Buses\Handlers\CommandHandler;
use Symfony\Component\HttpFoundation\Response;

class CreateTokenCommandHandler extends CommandHandler
{

    public function __construct(
        private readonly UserTokenRepositoryInterface $userTokenRepository,
        private readonly UserTokenStorageInterface $userTokenStorage
    )
    {
    }

    public function handle(CreateTokenCommand $command): SuccessResponse | ErrorResponse
    {

        $userToken = $this->userTokenRepository->getByToken($command->getToken());

        if (!$userToken || $userToken->isExpired()) {
            throw new \DomainException( __('Token is invalid or expired.'));
        }

        $userToken = $this->userTokenStorage->save(new UserToken(
            $userToken->user,
            Token::generate(),
            Carbon::now()->addDays((int)config('custom.token_expires_days'))
        ));

        return new SuccessResponse([
            'id'    => $userToken->user->id,
            'name'  => $userToken->user->name,
            'token' => $userToken->token->getValue(),
        ]);
    }
}
