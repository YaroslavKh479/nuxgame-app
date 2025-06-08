<?php

namespace app\Application\DTOs\Game;

use App\Domain\GameHistory\Enums\GameResult;

final readonly class FeelingLuckyResultDto
{

    public function __construct(
        public int $generatedNumber,
        public GameResult $result,
        public float $prize
    )
    {
    }

}
