<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ErrorResponse
{
    public function __construct(private $message, private readonly int $statusCode = 400){}

    public function toResponse(): JsonResponse
    {
        return new JsonResponse([
            'success' => false,
            'errors' => $this->message
        ], $this->statusCode);
    }


}
