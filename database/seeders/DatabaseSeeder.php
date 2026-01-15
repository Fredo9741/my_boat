<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * DatabaseSeeder - Orchestration des Seeders de la Marketplace
 *
 * Ce seeder est exécuté automatiquement par Railway à chaque déploiement
 * via le script : railway/init-app.sh
 */
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // ============================================================================
        // 🟢 SEEDERS ESSENTIELS (Toujours actifs)
        // ============================================================================
        // Seeders idempotents qui vérifient l'existence avant de créer
        // ============================================================================

        $this->call([
            TypeSeeder::class,          // Types de bateaux (Catamaran, Voilier, etc.)
            ZoneSeeder::class,          // Zones géographiques (Réunion, Maurice, etc.)
            ActionSeeder::class,        // Slogans/Actions (Coup de coeur, Vendu, etc.)
            EquipementSeeder::class,    // Équipements disponibles (GPS, VHF, etc.)
            UserSeeder::class,          // Utilisateur admin par défaut
        ]);

        // ============================================================================
        // 🚤 IMPORT DES BATEAUX (Contrôlé par init-app.sh)
        // ============================================================================
        // L'import des bateaux est géré par railway/init-app.sh via SEED_BOATS=true
        // Ce script exécute dans l'ordre :
        //   1. CleanBateauxSeeder (nettoie les bateaux existants)
        //   2. BateauSeeder (importe les 55 bateaux)
        //   3. BateauMediaSeeder (importe les médias)
        //
        // ⚠️ NE PAS décommenter ici pour éviter les doublons
        // ============================================================================
    }
}
