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
        // IMPORT INITIAL UNIQUEMENT - À RETIRER APRÈS PREMIER DÉPLOIEMENT
        // Décommentez ces lignes pour l'import initial des bateaux scrapés
        $this->call([
            BateauSeeder::class,
            BateauMediaSeeder::class,
        ]);

        // Seed essential boat marketplace data only
        // BateauSeeder and MediaSeeder removed - boats will be added manually via admin panel
        $this->call([
            TypeSeeder::class,
            ZoneSeeder::class,
            ActionSeeder::class,
            EquipementSeeder::class,
            UserSeeder::class,
        ]);
    }
}
