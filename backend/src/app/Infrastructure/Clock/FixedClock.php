<?php

namespace App\Infrastructure\Clock;

use App\Application\Contracts\ClockInterface;
use Carbon\Carbon;

class FixedClock implements ClockInterface
{
    private Carbon $fixedNow;

    public function __construct(Carbon $fixedNow)
    {
        $this->fixedNow = $fixedNow;
    }

    public function now(): Carbon
    {
        return $this->fixedNow;
    }
}
