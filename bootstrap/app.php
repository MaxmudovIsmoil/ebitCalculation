<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
        then: function () {
            Route::name('admin.')
                ->prefix('admin')
                ->middleware(['web', 'IsAdmin'])
                ->group(base_path('routes/admin.php'));

//            Route::prefix('api')
//                ->group(base_path('routes/api.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'IsActive' => \App\Http\Middleware\IsActive::class,
            'IsAdmin' => \App\Http\Middleware\IsAdmin::class,
        ]);
//        $middleware->redirectGuestsTo('/admin/login');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
