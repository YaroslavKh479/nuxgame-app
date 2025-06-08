<?php

namespace App\Domain\GameHistory\Entities;

use App\Domain\GameHistory\Enums\GameResult;
use App\Domain\UserToken\Entities\UserToken;

final readonly class GameHistory
{

    public function __construct(
        private UserToken  $user_token,
        private int        $generated_number,
        private GameResult $result,
        private float      $prize,
        private ?int       $id = null,
    )
    {
    }

    public function getUserToken(): UserToken
    {
        return $this->user_token;
    }

    public function getGeneratedNumber(): int
    {
        return $this->generated_number;
    }

    public function getResult(): GameResult
    {
        return $this->result;
    }

    public function getPrize(): float
    {
        return round($this->prize, 2);
    }

    public function getId(): ?int
    {
        return $this->id;
    }


}
