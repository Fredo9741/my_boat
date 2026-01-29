<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LangSyncCommand extends Command
{
    protected $signature = 'lang:sync
                            {--source=fr : Source language file (without .json)}
                            {--dry-run : Show changes without writing files}';

    protected $description = 'Sync translation keys from source language to all other JSON language files';

    public function handle(): int
    {
        $source = $this->option('source');
        $dryRun = $this->option('dry-run');
        $langPath = lang_path();

        $sourceFile = "{$langPath}/{$source}.json";

        if (!File::exists($sourceFile)) {
            $this->error("Source file not found: {$sourceFile}");
            return self::FAILURE;
        }

        // Load source translations
        $sourceContent = File::get($sourceFile);
        $sourceTranslations = json_decode($sourceContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error("Invalid JSON in source file: " . json_last_error_msg());
            return self::FAILURE;
        }

        $sourceKeys = array_keys($sourceTranslations);
        $this->info("Source: {$source}.json ({$this->count($sourceKeys)} keys)");
        $this->newLine();

        // Find all other JSON files
        $jsonFiles = File::glob("{$langPath}/*.json");
        $totalAdded = 0;
        $totalRemoved = 0;

        foreach ($jsonFiles as $file) {
            $filename = basename($file);
            $locale = pathinfo($filename, PATHINFO_FILENAME);

            // Skip source file
            if ($locale === $source) {
                continue;
            }

            $targetContent = File::get($file);
            $targetTranslations = json_decode($targetContent, true) ?? [];

            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->warn("Skipping {$filename}: Invalid JSON");
                continue;
            }

            $targetKeys = array_keys($targetTranslations);

            // Find missing keys (in source but not in target)
            $missingKeys = array_diff($sourceKeys, $targetKeys);

            // Find extra keys (in target but not in source)
            $extraKeys = array_diff($targetKeys, $sourceKeys);

            if (empty($missingKeys) && empty($extraKeys)) {
                $this->line("<fg=green>[OK]</> {$filename} - All keys synced");
                continue;
            }

            $this->line("<fg=yellow>[SYNC]</> {$filename}:");

            // Add missing keys with placeholder
            $added = 0;
            foreach ($missingKeys as $key) {
                $placeholder = "[TODO:{$locale}] " . $sourceTranslations[$key];
                $targetTranslations[$key] = $placeholder;
                $added++;

                if ($this->output->isVerbose()) {
                    $this->line("  <fg=green>+</> {$key}");
                }
            }

            // Report extra keys (don't remove, just warn)
            if (!empty($extraKeys) && $this->output->isVerbose()) {
                foreach ($extraKeys as $key) {
                    $this->line("  <fg=gray>?</> {$key} (extra key, not in source)");
                }
            }

            $this->line("  Added: <fg=green>{$added}</> keys");
            if (!empty($extraKeys)) {
                $this->line("  Extra: <fg=gray>" . count($extraKeys) . "</> keys (kept)");
            }

            $totalAdded += $added;

            // Write updated file
            if (!$dryRun && $added > 0) {
                // Sort keys to match source order
                $sortedTranslations = [];
                foreach ($sourceKeys as $key) {
                    if (isset($targetTranslations[$key])) {
                        $sortedTranslations[$key] = $targetTranslations[$key];
                    }
                }
                // Add any extra keys at the end
                foreach ($extraKeys as $key) {
                    $sortedTranslations[$key] = $targetTranslations[$key];
                }

                $json = json_encode(
                    $sortedTranslations,
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
                );

                File::put($file, $json . "\n");
                $this->line("  <fg=cyan>Written to disk</>");
            }

            $this->newLine();
        }

        // Summary
        $this->newLine();
        if ($dryRun) {
            $this->info("DRY RUN - No files modified");
            $this->info("Would add {$totalAdded} keys across all files");
        } else {
            $this->info("Sync complete: {$totalAdded} keys added");
        }

        // Show TODO reminder
        if ($totalAdded > 0) {
            $this->newLine();
            $this->warn("Search for [TODO:xx] in your JSON files to find untranslated strings");
        }

        return self::SUCCESS;
    }

    private function count(array $items): int
    {
        return count($items);
    }
}
