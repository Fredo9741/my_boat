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
