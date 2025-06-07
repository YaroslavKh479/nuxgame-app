<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use LaravelMediator\Facades\CommandBus;
use LaravelMediator\Facades\QueryBus;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{

    protected function response(\Closure $closure): JsonResponse
    {
        $result = $closure();
        if ($result->isSuccess()) {
            return (new SuccessResponse($result->getData(), $result->getCode() ?? 200))->toResponse();
        }

        return (new ErrorResponse($result->getErrors(), $result->getCode() ?? 500))->toResponse();
    }


    protected function commandBus(mixed $command): mixed
    {
        return CommandBus::dispatch($command);
    }

    protected function queryBus(mixed $query): mixed
    {
        return QueryBus::dispatch($query);
    }

    protected function json(mixed $data, int $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json($data, $code);
    }
}
