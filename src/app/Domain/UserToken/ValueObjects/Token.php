<?php

namespace App\Domain\UserToken\ValueObjects;
use Random\RandomException;

final class Token
{
    private string $value;

    public function __construct(string $value)
    {
        if (strlen($value) !== 64) {
            throw new \InvalidArgumentException('Invalid token length');
        }
        $this->value = $value;
    }

    /**
     * @throws RandomException
     */
    public static function generate(): self
    {
        return new self(bin2hex(random_bytes(32)));
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return hash_equals($this->value, $other->getValue());
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
