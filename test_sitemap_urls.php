<?php

/**
 * Script de test pour vérifier la génération d'URLs du sitemap
 * Usage: php test_sitemap_urls.php
 *
 * Ce script teste les deux méthodes de génération d'URLs :
 * 1. L'ancienne méthode (problématique)
 * 2. La nouvelle méthode proposée
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

echo "=== TEST DE GÉNÉRATION D'URLs SITEMAP ===\n\n";

// Récupérer un bateau de test
$boat = \App\Models\Bateau::visible()->first();

if (!$boat) {
    echo "❌ Aucun bateau visible trouvé\n";
    exit(1);
}

echo "Bateau de test: {$boat->name} (slug: {$boat->slug})\n\n";

$locales = ['fr', 'en', 'de', 'es', 'nl', 'it'];
$originalLocale = app()->getLocale();

echo "--- MÉTHODE ACTUELLE (problématique) ---\n";
echo "Code: LaravelLocalization::getLocalizedURL(\$locale, route('bateaux.show', \$slug), [], false)\n\n";

foreach ($locales as $locale) {
    $url = LaravelLocalization::getLocalizedURL($locale, route('bateaux.show', $boat->slug), [], false);
    $hasWrongPath = str_contains($url, "/{$locale}/bateaux/") && $locale !== 'fr';
    $status = $hasWrongPath ? '❌' : '✅';
    echo "{$status} {$locale}: {$url}\n";
}

echo "\n--- MÉTHODE PROPOSÉE ---\n";
echo "Code: LaravelLocalization::setLocale(\$locale); route('bateaux.show', \$slug);\n\n";

foreach ($locales as $locale) {
    // Sauvegarder la locale actuelle
    $currentLocale = app()->getLocale();

    // Changer la locale
    LaravelLocalization::setLocale($locale);
    app()->setLocale($locale);

    // Générer la route
    $url = route('bateaux.show', ['slug' => $boat->slug]);

    // Restaurer la locale
    LaravelLocalization::setLocale($currentLocale);
    app()->setLocale($currentLocale);

    // Vérifier le résultat
    $expectedSegments = [
        'fr' => 'bateaux',
        'en' => 'boats',
        'de' => 'boote',
        'es' => 'barcos',
        'nl' => 'boten',
        'it' => 'barche',
    ];

    $expectedSegment = $expectedSegments[$locale];
    $hasCorrectPath = str_contains($url, "/{$expectedSegment}/") || ($locale === 'fr' && str_contains($url, "/bateaux/"));
    $status = $hasCorrectPath ? '✅' : '❌';
    echo "{$status} {$locale}: {$url}\n";
}

// Restaurer la locale originale
LaravelLocalization::setLocale($originalLocale);
app()->setLocale($originalLocale);

echo "\n--- TEST PAGE INDEX ---\n";

foreach ($locales as $locale) {
    $url = LaravelLocalization::getLocalizedURL($locale, route('bateaux.index'), [], false);
    echo "{$locale}: {$url}\n";
}

echo "\n=== FIN DES TESTS ===\n";
