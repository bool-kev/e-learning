<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckerMiddleware;
use App\Http\Middleware\EleveMiddleware;
use App\Http\Middleware\StaffMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append([StaffMiddleware::class, AdminMiddleware::class]);
        $middleware->alias([
            'staff'=>StaffMiddleware::class,
            'admin'=>AdminMiddleware::class,
            'eleve'=>EleveMiddleware::class,
            'safe'=>CheckerMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
