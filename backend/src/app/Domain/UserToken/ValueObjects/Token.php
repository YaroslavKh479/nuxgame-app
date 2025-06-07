<?php

namespace App\Domain\UserToken\ValueObjects;
use Illuminate\Support\Str;

final class Token
{
    private string $value;

    public function __construct(string $value)
    {
        if (strlen($value) !== 32) {
            throw new \InvalidArgumentException('Invalid token length');
        }
        $this->value = $value;
    }

    public static function generate(): self
    {
        return new self(Str::random(32));
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(Token $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
