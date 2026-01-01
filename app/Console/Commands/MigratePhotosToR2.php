<?php

namespace App\Console\Commands;

use App\Models\Bateau;
use App\Models\Media;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class MigratePhotosToR2 extends Command
{
    protected $signature = 'photos:migrate-to-r2 {--dry-run : Run without making changes}';
    protected $description = 'Télécharger et migrer toutes les photos des bateaux depuis les URLs externes vers Cloudflare R2';

    public function handle()
    {
        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->warn('🔍 Mode DRY RUN - Aucune modification ne sera effectuée');
        }

        $this->info('🚀 Début de la migration des photos vers Cloudflare R2...');
        $this->newLine();

        // Récupérer toutes les images de bateaux (exclure les vidéos YouTube)
        $images = Media::where('type', 'image')
            ->where('is_youtube', false)
            ->orderBy('bateau_id')
            ->get();

        $totalImages = $images->count();

        if ($totalImages === 0) {
            $this->error('❌ Aucune image trouvée dans la base de données');
            return 1;
        }

        $this->info("📊 Total d'images à migrer : {$totalImages}");
        $this->newLine();

        $bar = $this->output->createProgressBar($totalImages);
        $bar->start();

        $migrated = 0;
        $failed = 0;
        $skipped = 0;
        $alreadyMigrated = 0;
        $errors = [];

        foreach ($images as $media) {
            try {
                $originalUrl = $media->url;

                // Si l'URL contient déjà notre domaine R2, c'est déjà migré
                if (str_contains($originalUrl, env('CLOUDFLARE_R2_URL'))) {
                    $alreadyMigrated++;
                    $bar->advance();
                    continue;
                }

                // Vérifier que c'est bien une URL externe
                if (!str_starts_with($originalUrl, 'http://') && !str_starts_with($originalUrl, 'https://')) {
                    $skipped++;
                    $errors[] = "⏭️  URL invalide pour media #{$media->id}: {$originalUrl}";
                    $bar->advance();
                    continue;
                }

                // Télécharger l'image depuis l'URL (sans vérification SSL pour Windows/XAMPP)
                $response = Http::withoutVerifying()->timeout(30)->get($originalUrl);

                if (!$response->successful()) {
                    $failed++;
                    $errors[] = "❌ Échec du téléchargement pour media #{$media->id}: HTTP {$response->status()}";
                    $bar->advance();
                    continue;
                }

                // Récupérer le contenu de l'image
                $imageContents = $response->body();

                // Déterminer l'extension depuis l'URL ou le Content-Type
                $extension = pathinfo($originalUrl, PATHINFO_EXTENSION);
                if (empty($extension) || strlen($extension) > 5) {
                    // Utiliser le Content-Type si l'extension est bizarre
                    $contentType = $response->header('Content-Type');
                    $extensionMap = [
                        'image/jpeg' => 'jpg',
                        'image/jpg' => 'jpg',
                        'image/png' => 'png',
                        'image/gif' => 'gif',
                        'image/webp' => 'webp',
                    ];
                    $extension = $extensionMap[$contentType] ?? 'jpg';
                }

                // Générer un nom de fichier unique
                $filename = Str::slug($media->bateau->nom ?? 'bateau') . '-' . $media->id . '-' . now()->timestamp;
                $bateauId = $media->bateau_id;

                // Nouveau chemin : bateaux/{bateau_id}/{filename}.{extension}
                $newPath = "bateaux/{$bateauId}/{$filename}.{$extension}";

                if (!$dryRun) {
                    // Uploader vers R2
                    Storage::disk('cloudflare')->put($newPath, $imageContents, 'public');

                    // Mettre à jour l'URL dans la base de données
                    $media->update([
                        'url' => $newPath
                    ]);
                }

                $migrated++;
            } catch (\Exception $e) {
                $failed++;
                $errors[] = "❌ Erreur pour media #{$media->id} ({$media->url}): " . $e->getMessage();
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        // Afficher le résumé
        $this->info('✅ Migration terminée !');
        $this->newLine();

        $this->table(
            ['Statut', 'Nombre'],
            [
                ['✅ Migrées', $migrated],
                ['❌ Échouées', $failed],
                ['⏭️  Ignorées', $skipped],
                ['✔️  Déjà migrées', $alreadyMigrated],
            ]
        );

        // Afficher les erreurs si présentes
        if (count($errors) > 0) {
            $this->newLine();
            $this->error('Erreurs rencontrées :');
            foreach ($errors as $error) {
                $this->line($error);
            }
        }

        if ($dryRun) {
            $this->newLine();
            $this->warn('⚠️  Mode DRY RUN - Aucune modification n\'a été effectuée');
            $this->info('💡 Exécutez sans --dry-run pour effectuer la migration réelle');
        }

        return 0;
    }
}
