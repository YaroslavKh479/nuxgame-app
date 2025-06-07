<?php

namespace App\Application\Command\Registration;
use LaravelMediator\Abstracts\Buses\Command;

class RegistrationCommand extends Command
{
    public function __construct(
        private readonly string $name,
        private readonly string $phoneNumber,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

}
