<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Trust Railway's load balancer so $request->ip() returns the real client IP
        $middleware->trustProxies(at: '*');

        // Global middlewares (executed before route resolution)
        // Order matters: BlockUnwantedBots runs first to reject bots before logging
        $middleware->prepend([
            \App\Http\Middleware\BlockUnwantedBots::class,
            \App\Http\Middleware\BlockMaliciousRequests::class,
            \App\Http\Middleware\AdvancedTrafficLogger::class,
            \App\Http\Middleware\CanonicalDomainRedirect::class,
            \App\Http\Middleware\RedirectMultilingualBoatRoutes::class,
            \App\Http\Middleware\TrackVisits::class,
        ]);

        // Register laravel-localization middleware aliases
        $middleware->alias([
            'localeSessionRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'localizationRedirect' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeViewPath' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,
            'honeypot' => \App\Http\Middleware\HoneypotMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Don't log 404 errors to prevent log saturation from bot requests
        $exceptions->dontReport([
            \Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class,
        ]);
    })->create();
