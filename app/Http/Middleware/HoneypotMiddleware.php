<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Bot protection without user friction:
 * 1. Honeypot field — hidden from humans, bots fill it automatically
 * 2. Timing check — form submitted < 2s after page load = bot
 */
class HoneypotMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Honeypot: field must exist but be empty
        if ($request->filled('_hp_url')) {
            \Log::warning('Honeypot triggered', [
                'ip'   => $request->ip(),
                'path' => $request->path(),
            ]);
            // Silently pretend success — bots shouldn't know they were blocked
            return redirect()->back()->with('success', 'Votre message a été envoyé avec succès!');
        }

        // 2. Timing check: form must have been loaded at least 2s ago
        $loadedAt = (int) $request->input('_form_time');
        if ($loadedAt > 0 && (time() - $loadedAt) < 2) {
            \Log::warning('Form submitted too fast (bot suspected)', [
                'ip'      => $request->ip(),
                'elapsed' => time() - $loadedAt,
            ]);
            return redirect()->back()->with('success', 'Votre message a été envoyé avec succès!');
        }

        return $next($request);
    }
}
