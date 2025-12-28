<?php

namespace App\Console\Commands;

use App\Models\Bateau;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * UpdateBoatDescriptions Command
 *
 * Commande Artisan custom pour mettre à jour les descriptions des bateaux
 * sans avoir à modifier le DatabaseSeeder.php
 *
 * UTILISATION :
 *   php artisan boat:update-descriptions
 *   railway run php artisan boat:update-descriptions
 *   php artisan boat:update-descriptions --dry-run
 *   php artisan boat:update-descriptions --preview=10
 *
 * SÉCURITÉ :
 *   - Lecture seule avec --dry-run
 *   - Aperçu avec --preview
 *   - Confirmation requise par défaut
 *   - Transaction DB pour rollback en cas d'erreur
 *
 * @author Marketplace Bateaux
 * @created 2025-12-28
 */
class UpdateBoatDescriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'boat:update-descriptions
                            {--dry-run : Affiche les changements sans les appliquer}
                            {--no-confirm : Exécute sans demander confirmation}
                            {--preview= : Affiche un aperçu de N bateaux}
                            {--force : Force l\'exécution même si aucun changement détecté}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Met à jour les descriptions des bateaux depuis le fichier JSON';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->displayHeader();

        // Vérifier le mode dry-run
        $dryRun = $this->option('dry-run');
        if ($dryRun) {
            $this->warn('🔍 MODE DRY-RUN : Aucune modification ne sera appliquée');
            $this->newLine();
        }

        // Charger le JSON
        $jsonPath = database_path('seeders/bateaux_scraped_data.json');

        if (!file_exists($jsonPath)) {
            $this->error("❌ Fichier JSON introuvable : {$jsonPath}");
            $this->error('   Assurez-vous que le fichier bateaux_scraped_data.json existe.');
            return self::FAILURE;
        }

        $this->info('📁 Lecture du fichier JSON...');
        $boatsData = json_decode(file_get_contents($jsonPath), true);

        if (!$boatsData || !is_array($boatsData)) {
            $this->error('❌ Impossible de lire le JSON ou format invalide.');
            return self::FAILURE;
        }

        $this->info('   ✓ ' . count($boatsData) . ' bateaux trouvés dans le JSON');
        $this->newLine();

        // Mode preview
        if ($preview = $this->option('preview')) {
            return $this->showPreview($boatsData, (int) $preview);
        }

        // Analyser les changements
        $this->info('🔍 Analyse des changements...');
        $changes = $this->analyzeChanges($boatsData);

        // Afficher le résumé
        $this->displaySummary($changes);

        if ($changes['updated'] === 0) {
            $this->info('✅ Toutes les descriptions sont déjà à jour !');
            $this->info('   Aucune action nécessaire.');

            if (!$this->option('force')) {
                return self::SUCCESS;
            }

            $this->warn('   Option --force détectée, continuation...');
        }

        // Confirmation
        if (!$this->option('no-confirm') && !$dryRun) {
            if (!$this->confirm('Voulez-vous appliquer ces modifications ?', true)) {
                $this->warn('❌ Opération annulée par l\'utilisateur.');
                return self::FAILURE;
            }
        }

        // Appliquer les changements
        if (!$dryRun) {
            $this->newLine();
            return $this->applyChanges($boatsData, $changes);
        }

        $this->newLine();
        $this->info('✅ Analyse terminée (mode dry-run)');
        $this->info('   Pour appliquer les changements, exécutez sans --dry-run');

        return self::SUCCESS;
    }

    /**
     * Affiche l'en-tête de la commande
     */
    private function displayHeader(): void
    {
        $this->newLine();
        $this->info(str_repeat('=', 70));
        $this->info('  🔄 MISE À JOUR DES DESCRIPTIONS DE BATEAUX');
        $this->info(str_repeat('=', 70));
        $this->newLine();
    }

    /**
     * Analyse les changements à apporter
     */
    private function analyzeChanges(array $boatsData): array
    {
        $stats = [
            'updated' => 0,
            'unchanged' => 0,
            'not_found' => 0,
            'no_description' => 0,
            'details' => [],
        ];

        $bar = $this->output->createProgressBar(count($boatsData));
        $bar->start();

        foreach ($boatsData as $boatData) {
            $bar->advance();

            // Pas de description dans le JSON
            if (!isset($boatData['description']) || empty($boatData['description'])) {
                $stats['no_description']++;
                continue;
            }

            // Bateau existe ?
            $bateau = Bateau::where('slug', $boatData['slug'])->first();

            if (!$bateau) {
                $stats['not_found']++;
                $stats['details'][] = [
                    'slug' => $boatData['slug'],
                    'status' => 'not_found',
                ];
                continue;
            }

            // Description changée ?
            if ($bateau->description === $boatData['description']) {
                $stats['unchanged']++;
                continue;
            }

            // Changement détecté
            $stats['updated']++;
            $stats['details'][] = [
                'id' => $bateau->id,
                'slug' => $bateau->slug,
                'modele' => $bateau->modele,
                'old_length' => strlen($bateau->description ?? ''),
                'new_length' => strlen($boatData['description']),
                'status' => 'will_update',
            ];
        }

        $bar->finish();
        $this->newLine(2);

        return $stats;
    }

    /**
     * Affiche le résumé des changements
     */
    private function displaySummary(array $changes): void
    {
        $this->info('📊 RÉSUMÉ DES CHANGEMENTS');
        $this->info(str_repeat('-', 70));

        // Mises à jour
        if ($changes['updated'] > 0) {
            $this->info("✏️  À mettre à jour : {$changes['updated']} bateaux");
        }

        // Inchangés
        if ($changes['unchanged'] > 0) {
            $this->comment("✓  Déjà à jour : {$changes['unchanged']} bateaux");
        }

        // Non trouvés
        if ($changes['not_found'] > 0) {
            $this->warn("⚠️  Non trouvés en base : {$changes['not_found']} bateaux");
        }

        // Sans description
        if ($changes['no_description'] > 0) {
            $this->comment("○  Sans description JSON : {$changes['no_description']} bateaux");
        }

        $this->info(str_repeat('-', 70));
        $this->newLine();

        // Détails si peu de changements
        if ($changes['updated'] > 0 && $changes['updated'] <= 10) {
            $this->info('📋 Détails des bateaux à mettre à jour :');
            foreach ($changes['details'] as $detail) {
                if ($detail['status'] === 'will_update') {
                    $this->line("  • {$detail['modele']} ({$detail['slug']})");
                    $this->line("    {$detail['old_length']} → {$detail['new_length']} caractères");
                }
            }
            $this->newLine();
        }
    }

    /**
     * Applique les changements en base de données
     */
    private function applyChanges(array $boatsData, array $changes): int
    {
        $this->info('💾 Application des modifications...');

        $updated = 0;
        $errors = 0;

        DB::beginTransaction();

        try {
            $bar = $this->output->createProgressBar($changes['updated']);
            $bar->start();

            foreach ($boatsData as $boatData) {
                // Skip si pas de description
                if (!isset($boatData['description']) || empty($boatData['description'])) {
                    continue;
                }

                $bateau = Bateau::where('slug', $boatData['slug'])->first();

                // Skip si non trouvé ou inchangé
                if (!$bateau || $bateau->description === $boatData['description']) {
                    continue;
                }

                // Mettre à jour
                $bateau->description = $boatData['description'];
                $bateau->save();

                $updated++;
                $bar->advance();
            }

            $bar->finish();
            $this->newLine(2);

            DB::commit();

            // Résultat final
            $this->displayFinalReport($updated, $errors, $changes);

            return self::SUCCESS;

        } catch (\Exception $e) {
            DB::rollBack();

            $this->newLine(2);
            $this->error('❌ ERREUR : La transaction a été annulée');
            $this->error("   {$e->getMessage()}");
            $this->newLine();
            $this->warn('💡 Aucune modification n\'a été appliquée grâce au rollback.');

            return self::FAILURE;
        }
    }

    /**
     * Affiche le rapport final
     */
    private function displayFinalReport(int $updated, int $errors, array $changes): void
    {
        $this->newLine();
        $this->info(str_repeat('=', 70));
        $this->info('  ✅ OPÉRATION TERMINÉE AVEC SUCCÈS');
        $this->info(str_repeat('=', 70));
        $this->newLine();

        $this->info("📝 {$updated} descriptions mises à jour");

        if ($changes['unchanged'] > 0) {
            $this->comment("✓  {$changes['unchanged']} descriptions déjà à jour");
        }

        if ($changes['not_found'] > 0) {
            $this->warn("⚠️  {$changes['not_found']} bateaux non trouvés en base");
        }

        $this->newLine();
        $this->info('💡 Prochaines étapes :');
        $this->line('   • Vérifiez les changements sur votre site');
        $this->line('   • Les descriptions sont maintenant synchronisées avec le JSON');
        $this->newLine();
    }

    /**
     * Affiche un aperçu des changements
     */
    private function showPreview(array $boatsData, int $limit): int
    {
        $this->info("📋 APERÇU DES {$limit} PREMIERS BATEAUX");
        $this->info(str_repeat('=', 70));
        $this->newLine();

        $count = 0;

        foreach ($boatsData as $boatData) {
            if ($count >= $limit) break;

            if (!isset($boatData['description'])) {
                continue;
            }

            $bateau = Bateau::where('slug', $boatData['slug'])->first();

            if (!$bateau) {
                $this->warn("  ⚠️  {$boatData['slug']} - Non trouvé en base");
                $count++;
                continue;
            }

            $changed = $bateau->description !== $boatData['description'];
            $status = $changed ? '🔄 SERA MODIFIÉ' : '✓ Déjà à jour';

            $this->line("  {$count}. {$bateau->modele} ({$bateau->slug})");
            $this->line("     Statut : {$status}");
            $this->line("     Longueur actuelle : " . strlen($bateau->description ?? '') . " caractères");
            $this->line("     Longueur nouvelle : " . strlen($boatData['description']) . " caractères");

            if ($changed) {
                $this->line("     Ancien début : " . substr($bateau->description ?? '', 0, 60) . '...');
                $this->line("     Nouveau début : " . substr($boatData['description'], 0, 60) . '...');
            }

            $this->newLine();
            $count++;
        }

        $this->info(str_repeat('=', 70));
        $this->info('💡 Pour appliquer les changements : php artisan boat:update-descriptions');

        return self::SUCCESS;
    }
}
