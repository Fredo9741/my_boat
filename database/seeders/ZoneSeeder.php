<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = [
            'La Réunion - Saint-Denis',
            'La Réunion - Saint-Pierre',
            'La Réunion - Saint-Paul',
            'La Réunion - Saint-Gilles',
            'Maurice - Port-Louis',
            'Maurice - Grand Baie',
            'Maurice - Mahébourg',
            'Madagascar - Nosy Be',
            'Madagascar - Antananarivo',
            'Madagascar - Tuléar',
            'Madagascar - Fort-Dauphin',
            'Mayotte - Mamoudzou',
            'Seychelles - Victoria',
            'Comores - Moroni',
            'Océan Indien - International',
        ];

        foreach ($zones as $zone) {
            DB::table('zones')->insert([
                'libelle' => $zone,
                'slug' => Str::slug($zone),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
