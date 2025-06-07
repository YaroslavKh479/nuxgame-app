<?php

namespace App\Domain\User\Entities;

use App\Domain\User\ValueObjects\PhoneNumber;
use Illuminate\Support\Str;

class User
{
    public ?int $id = null;
    public string $name;
    public PhoneNumber $phoneNumber;
    public ?string $token = null;

    public function __construct(string $name, PhoneNumber $phoneNumber, ?int $id = null, ?string $token = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->token = $token;
    }

    public function generateToken(): void
    {
        $this->token = Str::random(32);
    }

    public function hasToken(): bool
    {
        return !empty($this->token);
    }
}
