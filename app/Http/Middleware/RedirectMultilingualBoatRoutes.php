<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Redirects incorrect multilingual route segment combinations.
 * Examples:
 *   /en/bateaux/slug  -> /en/boats/slug
 *   /es/artikel/slug  -> /es/articulos/slug
 *   /nl/articulos/slug -> /nl/artikelen/slug
 */
class RedirectMultilingualBoatRoutes
{
    private const BOAT_ROUTES = [
        'fr' => 'bateaux',
        'en' => 'boats',
        'de' => 'boote',
        'nl' => 'boten',
        'es' => 'barcos',
        'it' => 'barche',
    ];

    private const ARTICLE_ROUTES = [
        'fr' => 'articles',
        'en' => 'articles',
        'de' => 'artikel',
        'nl' => 'artikelen',
        'es' => 'articulos',
        'it' => 'articoli',
    ];

    private const ALL_BOAT_VARIANTS    = ['bateaux', 'boats', 'boote', 'boten', 'barcos', 'barche'];
    private const ALL_ARTICLE_VARIANTS = ['articles', 'artikel', 'artikelen', 'articulos', 'articoli'];

    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();

        // Check boats
        if (preg_match('#^(fr|en|de|nl|es|it)/(' . implode('|', self::ALL_BOAT_VARIANTS) . ')(/.*)?$#', $path, $matches)) {
            $redirect = $this->buildRedirect($matches, self::BOAT_ROUTES, $request);
            if ($redirect) return $redirect;
        }

        // Check articles
        if (preg_match('#^(fr|en|de|nl|es|it)/(' . implode('|', self::ALL_ARTICLE_VARIANTS) . ')(/.*)?$#', $path, $matches)) {
            $redirect = $this->buildRedirect($matches, self::ARTICLE_ROUTES, $request);
            if ($redirect) return $redirect;
        }

        return $next($request);
    }

    private function buildRedirect(array $matches, array $routeMap, Request $request): ?Response
    {
        $locale         = $matches[1];
        $currentSegment = $matches[2];
        $rest           = $matches[3] ?? '';
        $correctSegment = $routeMap[$locale];

        if ($currentSegment === $correctSegment) {
            return null;
        }

        // French is the default locale — no /fr/ prefix
        $newPath = $locale === 'fr'
            ? "/{$correctSegment}{$rest}"
            : "/{$locale}/{$correctSegment}{$rest}";

        if ($qs = $request->getQueryString()) {
            $newPath .= '?' . $qs;
        }

        return redirect($newPath, 301);
    }
}
