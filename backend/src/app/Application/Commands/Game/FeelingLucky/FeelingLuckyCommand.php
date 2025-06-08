<?php

namespace App\Application\Commands\Game\FeelingLucky;

use LaravelMediator\Abstracts\Buses\Command;

class FeelingLuckyCommand extends Command
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
