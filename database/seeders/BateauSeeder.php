<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BateauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bateaux = [
            [
                'visible' => true,
                'zone_id' => 1, // La Réunion - Saint-Denis
                'type_id' => 1, // Catamaran
                'modele' => 'Lagoon 450',
                'slug' => Str::slug('Lagoon 450 Catamaran Saint-Denis ' . uniqid()),
                'occasion' => true,
                'prix' => 385000.00,
                'afficher_prix' => true,
                'description' => 'Magnifique catamaran Lagoon 450 de 2018 en excellent état. Idéal pour la navigation dans l\'océan Indien. Équipement complet pour la croisière hauturière.',
                'symboles' => '⚓🌊☀️',
                'mots' => 'catamaran,luxe,croisière,océan indien',
                'slogan_id' => 1, // Prix en baisse !
                'chantier' => 'Lagoon',
                'architecte' => 'VPLP',
                'pavillon' => 'Français',
                'annee' => 2018,
                'materiaux' => 'Polyester',
                'longueurht' => 13.96,
                'largeur' => 7.84,
                'tirantdeau' => 1.30,
                'poidslegeencharges' => 13800.00,
                'surfaceaupres' => 105.00,
                'heuresmoteur' => 450,
                'puissance' => 110,
                'moteur' => 'Yanmar 2x55cv',
                'systemeantiderive' => 'Dérives sabres',
                'cabines' => 4,
                'passagers' => 10,
            ],
            [
                'visible' => true,
                'zone_id' => 5, // Maurice - Port-Louis
                'type_id' => 2, // Voilier monocoque
                'modele' => 'Beneteau Oceanis 46.1',
                'slug' => Str::slug('Beneteau Oceanis 46.1 Port-Louis ' . uniqid()),
                'occasion' => false,
                'prix' => 295000.00,
                'afficher_prix' => true,
                'description' => 'Voilier neuf Beneteau Oceanis 46.1, design moderne et performances exceptionnelles. Parfait pour naviguer entre Maurice et les îles voisines.',
                'symboles' => '⛵🏝️',
                'mots' => 'voilier,neuf,performance,beneteau',
                'slogan_id' => 2, // Nouveau sur le marché
                'chantier' => 'Beneteau',
                'architecte' => 'Berret-Racoupeau',
                'pavillon' => 'Maurice',
                'annee' => 2024,
                'materiaux' => 'GRP sandwich',
                'longueurht' => 14.60,
                'largeur' => 4.50,
                'tirantdeau' => 2.30,
                'poidslegeencharges' => 10800.00,
                'surfaceaupres' => 106.00,
                'heuresmoteur' => 0,
                'puissance' => 80,
                'moteur' => 'Yanmar 80cv',
                'systemeantiderive' => 'Quille fixe',
                'cabines' => 3,
                'passagers' => 8,
            ],
            [
                'visible' => true,
                'zone_id' => 8, // Madagascar - Nosy Be
                'type_id' => 3, // Bateau à moteur
                'modele' => 'Jeanneau Cap Camarat 9.0',
                'slug' => Str::slug('Jeanneau Cap Camarat 9.0 Nosy Be ' . uniqid()),
                'occasion' => true,
                'prix' => 125000.00,
                'afficher_prix' => true,
                'description' => 'Bateau à moteur idéal pour la pêche au gros et les excursions. Très bien entretenu, visible à Nosy Be.',
                'symboles' => '🎣🚤',
                'mots' => 'bateau moteur,pêche,excursion,madagascar',
                'slogan_id' => 7, // État exceptionnel
                'chantier' => 'Jeanneau',
                'architecte' => 'Jeanneau Design',
                'pavillon' => 'Malgache',
                'annee' => 2019,
                'materiaux' => 'Polyester',
                'longueurht' => 8.99,
                'largeur' => 2.99,
                'tirantdeau' => 0.65,
                'poidslegeencharges' => 3200.00,
                'surfaceaupres' => null,
                'heuresmoteur' => 680,
                'puissance' => 300,
                'moteur' => 'Suzuki 2x150cv',
                'systemeantiderive' => null,
                'cabines' => 1,
                'passagers' => 8,
            ],
            [
                'visible' => true,
                'zone_id' => 3, // La Réunion - Saint-Paul
                'type_id' => 4, // Semi-rigide
                'modele' => 'Zodiac Pro 7.50',
                'slug' => Str::slug('Zodiac Pro 7.50 Saint-Paul ' . uniqid()),
                'occasion' => true,
                'prix' => 45000.00,
                'afficher_prix' => true,
                'description' => 'Semi-rigide performant pour sorties à la journée, plongée et excursions. Moteur récent, excellent état général.',
                'symboles' => '🤿🌊',
                'mots' => 'semi-rigide,plongée,excursion,zodiac',
                'slogan_id' => 9, // Prêt à naviguer
                'chantier' => 'Zodiac',
                'architecte' => null,
                'pavillon' => 'Français',
                'annee' => 2020,
                'materiaux' => 'PVC Hypalon',
                'longueurht' => 7.50,
                'largeur' => 2.80,
                'tirantdeau' => 0.40,
                'poidslegeencharges' => 1200.00,
                'surfaceaupres' => null,
                'heuresmoteur' => 320,
                'puissance' => 250,
                'moteur' => 'Yamaha 250cv',
                'systemeantiderive' => null,
                'cabines' => 0,
                'passagers' => 12,
            ],
            [
                'visible' => true,
                'zone_id' => 6, // Maurice - Grand Baie
                'type_id' => 5, // Yacht
                'modele' => 'Princess V58',
                'slug' => Str::slug('Princess V58 Yacht Grand Baie ' . uniqid()),
                'occasion' => true,
                'prix' => 650000.00,
                'afficher_prix' => false,
                'description' => 'Yacht de prestige Princess V58, équipement haut de gamme, climatisation, génératrice, système audio premium. Luxe et performance réunis.',
                'symboles' => '🛥️💎✨',
                'mots' => 'yacht,luxe,prestige,princess',
                'slogan_id' => 4, // Exclusivité
                'chantier' => 'Princess Yachts',
                'architecte' => 'Bernard Olesinski',
                'pavillon' => 'Maurice',
                'annee' => 2016,
                'materiaux' => 'GRP',
                'longueurht' => 17.98,
                'largeur' => 4.78,
                'tirantdeau' => 1.42,
                'poidslegeencharges' => 28500.00,
                'surfaceaupres' => null,
                'heuresmoteur' => 850,
                'puissance' => 1600,
                'moteur' => 'MAN V12 2x800cv',
                'systemeantiderive' => null,
                'cabines' => 3,
                'passagers' => 6,
            ],
            [
                'visible' => true,
                'zone_id' => 4, // La Réunion - Saint-Gilles
                'type_id' => 1, // Catamaran
                'modele' => 'Fountaine Pajot Lucia 40',
                'slug' => Str::slug('Fountaine Pajot Lucia 40 Saint-Gilles ' . uniqid()),
                'occasion' => true,
                'prix' => 310000.00,
                'afficher_prix' => true,
                'description' => 'Catamaran Fountaine Pajot Lucia 40 en très bon état. Confort et espace, parfait pour vivre à bord ou la location saisonnière.',
                'symboles' => '⚓🏖️',
                'mots' => 'catamaran,fountaine pajot,confort,location',
                'slogan_id' => 3, // Affaire à saisir
                'chantier' => 'Fountaine Pajot',
                'architecte' => 'Berret-Racoupeau',
                'pavillon' => 'Français',
                'annee' => 2017,
                'materiaux' => 'Composite infusion',
                'longueurht' => 11.73,
                'largeur' => 6.63,
                'tirantdeau' => 1.15,
                'poidslegeencharges' => 11200.00,
                'surfaceaupres' => 83.00,
                'heuresmoteur' => 520,
                'puissance' => 90,
                'moteur' => 'Volvo 2x45cv',
                'systemeantiderive' => 'Dérives pivotantes',
                'cabines' => 3,
                'passagers' => 8,
            ],
            [
                'visible' => true,
                'zone_id' => 8, // Madagascar - Nosy Be
                'type_id' => 12, // Bateau de pêche
                'modele' => 'Pêche hauturière traditionnelle',
                'slug' => Str::slug('Bateau peche traditionnelle Nosy Be ' . uniqid()),
                'occasion' => true,
                'prix' => 28000.00,
                'afficher_prix' => true,
                'description' => 'Bateau de pêche traditionnel malgache, robuste et fiable. Idéal pour la pêche professionnelle ou semi-professionnelle.',
                'symboles' => '🎣🐟',
                'mots' => 'pêche,traditionnel,robuste,madagascar',
                'slogan_id' => 10, // Idéal première acquisition
                'chantier' => 'Artisanal',
                'architecte' => null,
                'pavillon' => 'Malgache',
                'annee' => 2015,
                'materiaux' => 'Bois',
                'longueurht' => 9.50,
                'largeur' => 3.20,
                'tirantdeau' => 0.80,
                'poidslegeencharges' => 4500.00,
                'surfaceaupres' => null,
                'heuresmoteur' => 1250,
                'puissance' => 120,
                'moteur' => 'Diesel Yanmar 120cv',
                'systemeantiderive' => null,
                'cabines' => 0,
                'passagers' => 6,
            ],
            [
                'visible' => true,
                'zone_id' => 2, // La Réunion - Saint-Pierre
                'type_id' => 13, // Voilier habitable
                'modele' => 'Bavaria 37 Cruiser',
                'slug' => Str::slug('Bavaria 37 Cruiser Saint-Pierre ' . uniqid()),
                'occasion' => true,
                'prix' => 89000.00,
                'afficher_prix' => true,
                'description' => 'Bavaria 37 en bon état général, bien équipé pour la croisière côtière. Idéal pour découvrir la navigation à voile dans l\'océan Indien.',
                'symboles' => '⛵🌅',
                'mots' => 'voilier,bavaria,croisière,réunion',
                'slogan_id' => 8, // Grand entretien récent
                'chantier' => 'Bavaria',
                'architecte' => 'Farr Yacht Design',
                'pavillon' => 'Français',
                'annee' => 2010,
                'materiaux' => 'Polyester',
                'longueurht' => 11.35,
                'largeur' => 3.91,
                'tirantdeau' => 1.90,
                'poidslegeencharges' => 6900.00,
                'surfaceaupres' => 67.00,
                'heuresmoteur' => 890,
                'puissance' => 29,
                'moteur' => 'Volvo 29cv',
                'systemeantiderive' => 'Quille aileron',
                'cabines' => 3,
                'passagers' => 7,
            ],
        ];

        foreach ($bateaux as $bateau) {
            DB::table('bateaux')->insert(array_merge($bateau, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
