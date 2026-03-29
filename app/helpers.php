<?php

if (!function_exists('r2_url')) {
    /**
     * Générer l'URL complète pour un fichier stocké sur Cloudflare R2
     *
     * @param string|null $path
     * @return string
     */
    function r2_url(?string $path): string
    {
        if (empty($path)) {
            return asset('images/placeholder-boat.jpg');
        }

        // Si le chemin contient déjà une URL complète, le retourner tel quel
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        // Supprimer /storage/ si présent (ancien format)
        $path = str_replace('/storage/', '', $path);

        // Construire l'URL R2
        $baseUrl = rtrim(env('CLOUDFLARE_R2_URL'), '/');
        $cleanPath = ltrim($path, '/');

        return "{$baseUrl}/{$cleanPath}";
    }
}

if (!function_exists('cf_img')) {
    /**
     * Générer une URL Cloudflare Image Transformation
     * Redimensionne, convertit en WebP et compresse à la volée via /cdn-cgi/image/
     *
     * @param string|null $url   URL complète de l'image source
     * @param array       $opts  Options CF : width, height, quality, format, fit
     * @return string
     */
    function cf_img(?string $url, array $opts = []): string
    {
        if (empty($url)) {
            return asset('images/placeholder-boat.jpg');
        }

        // Ne pas transformer les images externes (Unsplash, etc.)
        $r2Base = rtrim(env('CLOUDFLARE_R2_URL', ''), '/');
        if (!str_starts_with($url, $r2Base)) {
            return $url;
        }

        $defaults = ['format' => 'webp', 'quality' => 80];
        $merged   = array_merge($defaults, $opts);

        $optStr = implode(',', array_map(
            fn($k, $v) => "{$k}={$v}",
            array_keys($merged),
            $merged
        ));

        // Extraire le chemin après le domaine R2
        $path = substr($url, strlen($r2Base));

        return "{$r2Base}/cdn-cgi/image/{$optStr}{$path}";
    }
}

if (!function_exists('storage_url')) {
    /**
     * Alias de r2_url pour rétrocompatibilité
     *
     * @param string|null $path
     * @return string
     */
    function storage_url(?string $path): string
    {
        return r2_url($path);
    }
}
