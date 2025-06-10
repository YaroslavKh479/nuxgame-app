<?php

namespace App\Domain\User\ValueObjects;

final class PhoneNumber
{
    private string $digits;

    public function __construct(string $raw)
    {
        $digits = preg_replace('/\D/', '', $raw);

        if ($digits === null || strlen($digits) < 7 || strlen($digits) > 15) {
            throw new \InvalidArgumentException('Invalid phone number.');
        }

        $this->digits = $digits;
    }

    public function value(): string
    {
        return $this->digits;
    }

    public function international(): string
    {
        return str_starts_with($this->digits, '+')
            ? $this->digits
            : '+' . $this->digits;
    }

    public function __toString(): string
    {
        return $this->digits;
    }

    public function equals(self $other): bool
    {
        return $this->digits === $other->value();
    }
}
