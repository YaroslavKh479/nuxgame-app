<?php

namespace App\Application\Commands\Game\PlayGame;

use LaravelMediator\Abstracts\Buses\Command;

class PlayGameCommand extends Command
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
