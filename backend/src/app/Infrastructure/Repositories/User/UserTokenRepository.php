<?php

namespace app\Infrastructure\Repositories\User;


use App\Domain\User\Entities\User;
use App\Domain\UserToken\Entities\UserToken;
use App\Domain\User\ValueObjects\PhoneNumber;
use App\Domain\UserToken\Contracts\Repositories\UserTokenRepositoryInterface;
use App\Domain\UserToken\ValueObjects\Token;
use App\Infrastructure\Persistence\Models\UserToken as EloquentUserToken;
use Carbon\Carbon;

class UserTokenRepository implements UserTokenRepositoryInterface
{

    public function getByToken(string $token) : ?UserToken
    {
        $eloquent = EloquentUserToken::where('token', $token)->first();
        if ($eloquent) {
            $eloquent->load('user');
            $user = new User(
                $eloquent->user->name,
                new PhoneNumber($eloquent->user->phone),
                $eloquent->user->id
            );
            return new UserToken($user,new Token($eloquent->token),Carbon::parse($eloquent->expires_at), $eloquent->id);
        }

        return null;
    }
}
