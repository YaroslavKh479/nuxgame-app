<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response as JsonResponse;
use Illuminate\Support\Str;


return Application::configure(basePath: dirname(__DIR__))
    ->withEvents([
        __DIR__.'/../app/Application/Commands',
        __DIR__.'/../app/Application/Queries',
    ])
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

        $exceptions->renderable(function (\Exception $e) {

            $httpStatus = match (true) {
                $e instanceof ValidationException => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,   // 422
                $e instanceof InvalidArgumentException => JsonResponse::HTTP_BAD_REQUEST,       // 400
                $e instanceof AuthenticationException => JsonResponse::HTTP_UNAUTHORIZED,       // 401
                $e instanceof ModelNotFoundException => JsonResponse::HTTP_NOT_FOUND,           // 404
                $e instanceof DomainException => JsonResponse::HTTP_CONFLICT,                   // 409
                default => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,                            // 500
            };

            logger()->error($e->getMessage(),$e->getTrace());

            return response()->json([
                'success'   => false,
                'error'     => env('APP_DEBUG') ? Str::replace(' (and 1 more error)', '', $e->getMessage()) : __('Internal Server Error'),
                'code'      => $httpStatus,
            ], $httpStatus);
        });


        $exceptions->dontReport([
            AuthenticationException::class,
            ValidationException::class,
            ModelNotFoundException::class,
        ]);
    })->create();
