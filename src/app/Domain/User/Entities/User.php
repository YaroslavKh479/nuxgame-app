<?php

namespace App\Domain\User\Entities;

use App\Domain\User\ValueObjects\PhoneNumber;


final readonly class User
{
    public function __construct(
        private string      $name,
        private PhoneNumber $phoneNumber,
        private ?int        $id = null,
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
