<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Redirects incorrect multilingual boat route combinations.
 * Example: /en/bateaux/ -> /en/boats/
 */
class RedirectMultilingualBoatRoutes
{
    /**
     * Mapping of boat route variants per language.
     */
    private const BOAT_ROUTES = [
        'fr' => 'bateaux',
        'en' => 'boats',
        'de' => 'boote',
        'nl' => 'boten',
        'es' => 'barcos',
        'it' => 'barche',
    ];

    /**
     * All known boat route variants (for detection).
     */
    private const ALL_VARIANTS = ['bateaux', 'boats', 'boote', 'boten', 'barcos', 'barche'];

    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();

        // Match pattern: /{locale}/{boat-variant}...
        if (preg_match('#^(fr|en|de|nl|es|it)/(' . implode('|', self::ALL_VARIANTS) . ')(/.*)?$#', $path, $matches)) {
            $locale = $matches[1];
            $currentVariant = $matches[2];
            $rest = $matches[3] ?? '';
            $correctVariant = self::BOAT_ROUTES[$locale];

            // If the variant doesn't match the locale, redirect 301
            if ($currentVariant !== $correctVariant) {
                $newPath = "/{$locale}/{$correctVariant}{$rest}";
                $queryString = $request->getQueryString();

                if ($queryString) {
                    $newPath .= '?' . $queryString;
                }

                return redirect($newPath, 301);
            }
        }

        return $next($request);
    }
}
