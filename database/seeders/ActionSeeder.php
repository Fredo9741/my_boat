<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = [
            'Prix en baisse !',
            'Nouveau sur le marché',
            'Affaire à saisir',
            'Exclusivité',
            'Urgent - Vente rapide',
            'Rare sur le marché',
            'État exceptionnel',
            'Grand entretien récent',
            'Prêt à naviguer',
            'Idéal première acquisition',
            'Coup de coeur',
            'Visible sur rendez-vous',
        ];

        foreach ($actions as $action) {
            DB::table('actions')->insert([
                'libelle' => $action,
                'slug' => Str::slug($action),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
