<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Seed des zones géographiques
     *
     * COMPORTEMENT INTELLIGENT :
     * - Ajoute les zones manquantes
     * - Met à jour les zones existantes (via slug)
     * - Préserve les zones ajoutées manuellement en production
     * - Peut être exécuté à chaque déploiement sans risque
     */
    public function run(): void
    {
        $zones = [
            ['libelle' => 'La Réunion', 'slug' => 'la-reunion', 'libelle_translations' => null],
            ['libelle' => 'Madagascar', 'slug' => 'madagascar', 'libelle_translations' => null],
            ['libelle' => 'Maurice', 'slug' => 'maurice', 'libelle_translations' => null],
            ['libelle' => 'Mayotte', 'slug' => 'mayotte', 'libelle_translations' => null],
            ['libelle' => 'Seychelles', 'slug' => 'seychelles', 'libelle_translations' => null],
        ];

        foreach ($zones as $zone) {
            Zone::updateOrCreate(
                ['slug' => $zone['slug']],
                $zone
            );
        }
    }
}
