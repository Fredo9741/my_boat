<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * Business Intelligence Traffic Logger
 * Provides real-time insights on Railway console.
 */
class AdvancedTrafficLogger
{
    /**
     * Known bot signatures mapped to their labels.
     */
    private const BOT_SIGNATURES = [
        'googlebot' => 'GOOGLE',
        'google-inspectiontool' => 'GOOGLE',
        'adsbot-google' => 'GOOGLE-ADS',
        'mediapartners-google' => 'GOOGLE-ADS',
        'bingbot' => 'BING',
        'msnbot' => 'BING',
        'bingpreview' => 'BING',
        'yandexbot' => 'YANDEX',
        'duckduckbot' => 'DUCKDUCK',
        'baiduspider' => 'BAIDU',
        'slurp' => 'YAHOO',
        'facebookexternalhit' => 'FACEBOOK',
        'facebot' => 'FACEBOOK',
        'twitterbot' => 'TWITTER',
        'linkedinbot' => 'LINKEDIN',
        'pinterestbot' => 'PINTEREST',
        'telegrambot' => 'TELEGRAM',
        'whatsapp' => 'WHATSAPP',
        'ahrefs' => 'AHREFS',
        'semrush' => 'SEMRUSH',
        'mj12bot' => 'MAJESTIC',
        'dotbot' => 'MOZ',
        'rogerbot' => 'MOZ',
        'screaming frog' => 'SCREAMFROG',
        'petalbot' => 'HUAWEI',
        'applebot' => 'APPLE',
        'gptbot' => 'OPENAI',
        'claudebot' => 'ANTHROPIC',
        'claude-web' => 'ANTHROPIC',
        'bytespider' => 'BYTEDANCE',
        'dataforseo' => 'DATAFORSEO',
        'serpstat' => 'SERPSTAT',
        'uptimerobot' => 'UPTIME',
        'pingdom' => 'PINGDOM',
        'statuscake' => 'STATUSCAKE',
        'jetmon' => 'JETPACK',
        'wp rocket' => 'WPROCKET',
        'lighthouse' => 'LIGHTHOUSE',
        'pagespeed' => 'PAGESPEED',
        'gtmetrix' => 'GTMETRIX',
        'headlesschrome' => 'HEADLESS',
        'phantomjs' => 'PHANTOM',
        'python-requests' => 'PYTHON',
        'python-urllib' => 'PYTHON',
        'curl/' => 'CURL',
        'wget/' => 'WGET',
        'go-http-client' => 'GO',
        'java/' => 'JAVA',
        'okhttp' => 'OKHTTP',
        'axios/' => 'AXIOS',
        'node-fetch' => 'NODE',
        'postman' => 'POSTMAN',
        'insomnia' => 'INSOMNIA',
    ];

    /**
     * Generic bot patterns (when specific bot not identified).
     */
    private const GENERIC_BOT_PATTERNS = [
        'bot', 'crawler', 'spider', 'scraper', 'fetch', 'scan',
    ];

    /**
     * Static file extensions to filter.
     */
    private const STATIC_EXTENSIONS = [
        'css', 'js', 'jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'ico',
        'woff', 'woff2', 'ttf', 'eot', 'otf', 'map', 'mp4', 'webm', 'mp3',
    ];

    /**
     * Multilingual boat route variants for SEO tracking.
     */
    private const BOAT_VARIANTS = ['bateaux', 'boats', 'boote', 'boten', 'barcos', 'barche'];

    /**
     * Correct boat route per locale.
     */
    private const LOCALE_BOAT_ROUTES = [
        'fr' => 'bateaux',
        'en' => 'boats',
        'de' => 'boote',
        'nl' => 'boten',
        'es' => 'barcos',
        'it' => 'barche',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);

        $response = $next($request);

        $this->logRequest($request, $response, $startTime);

        return $response;
    }

    private function logRequest(Request $request, Response $response, float $startTime): void
    {
        $path = $request->path();
        $status = $response->getStatusCode();

        // Filter: Skip 200 on static files
        if ($this->isStaticFile($path) && $status === 200) {
            return;
        }

        $userAgent = $request->userAgent() ?? '';
        $botInfo = $this->detectBot($userAgent);
        $locale = $this->detectLocale($path);
        $duration = round((microtime(true) - $startTime) * 1000);
        $referer = $this->formatReferer($request->header('Referer'));

        // Build log line
        $parts = [];
        $parts[] = "[{$status}]";
        $parts[] = $botInfo['label'];
        $parts[] = "[{$locale}]";

        // Check for SEO issues (wrong boat route variant)
        $seoIssue = $this->detectSeoIssue($path, $locale, $status);
        if ($seoIssue) {
            $parts[] = "[{$seoIssue}]";
        }

        $parts[] = '/' . $path;

        if ($referer) {
            $parts[] = "[REF: {$referer}]";
        }

        $parts[] = "[{$duration}ms]";

        // Add extra context for 404s
        if ($status === 404 && $this->isStaticFile($path)) {
            $parts[] = "[STATIC-404]";
        }

        $logLine = 'LOG: ' . implode(' ', $parts);

        // Use appropriate log level
        if ($status >= 500) {
            Log::error($logLine);
        } elseif ($status >= 400) {
            Log::warning($logLine);
        } else {
            Log::info($logLine);
        }
    }

    private function detectBot(string $userAgent): array
    {
        $ua = strtolower($userAgent);

        // Check for known bots first
        foreach (self::BOT_SIGNATURES as $signature => $label) {
            if (str_contains($ua, $signature)) {
                return [
                    'isBot' => true,
                    'type' => $label,
                    'label' => "[BOT-{$label}]",
                ];
            }
        }

        // Check for generic bot patterns
        foreach (self::GENERIC_BOT_PATTERNS as $pattern) {
            if (str_contains($ua, $pattern)) {
                return [
                    'isBot' => true,
                    'type' => 'UNKNOWN',
                    'label' => '[BOT]',
                ];
            }
        }

        // Empty or suspicious user agent
        if (empty($ua) || strlen($ua) < 20) {
            return [
                'isBot' => true,
                'type' => 'SUSPECT',
                'label' => '[BOT?]',
            ];
        }

        return [
            'isBot' => false,
            'type' => 'HUMAN',
            'label' => '[HUMAN]',
        ];
    }

    private function detectLocale(string $path): string
    {
        $segments = explode('/', trim($path, '/'));
        $firstSegment = $segments[0] ?? '';

        $supportedLocales = ['fr', 'en', 'de', 'nl', 'es', 'it'];

        if (in_array($firstSegment, $supportedLocales, true)) {
            return strtoupper($firstSegment);
        }

        // Default to FR for root or non-prefixed routes
        return 'FR';
    }

    private function detectSeoIssue(string $path, string $locale, int $status): ?string
    {
        $segments = explode('/', trim($path, '/'));
        $localeKey = strtolower($locale);

        // Check if path contains a boat variant
        foreach ($segments as $segment) {
            if (in_array($segment, self::BOAT_VARIANTS, true)) {
                // Check if it's the correct variant for this locale
                $correctVariant = self::LOCALE_BOAT_ROUTES[$localeKey] ?? 'bateaux';
                if ($segment !== $correctVariant) {
                    return '404-SEO';
                }
            }
        }

        // Track general 404s on boat-like paths
        if ($status === 404) {
            foreach (self::BOAT_VARIANTS as $variant) {
                if (str_contains($path, $variant)) {
                    return 'BOAT-404';
                }
            }
        }

        return null;
    }

    private function formatReferer(?string $referer): ?string
    {
        if (empty($referer)) {
            return null;
        }

        $host = parse_url($referer, PHP_URL_HOST);
        if (!$host) {
            return null;
        }

        // Simplify common referrers
        $host = strtolower($host);
        $host = preg_replace('/^www\./', '', $host);

        // Shorten known domains
        $shortcuts = [
            'google.com' => 'google',
            'google.fr' => 'google.fr',
            'google.de' => 'google.de',
            'bing.com' => 'bing',
            'facebook.com' => 'fb',
            'instagram.com' => 'ig',
            'linkedin.com' => 'linkedin',
            't.co' => 'twitter',
            'pinterest.com' => 'pinterest',
        ];

        // Check for Google country variants
        if (preg_match('/^google\.[a-z]{2,3}$/', $host)) {
            return $host;
        }

        return $shortcuts[$host] ?? $host;
    }

    private function isStaticFile(string $path): bool
    {
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        return in_array($extension, self::STATIC_EXTENSIONS, true);
    }
}
