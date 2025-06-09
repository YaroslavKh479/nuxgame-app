<?php

namespace App\Application\Queries\History;

use LaravelMediator\Abstracts\Buses\Command;

class HistoryCommand extends Command
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
