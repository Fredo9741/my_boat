<?php

/**
 * Script de test V2 - Construction manuelle des URLs
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

echo "=== TEST DE GÉNÉRATION D'URLs SITEMAP V2 ===\n\n";

$boat = \App\Models\Bateau::visible()->first();
echo "Bateau de test: {$boat->name} (slug: {$boat->slug})\n\n";

$locales = ['fr', 'en', 'de', 'es', 'nl', 'it'];
$defaultLocale = 'fr';
$appUrl = config('app.url');

echo "--- MÉTHODE 3 : Construction manuelle avec trans() ---\n";
echo "Code: Construire l'URL avec le segment traduit\n\n";

foreach ($locales as $locale) {
    // Récupérer le segment traduit pour cette langue
    $routeSegment = trans('routes.bateaux', [], $locale);

    // Construire l'URL
    if ($locale === $defaultLocale) {
        // Pas de préfixe pour la langue par défaut (hideDefaultLocaleInURL = true)
        $url = "{$appUrl}/{$routeSegment}/{$boat->slug}";
    } else {
        $url = "{$appUrl}/{$locale}/{$routeSegment}/{$boat->slug}";
    }

    // Vérifier le résultat
    $expectedSegments = [
        'fr' => 'bateaux',
        'en' => 'boats',
        'de' => 'boote',
        'es' => 'barcos',
        'nl' => 'boten',
        'it' => 'barche',
    ];

    $hasCorrectPath = str_contains($url, "/{$expectedSegments[$locale]}/");
    $status = $hasCorrectPath ? '✅' : '❌';
    echo "{$status} {$locale}: {$url}\n";
}

echo "\n--- MÉTHODE 4 : Utiliser getLocalizedURL sur la route index + slug ---\n";

foreach ($locales as $locale) {
    // Obtenir l'URL de base traduite pour la liste
    $baseUrl = LaravelLocalization::getLocalizedURL($locale, route('bateaux.index'), [], false);
    // Ajouter le slug
    $url = $baseUrl . '/' . $boat->slug;

    $expectedSegments = [
        'fr' => 'bateaux',
        'en' => 'boats',
        'de' => 'boote',
        'es' => 'barcos',
        'nl' => 'boten',
        'it' => 'barche',
    ];

    $hasCorrectPath = str_contains($url, "/{$expectedSegments[$locale]}/");
    $status = $hasCorrectPath ? '✅' : '❌';
    echo "{$status} {$locale}: {$url}\n";
}

echo "\n=== CONCLUSION ===\n";
echo "La méthode 4 (getLocalizedURL sur bateaux.index + slug) semble la plus simple.\n";
echo "Elle réutilise la traduction existante et ajoute juste le slug à la fin.\n";
