<?php

namespace App\Domain\UserToken\Contracts;


use App\Domain\UserToken\Entities\UserToken;

interface UserTokenRepositoryInterface
{

    public function getByToken(string $token): ?UserToken;



}
