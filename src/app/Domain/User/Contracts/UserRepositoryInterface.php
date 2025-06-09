<?php

namespace App\Domain\User\Contracts;

use App\Domain\User\Entities\User;

interface UserRepositoryInterface
{

    public function existsByPhone(string $phone) : bool;

    public function getByToken(string $token) : ?User;

}
