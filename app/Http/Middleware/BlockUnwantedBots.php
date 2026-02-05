<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware to block aggressive SEO bots and rate-limit social crawlers.
 * Placed before traffic logger to avoid logging blocked requests.
 */
class BlockUnwantedBots
{
    /**
     * Bots to block completely (aggressive SEO scrapers).
     */
    private const BLOCKED_BOTS = [
        'ahrefsbot',
        'semrushbot',
        'dotbot',
        'mj12bot',
        'rogerbot',
        'serpstatbot',
        'dataforseobot',
        'blexbot',
        'megaindex',
        'seokicks',
        'seekport',
        'exabot',
        'linkdexbot',
        'backlinkcrawler',
        'spbot',
        'siteexplorer',
        'seznambot',
        'yandexbot',
        'baiduspider',
        'sogou',
        'petalbot',
        'bytespider',
        'gptbot',
        'claudebot',
        'claude-web',
        'ccbot',
        'amazonbot',
        'anthropic-ai',
        'cohere-ai',
    ];

    /**
     * Bots to allow (important for SEO and social sharing).
     */
    private const ALLOWED_BOTS = [
        'googlebot',
        'google-inspectiontool',
        'adsbot-google',
        'mediapartners-google',
        'bingbot',
        'msnbot',
        'bingpreview',
        'applebot',
        'duckduckbot',
    ];

    /**
     * Bots to rate-limit (social media crawlers).
     * Format: 'signature' => requests per minute
     */
    private const RATE_LIMITED_BOTS = [
        'facebookexternalhit' => 10,
        'facebot' => 10,
        'twitterbot' => 15,
        'linkedinbot' => 10,
        'pinterestbot' => 10,
        'telegrambot' => 10,
        'whatsapp' => 15,
        'slackbot' => 10,
        'discordbot' => 10,
    ];

    /**
     * Rate limit window in seconds.
     */
    private const RATE_LIMIT_WINDOW = 60;

    /**
     * Whether to log blocked bots (set to false to disable logging).
     */
    private const LOG_BLOCKED_BOTS = true;

    public function handle(Request $request, Closure $next): Response
    {
        $userAgent = strtolower($request->userAgent() ?? '');

        // Skip if no user agent
        if (empty($userAgent)) {
            return $next($request);
        }

        // Check if allowed bot (whitelist has priority)
        if ($this->isAllowedBot($userAgent)) {
            return $next($request);
        }

        // Check if blocked bot
        $blockedBot = $this->getBlockedBot($userAgent);
        if ($blockedBot !== null) {
            $this->logBlockedBot($blockedBot, $request);
            return $this->blockResponse();
        }

        // Check rate-limited bots
        $rateLimitResult = $this->checkRateLimit($userAgent, $request);
        if ($rateLimitResult !== null) {
            return $rateLimitResult;
        }

        return $next($request);
    }

    private function isAllowedBot(string $userAgent): bool
    {
        foreach (self::ALLOWED_BOTS as $bot) {
            if (str_contains($userAgent, $bot)) {
                return true;
            }
        }
        return false;
    }

    private function getBlockedBot(string $userAgent): ?string
    {
        foreach (self::BLOCKED_BOTS as $bot) {
            if (str_contains($userAgent, $bot)) {
                return $bot;
            }
        }
        return null;
    }

    private function logBlockedBot(string $bot, Request $request): void
    {
        if (!self::LOG_BLOCKED_BOTS) {
            return;
        }

        Log::channel('blocked_bots')->info('Bot blocked', [
            'bot' => $bot,
            'ip' => $request->ip(),
            'url' => $request->fullUrl(),
        ]);
    }

    private function checkRateLimit(string $userAgent, Request $request): ?Response
    {
        foreach (self::RATE_LIMITED_BOTS as $bot => $maxRequests) {
            if (str_contains($userAgent, $bot)) {
                $key = 'bot:' . $bot . ':' . md5($request->ip());

                if (RateLimiter::tooManyAttempts($key, $maxRequests)) {
                    $this->logRateLimitedBot($bot, $request);
                    return $this->rateLimitResponse(RateLimiter::availableIn($key));
                }

                RateLimiter::hit($key, self::RATE_LIMIT_WINDOW);
                return null;
            }
        }

        return null;
    }

    private function logRateLimitedBot(string $bot, Request $request): void
    {
        if (!self::LOG_BLOCKED_BOTS) {
            return;
        }

        Log::channel('blocked_bots')->info('Bot rate-limited', [
            'bot' => $bot,
            'ip' => $request->ip(),
            'url' => $request->fullUrl(),
        ]);
    }

    private function blockResponse(): Response
    {
        return response('', 403)
            ->header('X-Robots-Tag', 'noindex, nofollow')
            ->header('Cache-Control', 'no-store');
    }

    private function rateLimitResponse(int $retryAfter = null): Response
    {
        return response('', 429)
            ->header('Retry-After', $retryAfter ?? self::RATE_LIMIT_WINDOW)
            ->header('X-Robots-Tag', 'noindex, nofollow')
            ->header('Cache-Control', 'no-store');
    }
}
