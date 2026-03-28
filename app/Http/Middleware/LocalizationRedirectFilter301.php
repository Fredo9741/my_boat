<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationMiddlewareBase;

/**
 * Replaces LaravelLocalizationRedirectFilter with a 301 (permanent) redirect
 * instead of 302 (temporary). Critical for SEO: /fr/acheter/... → /acheter/...
 */
class LocalizationRedirectFilter301 extends LaravelLocalizationMiddlewareBase
{
    public function handle($request, Closure $next)
    {
        if ($this->shouldIgnore($request)) {
            return $next($request);
        }

        $params = explode('/', $request->getPathInfo());
        array_shift($params);

        if (\count($params) > 0) {
            $locale = $params[0];

            if (app('laravellocalization')->checkLocaleInSupportedLocales($locale)) {
                if (app('laravellocalization')->isHiddenDefault($locale)) {
                    $redirection = app('laravellocalization')->getNonLocalizedURL();
                    app('session')->reflash();

                    return new RedirectResponse($redirection, 301, ['Vary' => 'Accept-Language']);
                }
            }
        }

        return $next($request);
    }
}
