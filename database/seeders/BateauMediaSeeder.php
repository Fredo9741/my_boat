<?php

namespace Database\Seeders;

use App\Models\Bateau;
use App\Models\Media;
use Illuminate\Database\Seeder;

class BateauMediaSeeder extends Seeder
{
    /**
     * Seed medias pour les bateaux depuis le JSON scrappé
     *
     * Les URLs pointent vers l'ancien site myboat-oi.com
     * TODO: Migrer les images vers Cloudflare R2
     */
    public function run(): void
    {
        echo "\n📸 Seeding medias des bateaux...\n\n";

        // Charger les données JSON
        $jsonPath = database_path('seeders/bateaux_scraped_data.json');

        if (!file_exists($jsonPath)) {
            echo "❌ Fichier JSON non trouvé: $jsonPath\n";
            return;
        }

        $boatsData = json_decode(file_get_contents($jsonPath), true);

        $totalImages = 0;
        $boatsWithImages = 0;

        foreach ($boatsData as $boatData) {
            $slug = $boatData['slug'] ?? null;
            $images = $boatData['images'] ?? [];

            if (!$slug || empty($images)) {
                continue;
            }

            // Trouver le bateau par slug
            $bateau = Bateau::where('slug', $slug)->first();

            if (!$bateau) {
                echo "  ⚠️  Bateau non trouvé: $slug\n";
                continue;
            }

            // Si le bateau a déjà des médias, on skip (ne pas écraser)
            if ($bateau->medias()->count() > 0) {
                echo "  ⏭️  {$bateau->modele}: a déjà des médias (skipped)\n";
                continue;
            }

            // Créer les nouvelles medias
            foreach ($images as $index => $imageUrl) {
                if (empty($imageUrl)) {
                    continue;
                }

                // Construire l'URL complète si relative
                $fullUrl = $imageUrl;
                if (str_starts_with($imageUrl, '/')) {
                    $fullUrl = 'https://www.myboat-oi.com' . $imageUrl;
                }

                Media::create([
                    'bateau_id' => $bateau->id,
                    'type' => 'image',
                    'url' => $fullUrl,
                    'ordre' => $index + 1,
                    'is_youtube' => false,
                ]);

                $totalImages++;
            }

            $boatsWithImages++;
            echo "  ✓ {$bateau->modele}: " . count($images) . " images\n";
        }

        echo "\n✅ $totalImages images ajoutées pour $boatsWithImages bateaux\n";
        echo "💡 Les images sont hébergées sur myboat-oi.com (à migrer vers R2 plus tard)\n";
    }
}
