<?php

namespace App\Domain\User\Entities;

use App\Domain\User\ValueObjects\PhoneNumber;

/**
 * @property string $name
 * @property PhoneNumber $phoneNumber
 * @property ?int $id
 */
final class User
{
    public function __construct(
        private readonly string $name,
        private readonly PhoneNumber $phoneNumber,
        private readonly ?int $id = null,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhoneNumber(): PhoneNumber
    {
        return $this->phoneNumber;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

}
