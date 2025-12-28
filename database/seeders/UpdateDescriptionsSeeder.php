<?php

namespace Database\Seeders;

use App\Models\Bateau;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * UpdateDescriptionsSeeder
 *
 * OBJECTIF : Met à jour uniquement les descriptions des bateaux existants
 *
 * COMPORTEMENT SAFE :
 * - Ne crée JAMAIS de nouveaux bateaux
 * - Ne supprime JAMAIS de données
 * - Ne modifie que la colonne 'description'
 * - Peut être exécuté plusieurs fois sans danger (idempotent)
 *
 * UTILISATION :
 * - Via DatabaseSeeder : Décommenter dans DatabaseSeeder.php
 * - Via commande directe : php artisan db:seed --class=UpdateDescriptionsSeeder
 * - Via commande custom : php artisan boat:update-descriptions
 *
 * CRÉÉ LE : 2025-12-28
 */
class UpdateDescriptionsSeeder extends Seeder
{
    /**
     * Met à jour les descriptions des bateaux existants depuis le JSON
     */
    public function run(): void
    {
        $this->command->info("\n" . str_repeat('=', 70));
        $this->command->info("🔄 MISE À JOUR DES DESCRIPTIONS DE BATEAUX");
        $this->command->info(str_repeat('=', 70) . "\n");

        // Charger le JSON
        $jsonPath = database_path('seeders/bateaux_scraped_data.json');

        if (!file_exists($jsonPath)) {
            $this->command->error("❌ Fichier JSON introuvable : {$jsonPath}");
            $this->command->error("   Assurez-vous que le fichier existe à l'emplacement correct.\n");
            return;
        }

        $this->command->info("📁 Lecture du fichier JSON...");
        $boatsData = json_decode(file_get_contents($jsonPath), true);

        if (!$boatsData || !is_array($boatsData)) {
            $this->command->error("❌ Impossible de lire le JSON ou format invalide.\n");
            return;
        }

        $this->command->info("   ✓ {count($boatsData)} bateaux trouvés dans le JSON\n");

        // Compteurs pour le rapport final
        $stats = [
            'updated' => 0,
            'skipped_no_description' => 0,
            'skipped_not_found' => 0,
            'unchanged' => 0,
        ];

        // Progress bar
        $this->command->getOutput()->writeln("🔍 Traitement des bateaux...\n");
        $bar = $this->command->getOutput()->createProgressBar(count($boatsData));
        $bar->start();

        // Traiter chaque bateau
        DB::transaction(function () use ($boatsData, &$stats, $bar) {
            foreach ($boatsData as $boatData) {
                $bar->advance();

                // Vérification : le JSON contient-il une description ?
                if (!isset($boatData['description']) || empty($boatData['description'])) {
                    $stats['skipped_no_description']++;
                    continue;
                }

                // Vérification : le bateau existe-t-il en base ?
                $bateau = Bateau::where('slug', $boatData['slug'])->first();

                if (!$bateau) {
                    $stats['skipped_not_found']++;
                    continue;
                }

                // Vérification : la description a-t-elle changé ?
                if ($bateau->description === $boatData['description']) {
                    $stats['unchanged']++;
                    continue;
                }

                // MISE À JOUR : Modification de la description uniquement
                $oldLength = strlen($bateau->description ?? '');
                $newLength = strlen($boatData['description']);

                $bateau->description = $boatData['description'];
                $bateau->save();

                $stats['updated']++;
            }
        });

        $bar->finish();
        $this->command->newLine(2);

        // Affichage du rapport détaillé
        $this->command->info(str_repeat('=', 70));
        $this->command->info("📊 RAPPORT DE MISE À JOUR");
        $this->command->info(str_repeat('=', 70));

        // Succès
        if ($stats['updated'] > 0) {
            $this->command->info("\n✅ Descriptions mises à jour : {$stats['updated']}");
        }

        // Inchangés
        if ($stats['unchanged'] > 0) {
            $this->command->comment("   Descriptions identiques (non modifiées) : {$stats['unchanged']}");
        }

        // Avertissements
        if ($stats['skipped_no_description'] > 0) {
            $this->command->warn("\n⚠️  Bateaux sans description dans le JSON : {$stats['skipped_no_description']}");
        }

        if ($stats['skipped_not_found'] > 0) {
            $this->command->warn("⚠️  Bateaux du JSON non trouvés en base : {$stats['skipped_not_found']}");
            $this->command->comment("   (Cela peut être normal si certains bateaux ont été supprimés)");
        }

        // Total
        $total = array_sum($stats);
        $this->command->info("\n" . str_repeat('-', 70));
        $this->command->info("📈 Total traité : {$total} bateaux");
        $this->command->info(str_repeat('=', 70) . "\n");

        // Conseils finaux
        if ($stats['updated'] > 0) {
            $this->command->info("💡 Les descriptions ont été mises à jour avec succès !");
            $this->command->info("   Vous pouvez vérifier les changements sur votre site.\n");
        } else {
            $this->command->comment("💡 Aucune description n'a été modifiée.");
            $this->command->comment("   Toutes les descriptions étaient déjà à jour.\n");
        }
    }

    /**
     * Affiche un aperçu des changements (pour débogage)
     */
    private function showPreview(array $boatsData, int $limit = 5): void
    {
        $this->command->info("\n📋 Aperçu des {$limit} premiers bateaux :");

        $count = 0;
        foreach ($boatsData as $boatData) {
            if ($count >= $limit) break;

            $bateau = Bateau::where('slug', $boatData['slug'])->first();

            if ($bateau && isset($boatData['description'])) {
                $this->command->info("\n  • {$bateau->modele} ({$bateau->slug})");
                $this->command->info("    Ancienne longueur : " . strlen($bateau->description ?? '') . " caractères");
                $this->command->info("    Nouvelle longueur : " . strlen($boatData['description']) . " caractères");
                $count++;
            }
        }

        $this->command->newLine();
    }
}
