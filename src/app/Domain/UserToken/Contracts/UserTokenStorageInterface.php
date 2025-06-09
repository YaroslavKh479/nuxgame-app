<?php

namespace App\Domain\UserToken\Contracts;


use App\Domain\UserToken\Entities\UserToken;

interface UserTokenStorageInterface
{

    public function save(UserToken $userToken): UserToken;

    public function deactivate(UserToken $userToken): UserToken;

}
