<?php

namespace App\Application\Commands\Game\Play;

use LaravelMediator\Abstracts\Buses\Command;

class PlayCommand extends Command
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
