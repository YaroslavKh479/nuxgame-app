<?php

namespace App\Domain\User\Entities;

use App\Domain\User\ValueObjects\PhoneNumber;

/**
 * @property string $name
 * @property PhoneNumber $phoneNumber
 * @property ?int $id
 */
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
