<?php

namespace App\Domain\User\Contracts;

use App\Domain\User\Entities\User;

interface UserStorageInterface
{
    public function save(User $user): User;
}
