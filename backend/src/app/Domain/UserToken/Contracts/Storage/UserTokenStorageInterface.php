<?php

namespace App\Domain\UserToken\Contracts\Storage;

use App\Domain\UserToken\Entities\UserToken\UserToken;

interface UserTokenStorageInterface
{

    public function save(UserToken $userToken): UserToken;



}
