<?php

namespace App\Console\Commands;

use App\Models\Media;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CleanOrphanedR2Files extends Command
{
    protected $signature = 'r2:clean-orphaned {--dry-run : Show what would be deleted without actually deleting}';
    protected $description = 'Clean orphaned files from R2 that are not referenced in database';

    public function handle()
    {
        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->warn('🔍 DRY RUN MODE - No files will be deleted');
        } else {
            $this->warn('⚠️  WARNING: This will DELETE orphaned files from R2');
            if (!$this->confirm('Do you want to continue?')) {
                $this->info('Operation cancelled.');
                return 0;
            }
        }

        $this->info('🔍 Scanning R2 bucket for orphaned files...');
        $this->newLine();

        // Get all file paths from database
        $dbPaths = DB::table('medias')
            ->where('type', 'image')
            ->where('is_youtube', 0)
            ->pluck('url')
            ->map(function ($url) {
                // Remove R2 URL prefix if present
                return str_replace('https://files.fredlabs.org/', '', $url);
            })
            ->toArray();

        $this->info('📊 Found ' . count($dbPaths) . ' images in database');
        $this->newLine();

        // Get all files from R2
        $allFiles = Storage::disk('cloudflare')->allFiles('bateaux');
        $this->info('📊 Found ' . count($allFiles) . ' files in R2');
        $this->newLine();

        // Find orphaned files (in R2 but not in DB)
        $orphanedFiles = array_diff($allFiles, $dbPaths);

        if (count($orphanedFiles) === 0) {
            $this->info('✅ No orphaned files found!');
            return 0;
        }

        $this->warn('🗑️  Found ' . count($orphanedFiles) . ' orphaned files:');
        $this->newLine();

        $bar = $this->output->createProgressBar(count($orphanedFiles));
        $bar->start();

        $deleted = 0;
        $failed = 0;

        foreach ($orphanedFiles as $file) {
            try {
                if (!$dryRun) {
                    Storage::disk('cloudflare')->delete($file);
                }
                $deleted++;
            } catch (\Exception $e) {
                $failed++;
                $this->error("Failed to delete: {$file}");
            }
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info('✅ Cleanup complete!');
        $this->table(
            ['Status', 'Count'],
            [
                ['🗑️  Deleted', $deleted],
                ['❌ Failed', $failed],
            ]
        );

        if ($dryRun) {
            $this->newLine();
            $this->warn('⚠️  DRY RUN - No files were actually deleted');
            $this->info('Run without --dry-run to actually delete the files');
        }

        return 0;
    }
}
