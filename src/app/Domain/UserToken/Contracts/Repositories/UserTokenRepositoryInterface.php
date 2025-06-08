<?php

namespace App\Domain\UserToken\Contracts\Repositories;


use App\Domain\UserToken\Entities\UserToken;

interface UserTokenRepositoryInterface
{

    public function getByToken(string $token): ?UserToken;



}
