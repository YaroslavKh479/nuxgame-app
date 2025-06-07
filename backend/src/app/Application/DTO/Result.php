<?php

namespace App\Application\DTO;

readonly class Result
{

    public function __construct(
        private bool $success = true,
        private mixed $data = null,
        private ?array $errors = null,
        private ?int $code = null,
    ){}

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function getErrors(): ?array
    {
        return $this->errors;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

}
