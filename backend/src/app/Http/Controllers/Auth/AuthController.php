<?php

namespace app\Http\Controllers\Auth;



use App\Application\Command\Registration\RegistrationCommand;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function registration(RegistrationRequest $request): JsonResponse
    {
        return $this->response(fn() => $this->commandBus(new RegistrationCommand(...$request->validated())));
    }

}
