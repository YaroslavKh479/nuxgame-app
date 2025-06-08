<?php

namespace App\Application\Commands\Registration;

use LaravelMediator\Abstracts\Buses\Command;

class RegistrationCommand extends Command
{
    public function __construct(
        private readonly string $name,
        private readonly string $phone_number,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

}
