<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    public function run(): void
    {
        // Ne seed que si aucune zone n'existe
        if (Zone::count() > 0) {
            return;
        }

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
