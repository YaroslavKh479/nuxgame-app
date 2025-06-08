<?php

namespace App\Infrastructure\Clock;

use App\Application\Contracts\ClockInterface;
use Carbon\Carbon;

class SystemClock implements ClockInterface
{
    public function now(): Carbon
    {
        return Carbon::now();
    }
}
