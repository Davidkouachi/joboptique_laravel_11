<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;

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
        // 👉 Gestion des erreurs 404
        // $exceptions->render(function (NotFoundHttpException $e, Request $request) {
        //     if ($request->expectsJson()) {
        //         return response()->json(['message' => 'Ressource non trouvée'], 404);
        //     }

        //     return response()->view('pages.errors.404', [], 404);
        // });

        $exceptions->render(function (\Throwable $e, $request) {

            // Pour API / JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'code' => $e->getCode() ?: 500
                ], $e->getCode() ?: 500);
            }

            // 404 Not Found
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                return view()->exists('pages.errors.404')
                    ? response()->view('pages.errors.404', [], 404)
                    : response('<h1>404 - Page non trouvée</h1>', 404);
            }

            // 403 Access Denied
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException) {
                return view()->exists('pages.errors.403')
                    ? response()->view('pages.errors.403', [], 403)
                    : response('<h1>403 - Accès interdit</h1>', 403);
            }

            // Toutes les autres exceptions → 500
            return view()->exists('pages.errors.500')
                ? response()->view('pages.errors.500', [], 500)
                : response('<h1>500 - Erreur interne</h1>', 500);
        });

    })->create();
