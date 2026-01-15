<?php

namespace App\Console\Commands;

use App\Models\Bateau;
use Illuminate\Console\Command;

class CleanBoatDescriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'boats:clean-descriptions {--dry-run : Run without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Nettoie les descriptions des bateaux (remplace \\n par de vrais sauts de ligne)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->warn('🔍 Mode DRY RUN - Aucune modification ne sera effectuée');
        }

        $this->info('🚤 Nettoyage des descriptions des bateaux...');
        $this->newLine();

        $bateaux = Bateau::whereNotNull('description')
            ->where('description', '!=', '')
            ->get();

        if ($bateaux->isEmpty()) {
            $this->error('❌ Aucun bateau trouvé avec une description');
            return 1;
        }

        $this->info("📊 Total de bateaux à traiter : {$bateaux->count()}");
        $this->newLine();

        $bar = $this->output->createProgressBar($bateaux->count());
        $bar->start();

        $cleaned = 0;
        $skipped = 0;

        foreach ($bateaux as $bateau) {
            $original = $bateau->description;
            $cleaned_text = $this->cleanDescription($original);

            if ($cleaned_text !== $original) {
                if (!$dryRun) {
                    $bateau->description = $cleaned_text;
                    $bateau->save();
                }
                $cleaned++;
            } else {
                $skipped++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        // Afficher le résumé
        $this->info('✅ Nettoyage terminé !');
        $this->newLine();

        $this->table(
            ['Statut', 'Nombre'],
            [
                ['✅ Nettoyées', $cleaned],
                ['⏭️  Déjà propres', $skipped],
                ['📊 Total', $bateaux->count()],
            ]
        );

        if ($dryRun) {
            $this->newLine();
            $this->warn('⚠️  Mode DRY RUN - Aucune modification n\'a été effectuée');
            $this->info('💡 Exécutez sans --dry-run pour appliquer les changements');
        }

        return 0;
    }

    /**
     * Nettoie une description
     */
    private function cleanDescription(string $description): string
    {
        // Remplace les \n littéraux par de vrais sauts de ligne
        $cleaned = str_replace('\n', "\n", $description);

        // Supprime les patterns comme \n\n\ ou backslashes en fin de ligne
        $cleaned = preg_replace('/\\\+\s*$/', '', $cleaned);
        $cleaned = preg_replace('/\n\\\+/', "\n", $cleaned);

        // Remplace les sauts de ligne multiples (3+) par maximum 2
        $cleaned = preg_replace('/\n{3,}/', "\n\n", $cleaned);

        // Trim les espaces de chaque ligne
        $lines = explode("\n", $cleaned);
        $lines = array_map('trim', $lines);
        $cleaned = implode("\n", $lines);

        // Trim global
        $cleaned = trim($cleaned);

        return $cleaned;
    }
}
