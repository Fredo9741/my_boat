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

        // IMPORT INITIAL - DÉSACTIVÉ APRÈS PREMIER IMPORT RÉUSSI LE 2025-12-27
        // Les seeders ci-dessous ont été commentés pour préserver les données en production
        // Ne décommentez que si vous voulez réinitialiser complètement les bateaux
        // $this->call([
        //     CleanBateauxSeeder::class,  // Nettoie la base avant import
        //     BateauSeeder::class,         // 55 bateaux scrapés
        //     BateauMediaSeeder::class,    // 457 images
        // ]);
    }
}
