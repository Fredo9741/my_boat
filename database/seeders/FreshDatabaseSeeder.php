<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Bateau;

/**
 * FreshDatabaseSeeder - Reset complet et re-seeding de toute la base
 *
 * Ce seeder supprime TOUTES les données et recrée tout dans le bon ordre
 * Utilisez-le avec précaution en production !
 *
 * Usage:
 *   php artisan db:seed --class=FreshDatabaseSeeder
 *   OU
 *   railway run php artisan db:seed --class=FreshDatabaseSeeder --force
 */
class FreshDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        echo "\n";
        echo "╔══════════════════════════════════════════════════════════════╗\n";
        echo "║  🔄 FRESH DATABASE SEEDER - Reset complet de la base       ║\n";
        echo "╚══════════════════════════════════════════════════════════════╝\n";
        echo "\n";

        $this->cleanDatabase();
        $this->seedFreshData();

        echo "\n";
        echo "╔══════════════════════════════════════════════════════════════╗\n";
        echo "║  ✅ Base de données complètement rafraîchie avec succès !   ║\n";
        echo "╚══════════════════════════════════════════════════════════════╝\n";
        echo "\n";
    }

    /**
     * Nettoie toutes les tables dans le bon ordre (inverse des dépendances)
     */
    private function cleanDatabase(): void
    {
        echo "🧹 ÉTAPE 1/2 : Nettoyage complet de la base...\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";

        $driver = DB::connection()->getDriverName();

        // Désactiver les foreign key checks selon le driver
        if ($driver === 'pgsql') {
            DB::statement('SET session_replication_role = replica;');
            echo "  ℹ️  PostgreSQL: Foreign keys temporairement désactivées\n";
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            echo "  ℹ️  MySQL: Foreign keys temporairement désactivées\n";
        }

        // Ordre inverse des dépendances
        $tables = [
            'bateau_equipement' => 'Table pivot Bateau-Equipement',
            'medias' => 'Médias',
            'bateaux' => 'Bateaux',
            'equipements' => 'Équipements',
            'actions' => 'Actions/Slogans',
            'types' => 'Types de bateaux',
            'zones' => 'Zones géographiques',
        ];

        foreach ($tables as $table => $label) {
            $count = DB::table($table)->count();

            if ($table === 'bateaux') {
                // Pour les bateaux, utiliser le modèle pour gérer soft deletes
                Bateau::withTrashed()->forceDelete();
            } else {
                DB::table($table)->truncate();
            }

            echo "  ✓ {$label} supprimée(s) ({$count} enregistrements)\n";
        }

        // Réactiver les foreign key checks
        if ($driver === 'pgsql') {
            DB::statement('SET session_replication_role = DEFAULT;');
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        echo "  ✅ Nettoyage terminé!\n\n";
    }

    /**
     * Re-seed toutes les données dans le bon ordre
     */
    private function seedFreshData(): void
    {
        echo "🌱 ÉTAPE 2/2 : Population de la base avec des données fraîches...\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";

        // Ordre respectant les dépendances
        $seeders = [
            ['class' => TypeSeeder::class, 'label' => 'Types de bateaux'],
            ['class' => ZoneSeeder::class, 'label' => 'Zones géographiques'],
            ['class' => ActionSeeder::class, 'label' => 'Actions/Slogans'],
            ['class' => EquipementSeeder::class, 'label' => 'Équipements'],
            ['class' => UserSeeder::class, 'label' => 'Utilisateur admin'],
            ['class' => BateauSeeder::class, 'label' => 'Bateaux (55 annonces)'],
            ['class' => BateauMediaSeeder::class, 'label' => 'Médias des bateaux'],
        ];

        foreach ($seeders as $seeder) {
            echo "\n  → Seeding : {$seeder['label']}...\n";
            $this->call($seeder['class']);
        }

        echo "\n  ✅ Toutes les données ont été insérées!\n";
    }
}
