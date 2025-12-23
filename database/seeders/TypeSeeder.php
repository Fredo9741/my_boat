<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('types')->insert([
            'libelle' => 'Bateau Moteur',
            'slug' => 'bateau-moteur',
            'libelle_translations' => null,
            'photo' => 'types/wIE8UvU8NicuHXZEX5RkNcAJ9j1AzcRzToLbY7cP.jpg',
            'icone' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('types')->insert([
            'libelle' => 'Catamaran à moteur',
            'slug' => 'catamaran-a-moteur',
            'libelle_translations' => null,
            'photo' => 'types/MLBmQr1SQm1kF2pQY37FVsqjp1Tvit68LJ1K9kyY.webp',
            'icone' => 'fa-ship',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('types')->insert([
            'libelle' => 'Catamaran à voile',
            'slug' => 'catamaran-a-voile',
            'libelle_translations' => null,
            'photo' => 'types/aDceQcVxBkUbkWZw1T2wWhmWFTtpkfLvwEFPBe60.webp',
            'icone' => 'fa-dharmachakra',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('types')->insert([
            'libelle' => 'Trimaran',
            'slug' => 'trimaran',
            'libelle_translations' => null,
            'photo' => 'types/5SzSV0xsR33Nuqpm2p1XJHWgofBt36IRFUOYeOBu.jpg',
            'icone' => 'fa-life-ring',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('types')->insert([
            'libelle' => 'Vedette',
            'slug' => 'vedette',
            'libelle_translations' => null,
            'photo' => 'types/bFGEcDXk5pQGA9NgnxQTYC1YspCPMtNSqFR7BtrW.webp',
            'icone' => 'fa-ferry',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('types')->insert([
            'libelle' => 'Voilier monocoque',
            'slug' => 'voilier-monocoque',
            'libelle_translations' => null,
            'photo' => 'types/voMcJqrTqluEVEFDAGn78rWKCTYgEVyrPR0HoFKw.webp',
            'icone' => 'fa-sailboat',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('types')->insert([
            'libelle' => 'Yacht',
            'slug' => 'yacht',
            'libelle_translations' => null,
            'photo' => 'types/nzz8LIPcBpBlmoi91l1evko1CjXzCi258FxwaBfa.webp',
            'icone' => 'fa-compass',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
