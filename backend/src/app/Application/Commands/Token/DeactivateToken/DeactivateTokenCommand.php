<?php

namespace App\Application\Commands\Token\DeactivateToken;

use LaravelMediator\Abstracts\Buses\Command;

class DeactivateTokenCommand extends Command
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
