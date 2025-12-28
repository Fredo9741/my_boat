<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    /**
     * Seed des actions/badges (avec couleurs)
     *
     * COMPORTEMENT INTELLIGENT :
     * - Ajoute les badges manquants
     * - Met à jour les badges existants (via slug)
     * - Préserve les badges ajoutés manuellement en production
     * - Met à jour les couleurs si modifiées dans le code
     * - Peut être exécuté à chaque déploiement sans risque
     */
    public function run(): void
    {
        $actions = [
            ['libelle' => 'Affaire à saisir', 'slug' => 'affaire-a-saisir', 'libelle_translations' => null, 'color' => 'orange'],
            ['libelle' => 'Coup de coeur', 'slug' => 'coup-de-coeur', 'libelle_translations' => null, 'color' => 'pink'],
            ['libelle' => 'État exceptionnel', 'slug' => 'etat-exceptionnel', 'libelle_translations' => null, 'color' => 'green'],
            ['libelle' => 'Exclusivité', 'slug' => 'exclusivite', 'libelle_translations' => null, 'color' => 'purple'],
            ['libelle' => 'Grand entretien récent', 'slug' => 'grand-entretien-recent', 'libelle_translations' => null, 'color' => 'blue'],
            ['libelle' => 'Idéal première acquisition', 'slug' => 'ideal-premiere-acquisition', 'libelle_translations' => null, 'color' => 'green'],
            ['libelle' => 'Nouveau sur le marché', 'slug' => 'nouveau-sur-le-marche', 'libelle_translations' => null, 'color' => 'blue'],
            ['libelle' => 'Prêt à naviguer', 'slug' => 'pret-a-naviguer', 'libelle_translations' => null, 'color' => 'green'],
            ['libelle' => 'Prix en baisse !', 'slug' => 'prix-en-baisse', 'libelle_translations' => null, 'color' => 'orange'],
            ['libelle' => 'Rare sur le marché', 'slug' => 'rare-sur-le-marche', 'libelle_translations' => null, 'color' => 'purple'],
            ['libelle' => 'Sous offre', 'slug' => 'sous-offre', 'libelle_translations' => null, 'color' => 'yellow'],
            ['libelle' => 'Urgent - Vente rapide', 'slug' => 'urgent-vente-rapide', 'libelle_translations' => null, 'color' => 'red'],
            ['libelle' => 'Vendu', 'slug' => 'vendu', 'libelle_translations' => null, 'color' => 'gray'],
            ['libelle' => 'Visible sur rendez-vous', 'slug' => 'visible-sur-rendez-vous', 'libelle_translations' => null, 'color' => 'blue'],
        ];

        foreach ($actions as $action) {
            Action::updateOrCreate(
                ['slug' => $action['slug']],
                $action
            );
        }
    }
}
