<?php

namespace App\Http\Controllers\Token;

use App\Application\Commands\Token\CreateToken\CreateTokenCommand;
use App\Application\Commands\Token\DeactivateToken\DeactivateTokenCommand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Token\TokenRequest;
use Illuminate\Http\JsonResponse;

class TokenController extends Controller
{
    public function create(TokenRequest $request): JsonResponse
    {
        return $this->response(fn() => $this->commandBus(new CreateTokenCommand(...$request->validated())));
    }

    public function deactivate(TokenRequest $request): JsonResponse
    {
        return $this->response(fn() => $this->commandBus(new DeactivateTokenCommand(...$request->validated())));
    }
}
