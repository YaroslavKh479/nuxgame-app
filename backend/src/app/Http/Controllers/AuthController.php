<?php

namespace App\Http\Controllers;



use App\Application\Command\Registration\RegistrationCommand;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function registration(RegistrationRequest $request): JsonResponse
    {
        return $this->response(fn() => $this->commandBus(new RegistrationCommand(...$request->validated())));
    }

}
