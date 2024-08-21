<?php

use App\Exceptions\HandlerError;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Http\Middleware\TrustProxies;
use Illuminate\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::prefix('api/v1')
                ->middleware('api')
                ->name('api.v1.')
                ->group(function () {
                    require base_path('routes/api.php');
                });
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append([
            TrustProxies::class,
            HandleCors::class,
            PreventRequestsDuringMaintenance::class,
            ValidatePostSize::class,
            TrimStrings::class,
            ConvertEmptyStringsToNull::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
//        $exceptions->render(function (Throwable $exception, Request $request) {
//            $handler = new HandlerError();
//
//            return $handler->handle($exception, $request);
//        });
    })->create();
