<?php

namespace Database\Seeders;

use App\Models\Bateau;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdatePublishedDatesSeeder extends Seeder
{
    /**
     * Met à jour les dates de publication des bateaux existants depuis le JSON
     */
    public function run(): void
    {
        echo "\n📅 Mise à jour des dates de publication...\n\n";

        // Charger le JSON
        $jsonPath = database_path('seeders/bateaux_scraped_data.json');

        if (!file_exists($jsonPath)) {
            echo "❌ Fichier JSON introuvable: {$jsonPath}\n";
            return;
        }

        $boatsData = json_decode(file_get_contents($jsonPath), true);

        if (!$boatsData) {
            echo "❌ Impossible de lire le JSON\n";
            return;
        }

        $updated = 0;
        $notFound = 0;

        foreach ($boatsData as $boatData) {
            // Skip si pas de published_at dans le JSON
            if (!isset($boatData['published_at'])) {
                continue;
            }

            // Trouver le bateau par slug
            $bateau = Bateau::where('slug', $boatData['slug'])->first();

            if ($bateau) {
                $bateau->published_at = $boatData['published_at'];
                $bateau->save();
                $updated++;
                echo "  ✓ {$bateau->modele}: " . date('d/m/Y H:i', strtotime($boatData['published_at'])) . "\n";
            } else {
                $notFound++;
                echo "  ⚠️  Bateau non trouvé: {$boatData['slug']}\n";
            }
        }

        echo "\n✅ {$updated} dates mises à jour";
        if ($notFound > 0) {
            echo " ({$notFound} bateaux non trouvés)";
        }
        echo ".\n";
    }
}
