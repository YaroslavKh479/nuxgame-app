<?php

namespace App\Application\Commands\Token\DeleteToken;

use LaravelMediator\Abstracts\Buses\Command;

class DeleteTokenCommand extends Command
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
