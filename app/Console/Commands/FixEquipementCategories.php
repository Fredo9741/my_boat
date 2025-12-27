<?php

namespace App\Console\Commands;

use App\Models\Equipement;
use Illuminate\Console\Command;

class FixEquipementCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'equipements:fix-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix equipment categories from uppercase to lowercase (ONE TIME ONLY)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔧 Fixing equipment categories...');

        $mapping = [
            'Navigation' => 'navigation',
            'Confort' => 'confort',
            'Sécurité' => 'securite',
            'Électronique' => 'electronique',
            'Manœuvre' => 'manoeuvre',
            'Loisirs' => 'loisirs',
        ];

        $updated = 0;
        foreach ($mapping as $old => $new) {
            $count = Equipement::where('categorie', $old)
                ->update(['categorie' => $new]);
            $updated += $count;

            if ($count > 0) {
                $this->info("  ✓ Updated {$count} equipments from '{$old}' to '{$new}'");
            }
        }

        if ($updated > 0) {
            $this->info("✅ Total: {$updated} equipment categories fixed!");
        } else {
            $this->comment('ℹ️  No categories needed fixing (already lowercase)');
        }

        return 0;
    }
}
