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
        // Import des bateaux scrapés (s'exécute après pour avoir les types/zones/actions)
        $this->call([
            BateauSeeder::class,
            BateauMediaSeeder::class,
        ]);
    }
}
