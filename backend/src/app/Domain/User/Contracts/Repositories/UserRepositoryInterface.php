<?php

namespace App\Domain\User\Contracts\Repositories;

interface UserRepositoryInterface
{

    public function existsByPhone(string $phone) : bool;

}
