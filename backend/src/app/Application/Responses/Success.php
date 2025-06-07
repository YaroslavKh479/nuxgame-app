<?php

namespace app\Application\Responses;

use Illuminate\Http\JsonResponse;

class Success
{
    public function __construct(private $data, private readonly int $statusCode = 200){}

    public function toResponse(): JsonResponse
    {
        return new JsonResponse([
            'success' => true,
            'data' => $this->data
        ], $this->statusCode);
    }

}
