<?php

namespace App\Http\Controllers\Auth;

use App\Application\Commands\Registration\RegistrationCommand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function registration(RegistrationRequest $request): JsonResponse
    {
        return $this->response(fn() => $this->commandBus(new RegistrationCommand(...$request->validated())));
    }

}
