<?php

namespace App\Http\Middleware;

use App\Models\Bateau;
use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

/**
 * Terminating middleware: tracks human visits to the DB.
 * Runs AFTER the response is sent — zero impact on page load time.
 */
class TrackVisits
{
    /**
     * Known bot/crawler signatures — reuses patterns from BlockUnwantedBots + AdvancedTrafficLogger.
     */
    private const BOT_SIGNATURES = [
        'googlebot', 'google-inspectiontool', 'adsbot-google', 'mediapartners-google',
        'bingbot', 'msnbot', 'bingpreview', 'applebot', 'duckduckbot',
        'yandexbot', 'baiduspider', 'facebookexternalhit', 'facebot',
        'twitterbot', 'linkedinbot', 'pinterestbot', 'telegrambot', 'whatsapp',
        'slackbot', 'discordbot', 'ahrefsbot', 'semrushbot', 'dotbot', 'mj12bot',
        'rogerbot', 'gptbot', 'claudebot', 'claude-web', 'ccbot', 'amazonbot',
        'bytespider', 'petalbot', 'python-requests', 'python-urllib', 'curl/',
        'wget/', 'go-http-client', 'node-fetch', 'okhttp', 'axios/', 'postman',
        'insomnia', 'headlesschrome', 'phantomjs', 'lighthouse', 'pagespeed',
        'gtmetrix', 'uptimerobot', 'pingdom', 'statuscake', 'screaming frog',
    ];

    private const GENERIC_BOT_PATTERNS = ['bot', 'crawler', 'spider', 'scraper', 'fetch', 'scan'];

    private const STATIC_EXTENSIONS = [
        'css', 'js', 'jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'ico',
        'woff', 'woff2', 'ttf', 'eot', 'map', 'mp4', 'mp3', 'pdf',
    ];

    private const BOAT_SEGMENTS = ['bateaux', 'boats', 'boote', 'boten', 'barcos', 'barche'];

    public function handle(Request $request, Closure $next): Response
    {
        // Store start time on the request so terminate() can access it
        $request->attributes->set('_track_start', microtime(true));

        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        try {
            $this->record($request, $response);
        } catch (\Throwable) {
            // Never crash the app because of tracking
        }
    }

    private function record(Request $request, Response $response): void
    {
        $path = $request->path();

        // Skip static files
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        if (in_array($ext, self::STATIC_EXTENSIONS, true)) {
            return;
        }

        // Skip admin area
        if (str_starts_with($path, 'admin')) {
            return;
        }

        // Skip non-200 routes (404, 301…) to keep the data clean
        if ($response->getStatusCode() !== 200) {
            return;
        }

        $ua = $request->userAgent() ?? '';

        // Skip bots
        if ($this->isBot($ua)) {
            return;
        }

        $startTime = $request->attributes->get('_track_start', microtime(true));
        $responseTime = (int) round((microtime(true) - $startTime) * 1000);

        $ip = $request->ip();
        $ipHash = hash('sha256', $ip . config('app.key')); // RGPD-safe, irreversible

        $geo = $this->resolveGeo($ip);
        $boatId = $this->resolveBoatId($path);

        Visit::create([
            'session_id'    => substr(session()->getId() ?: md5($ipHash . $ua), 0, 64),
            'ip_hash'       => $ipHash,
            'user_agent'    => substr($ua, 0, 500),
            'url'           => substr($request->fullUrl(), 0, 500),
            'method'        => $request->method(),
            'referer'       => $this->formatReferer($request->header('Referer')),
            'boat_id'       => $boatId,
            'city'          => $geo['city'] ?? null,
            'country'       => $geo['country'] ?? null,
            'country_code'  => $geo['countryCode'] ?? null,
            'response_time' => $responseTime,
            'created_at'    => now(),
        ]);
    }

    private function isBot(string $ua): bool
    {
        if (empty($ua) || strlen($ua) < 20) {
            return true;
        }

        $uaLower = strtolower($ua);

        foreach (self::BOT_SIGNATURES as $sig) {
            if (str_contains($uaLower, $sig)) {
                return true;
            }
        }

        foreach (self::GENERIC_BOT_PATTERNS as $pattern) {
            if (str_contains($uaLower, $pattern)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Resolve geo data from IP — cached 24h per IP to avoid hammering ip-api.com.
     */
    private function resolveGeo(string $ip): array
    {
        // Skip private/localhost IPs (local dev only — on Railway these won't appear)
        if (in_array($ip, ['127.0.0.1', '::1'], true)
            || str_starts_with($ip, '192.168.')
            || str_starts_with($ip, '10.')
            || str_starts_with($ip, '172.')) {
            return [];
        }

        $cacheKey = 'visit_geo_' . md5($ip);

        return Cache::remember($cacheKey, 86400, function () use ($ip) {
            // ipapi.co — HTTPS, free tier, no key required
            try {
                $response = Http::timeout(3)->get("https://ipapi.co/{$ip}/json/");
                if ($response->successful()) {
                    $data = $response->json();
                    if (!empty($data['city'])) {
                        return [
                            'city'        => $data['city'],
                            'country'     => $data['country_name'],
                            'countryCode' => $data['country_code'],
                        ];
                    }
                }
            } catch (\Throwable) {
                // Geo is optional — fail silently
            }
            return [];
        });
    }

    /**
     * Extract and shorten referrer — keeps only the domain/source.
     */
    private function formatReferer(?string $referer): ?string
    {
        if (empty($referer)) {
            return null;
        }

        $host = strtolower(parse_url($referer, PHP_URL_HOST) ?? '');
        if (!$host) {
            return null;
        }

        // Strip www.
        $host = preg_replace('/^www\./', '', $host);

        // Skip self-referrals
        $appHost = strtolower(parse_url(config('app.url'), PHP_URL_HOST) ?? '');
        $appHost = preg_replace('/^www\./', '', $appHost);
        if ($host === $appHost) {
            return null;
        }

        $shortcuts = [
            'google.com' => 'Google', 'google.fr' => 'Google FR', 'google.de' => 'Google DE',
            'google.co.uk' => 'Google UK', 'google.mg' => 'Google MG', 'google.mu' => 'Google MU',
            'google.re' => 'Google RE', 'bing.com' => 'Bing', 'duckduckgo.com' => 'DuckDuckGo',
            'facebook.com' => 'Facebook', 'instagram.com' => 'Instagram', 'linkedin.com' => 'LinkedIn',
            't.co' => 'Twitter/X', 'pinterest.com' => 'Pinterest', 'whatsapp.com' => 'WhatsApp',
            'youtube.com' => 'YouTube',
        ];

        // Google country variants
        if (preg_match('/^google\.[a-z]{2,3}$/', $host)) {
            return 'Google (' . strtoupper(substr($host, 7)) . ')';
        }

        return $shortcuts[$host] ?? $host;
    }

    /**
     * Extract boat_id from URL slug — cached 1h per slug.
     * URL pattern: /bateaux/{slug} or /en/boats/{slug} etc.
     */
    private function resolveBoatId(string $path): ?int
    {
        $segments = explode('/', trim($path, '/'));

        // Find the boat segment index
        $boatSegmentIndex = null;
        foreach ($segments as $i => $segment) {
            if (in_array($segment, self::BOAT_SEGMENTS, true)) {
                $boatSegmentIndex = $i;
                break;
            }
        }

        if ($boatSegmentIndex === null) {
            return null;
        }

        $slug = $segments[$boatSegmentIndex + 1] ?? null;
        if (!$slug) {
            return null;
        }

        return Cache::remember('visit_boat_slug_' . $slug, 3600, function () use ($slug) {
            return Bateau::where('slug', $slug)->value('id');
        });
    }
}
