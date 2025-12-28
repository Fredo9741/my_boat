<?php

namespace Database\Seeders;

use App\Models\Bateau;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SetPublishedDatesSeeder extends Seeder
{
    /**
     * Assigne des dates de publication aux bateaux qui n'en ont pas
     * Génère des dates réparties sur les 6 derniers mois
     */
    public function run(): void
    {
        echo "\n📅 Attribution des dates de publication...\n\n";

        $bateaux = Bateau::whereNull('published_at')->get();

        if ($bateaux->isEmpty()) {
            echo "✅ Tous les bateaux ont déjà une date de publication.\n";
            return;
        }

        $count = 0;
        $now = Carbon::now();

        foreach ($bateaux as $bateau) {
            // Générer une date aléatoire entre 6 mois et aujourd'hui
            $randomDaysAgo = rand(0, 180);
            $publishedAt = $now->copy()->subDays($randomDaysAgo);

            $bateau->published_at = $publishedAt;
            $bateau->save();

            $count++;
            echo "  ✓ {$bateau->modele}: " . $publishedAt->format('d/m/Y') . "\n";
        }

        echo "\n✅ {$count} dates de publication assignées.\n";
    }
}
