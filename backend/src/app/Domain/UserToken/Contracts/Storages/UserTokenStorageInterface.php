<?php

namespace App\Domain\UserToken\Contracts\Storages;


use App\Domain\UserToken\Entities\UserToken;

interface UserTokenStorageInterface
{

    public function save(UserToken $userToken): UserToken;

    public function delete(int $id): bool;

}
