<?php

namespace App\Domain\User\Entities;

use App\Domain\User\ValueObjects\PhoneNumber;

class User
{
    public function __construct(
        public string $name,
        public PhoneNumber $phoneNumber,
        public ?int $id = null,
    )
    {
    }

}
