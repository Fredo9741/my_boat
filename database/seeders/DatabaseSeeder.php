<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed essential boat marketplace data first (with protection against re-seeding)
        $this->call([
            TypeSeeder::class,
            ZoneSeeder::class,
            ActionSeeder::class,
            EquipementSeeder::class,
            UserSeeder::class,
        ]);

        // IMPORT INITIAL UNIQUEMENT - À RETIRER APRÈS PREMIER DÉPLOIEMENT
        // Nettoyer les anciennes données puis importer les bateaux scrapés
        $this->call([
            CleanBateauxSeeder::class,  // Nettoie la base avant import
            BateauSeeder::class,
            BateauMediaSeeder::class,
        ]);
    }
}
