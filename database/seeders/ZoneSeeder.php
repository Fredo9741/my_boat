<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZoneSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('zones')->insert([
            'libelle' => 'La Réunion',
            'slug' => 'la-reunion',
            'libelle_translations' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('zones')->insert([
            'libelle' => 'Madagascar',
            'slug' => 'madagascar',
            'libelle_translations' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('zones')->insert([
            'libelle' => 'Maurice',
            'slug' => 'maurice',
            'libelle_translations' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('zones')->insert([
            'libelle' => 'Mayotte',
            'slug' => 'mayotte',
            'libelle_translations' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('zones')->insert([
            'libelle' => 'Seychelles',
            'slug' => 'seychelles',
            'libelle_translations' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
