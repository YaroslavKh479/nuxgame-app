<?php

namespace App\Http\Controllers\Token;

use App\Http\Controllers\Controller;
use App\Http\Requests\Token\CreateTokenRequest;
use Illuminate\Http\JsonResponse;

class TokenController extends Controller
{
    public function create(CreateTokenRequest $request): JsonResponse
    {
        return $this->response(fn() => $this->commandBus(new RegistrationCommand(...$request->validated())));
    }
}
