<?php

namespace App\Application\Contracts;

use Carbon\Carbon;

interface ClockInterface
{
    public function now(): Carbon;
}
