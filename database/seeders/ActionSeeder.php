<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('actions')->insert([
            'libelle' => 'Affaire à saisir',
            'slug' => 'affaire-a-saisir',
            'libelle_translations' => null,
            'color' => 'gray',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('actions')->insert([
            'libelle' => 'Coup de coeur',
            'slug' => 'coup-de-coeur',
            'libelle_translations' => null,
            'color' => 'gray',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('actions')->insert([
            'libelle' => 'État exceptionnel',
            'slug' => 'etat-exceptionnel',
            'libelle_translations' => null,
            'color' => 'gray',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('actions')->insert([
            'libelle' => 'Exclusivité',
            'slug' => 'exclusivite',
            'libelle_translations' => null,
            'color' => 'gray',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('actions')->insert([
            'libelle' => 'Grand entretien récent',
            'slug' => 'grand-entretien-recent',
            'libelle_translations' => null,
            'color' => 'gray',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('actions')->insert([
            'libelle' => 'Idéal première acquisition',
            'slug' => 'ideal-premiere-acquisition',
            'libelle_translations' => null,
            'color' => 'gray',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('actions')->insert([
            'libelle' => 'Nouveau sur le marché',
            'slug' => 'nouveau-sur-le-marche',
            'libelle_translations' => null,
            'color' => 'gray',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('actions')->insert([
            'libelle' => 'Prêt à naviguer',
            'slug' => 'pret-a-naviguer',
            'libelle_translations' => null,
            'color' => 'gray',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('actions')->insert([
            'libelle' => 'Prix en baisse !',
            'slug' => 'prix-en-baisse',
            'libelle_translations' => null,
            'color' => 'gray',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('actions')->insert([
            'libelle' => 'Rare sur le marché',
            'slug' => 'rare-sur-le-marche',
            'libelle_translations' => null,
            'color' => 'gray',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('actions')->insert([
            'libelle' => 'Sous offre',
            'slug' => 'sous-offre',
            'libelle_translations' => null,
            'color' => 'yellow',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('actions')->insert([
            'libelle' => 'Urgent - Vente rapide',
            'slug' => 'urgent-vente-rapide',
            'libelle_translations' => null,
            'color' => 'gray',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('actions')->insert([
            'libelle' => 'Vendu',
            'slug' => 'vendu',
            'libelle_translations' => null,
            'color' => 'red',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('actions')->insert([
            'libelle' => 'Visible sur rendez-vous',
            'slug' => 'visible-sur-rendez-vous',
            'libelle_translations' => null,
            'color' => 'gray',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
