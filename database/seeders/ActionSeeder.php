<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    public function run(): void
    {
        $actions = [
            ['libelle' => 'Affaire à saisir', 'slug' => 'affaire-a-saisir', 'libelle_translations' => null, 'color' => 'gray'],
            ['libelle' => 'Coup de coeur', 'slug' => 'coup-de-coeur', 'libelle_translations' => null, 'color' => 'gray'],
            ['libelle' => 'État exceptionnel', 'slug' => 'etat-exceptionnel', 'libelle_translations' => null, 'color' => 'gray'],
            ['libelle' => 'Exclusivité', 'slug' => 'exclusivite', 'libelle_translations' => null, 'color' => 'gray'],
            ['libelle' => 'Grand entretien récent', 'slug' => 'grand-entretien-recent', 'libelle_translations' => null, 'color' => 'gray'],
            ['libelle' => 'Idéal première acquisition', 'slug' => 'ideal-premiere-acquisition', 'libelle_translations' => null, 'color' => 'gray'],
            ['libelle' => 'Nouveau sur le marché', 'slug' => 'nouveau-sur-le-marche', 'libelle_translations' => null, 'color' => 'gray'],
            ['libelle' => 'Prêt à naviguer', 'slug' => 'pret-a-naviguer', 'libelle_translations' => null, 'color' => 'gray'],
            ['libelle' => 'Prix en baisse !', 'slug' => 'prix-en-baisse', 'libelle_translations' => null, 'color' => 'gray'],
            ['libelle' => 'Rare sur le marché', 'slug' => 'rare-sur-le-marche', 'libelle_translations' => null, 'color' => 'gray'],
            ['libelle' => 'Sous offre', 'slug' => 'sous-offre', 'libelle_translations' => null, 'color' => 'yellow'],
            ['libelle' => 'Urgent - Vente rapide', 'slug' => 'urgent-vente-rapide', 'libelle_translations' => null, 'color' => 'gray'],
            ['libelle' => 'Vendu', 'slug' => 'vendu', 'libelle_translations' => null, 'color' => 'red'],
            ['libelle' => 'Visible sur rendez-vous', 'slug' => 'visible-sur-rendez-vous', 'libelle_translations' => null, 'color' => 'gray'],
        ];

        foreach ($actions as $action) {
            Action::updateOrCreate(
                ['slug' => $action['slug']],
                $action
            );
        }
    }
}
