<?php

namespace App\Domain\User\Contracts\Repositories;

use App\Domain\User\Entities\User;

interface UserRepositoryInterface
{

    public function existsByPhone(string $phone) : bool;

    public function getByToken(string $token) : ?User;

}
