<?php

namespace App\Application\Services;

use App\Application\DTOs\Game\FeelingLuckyResultDto;
use App\Domain\GameHistory\Enums\GameResult;

final class GameService
{

    public function play(): FeelingLuckyResultDto
    {

        $generatedNumber = rand(1, 1000);
        $isWin = $generatedNumber % 2 === 0;
        $prize = 0;

        if ($isWin) {
            if ($generatedNumber > 900) {
                $prize = $generatedNumber * 0.7;
            } elseif ($generatedNumber > 600) {
                $prize = $generatedNumber * 0.5;
            } elseif ($generatedNumber > 300) {
                $prize = $generatedNumber * 0.3;
            } else {
                $prize = $generatedNumber * 0.1;
            }
        }

        return new FeelingLuckyResultDto(
            generatedNumber: $generatedNumber,
            result: $isWin ? GameResult::WIN : GameResult::LOSE,
            prize: $prize,
        );
    }

}
