<?php

namespace Database\Seeders;

use App\Models\Bateau;
use App\Models\Media;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CleanBateauxSeeder extends Seeder
{
    /**
     * Nettoie complètement les tables bateaux et medias avant import
     */
    public function run(): void
    {
        echo "\n🧹 Nettoyage des anciennes données bateaux...\n";

        // Désactiver les foreign key checks temporairement
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Supprimer toutes les médias (même soft deleted)
        Media::withTrashed()->forceDelete();
        echo "  ✓ Médias supprimées\n";

        // Supprimer tous les bateaux (même soft deleted)
        Bateau::withTrashed()->forceDelete();
        echo "  ✓ Bateaux supprimés\n";

        // Réactiver les foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        echo "✅ Nettoyage terminé! Base prête pour l'import.\n\n";
    }
}
