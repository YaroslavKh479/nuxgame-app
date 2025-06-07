<?php

namespace App\Domain\User\ValueObjects;

use Illuminate\Support\Str;

final class PhoneNumber
{
    private string $digits;

    public function __construct(string $raw)
    {
        $digits = Str::replaceMatches('/\D/', '', $raw);

        if (Str::length($digits) < 7 || Str::length($digits) > 15) {
            throw new \InvalidArgumentException('Invalid phone number');
        }

        $this->digits = $digits;
    }

    public function value(): string
    {
        return $this->digits;
    }

    public function international(): string
    {
        return Str::start($this->digits, '+');
    }

    public function __toString(): string
    {
        return $this->digits;
    }

    public function equals(PhoneNumber $other): bool
    {
        return Str::is($this->digits, $other->value());
    }
}
