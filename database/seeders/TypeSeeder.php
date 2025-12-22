<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Catamaran',
            'Voilier monocoque',
            'Bateau à moteur',
            'Semi-rigide',
            'Yacht',
            'Péniche',
            'Trimaran',
            'Vedette',
            'Jet-ski',
            'Kayak',
            'Paddle',
            'Bateau de pêche',
            'Voilier habitable',
            'Day-boat',
            'Annexe',
        ];

        foreach ($types as $type) {
            DB::table('types')->insert([
                'libelle' => $type,
                'slug' => Str::slug($type),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
