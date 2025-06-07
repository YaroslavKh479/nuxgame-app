<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as JsonResponse;
use Illuminate\Support\Str;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {


        $exceptions->renderable(function (\Exception $e, $request) {

            $code = match (true) {
                $e instanceof InvalidArgumentException => JsonResponse::HTTP_BAD_REQUEST,       // 400
                $e instanceof AuthenticationException => JsonResponse::HTTP_UNAUTHORIZED,       // 401
                $e instanceof ModelNotFoundException => JsonResponse::HTTP_NOT_FOUND,           // 404
                $e instanceof ValidationException => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,   // 422
                default => $e->getCode() ?: JsonResponse::HTTP_INTERNAL_SERVER_ERROR,           // 500
            };

            return response()->json([
                'success'   => false,
                'error'     => Str::replace(' (and 1 more error)', '', $e->getMessage()),
                'code'      => $code,
            ], $code);
        });


        $exceptions->dontReport([
            AuthenticationException::class,
            ValidationException::class,
            ModelNotFoundException::class,
        ]);
    })->create();
