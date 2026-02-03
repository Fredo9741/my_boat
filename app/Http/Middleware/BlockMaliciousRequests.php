<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Security middleware to block common attack patterns.
 * Returns 404 silently to avoid giving information to attackers.
 */
class BlockMaliciousRequests
{
    /**
     * Attack patterns to block immediately.
     */
    private const BLOCKED_PATTERNS = [
        // WordPress attacks
        'wp-login.php',
        'wp-admin',
        'wp-content',
        'wp-includes',
        'xmlrpc.php',
        'wp-config',

        // PHP admin scripts
        'phpmyadmin',
        'phpmyadmin',
        'pma',
        'adminer',
        'phpinfo.php',

        // Sensitive files
        '.env',
        '.git',
        '.htaccess',
        'config.php',
        '.sql',
        '.bak',

        // Shell/malware attempts
        'shell',
        'c99',
        'r57',
        'webshell',

        // Common exploit paths
        'eval-stdin.php',
        'alfa',
        'index.php/wp-admin',
    ];

    /**
     * Known malicious user agents (scanners, exploit tools).
     */
    private const MALICIOUS_USER_AGENTS = [
        'zgrab',
        'masscan',
        'nmap',
        'sqlmap',
        'nikto',
        'dirbuster',
        'gobuster',
        'wpscan',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $path = strtolower($request->path());
        $userAgent = strtolower($request->userAgent() ?? '');

        // Block known attack patterns
        foreach (self::BLOCKED_PATTERNS as $pattern) {
            if (str_contains($path, strtolower($pattern))) {
                abort(404);
            }
        }

        // Block known scanning tools
        foreach (self::MALICIOUS_USER_AGENTS as $agent) {
            if (str_contains($userAgent, $agent)) {
                abort(403);
            }
        }

        return $next($request);
    }
}
