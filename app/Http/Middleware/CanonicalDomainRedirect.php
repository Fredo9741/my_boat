<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Redirects traffic from non-canonical domains to APP_URL.
 *
 * Usage: When migrating from Railway to your final domain,
 * set APP_URL to your new domain and CANONICAL_REDIRECT_ENABLED=true.
 * All traffic to old domains will be 301 redirected.
 */
class CanonicalDomainRedirect
{
    public function handle(Request $request, Closure $next): Response
    {
        // Only redirect if explicitly enabled
        if (!config('app.canonical_redirect_enabled', false)) {
            return $next($request);
        }

        $appUrl = config('app.url');
        $canonicalHost = parse_url($appUrl, PHP_URL_HOST);
        $currentHost = $request->getHost();

        // Skip if already on canonical domain
        if ($currentHost === $canonicalHost) {
            return $next($request);
        }

        // Skip health check endpoints
        if ($request->is('up', 'health', 'api/health')) {
            return $next($request);
        }

        // Build the canonical URL
        $scheme = parse_url($appUrl, PHP_URL_SCHEME) ?? 'https';
        $path = $request->getRequestUri();
        $canonicalUrl = "{$scheme}://{$canonicalHost}{$path}";

        return redirect($canonicalUrl, 301);
    }
}
