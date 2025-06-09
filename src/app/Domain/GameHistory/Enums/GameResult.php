<?php

namespace App\Domain\GameHistory\Enums;

enum GameResult: string
{
    case WIN = 'win';
    case LOSE = 'lose';
}
