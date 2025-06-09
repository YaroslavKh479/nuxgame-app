<?php

namespace App\Application\Commands\Token\CreateToken;

use LaravelMediator\Abstracts\Buses\Command;

class CreateTokenCommand extends Command
{

    public function __construct(
        private readonly string $token
    )
    {
    }

    public function getToken(): string
    {
        return $this->token;
    }

}
