<?php

namespace Database\Seeders;

use App\Models\Equipement;
use Illuminate\Database\Seeder;

class EquipementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipements = [
            // Navigation
            ['libelle' => 'GPS Chartplotter', 'categorie' => 'navigation', 'icone' => 'fa-satellite-dish', 'ordre' => 1],
            ['libelle' => 'Pilote automatique', 'categorie' => 'navigation', 'icone' => 'fa-compass', 'ordre' => 2],
            ['libelle' => 'VHF', 'categorie' => 'navigation', 'icone' => 'fa-tower-broadcast', 'ordre' => 3],
            ['libelle' => 'Radar', 'categorie' => 'navigation', 'icone' => 'fa-radar', 'ordre' => 4],
            ['libelle' => 'AIS', 'categorie' => 'navigation', 'icone' => 'fa-signal', 'ordre' => 5],
            ['libelle' => 'Sondeur', 'categorie' => 'navigation', 'icone' => 'fa-water', 'ordre' => 6],
            ['libelle' => 'Anémomètre', 'categorie' => 'navigation', 'icone' => 'fa-wind', 'ordre' => 7],
            ['libelle' => 'Compas', 'categorie' => 'navigation', 'icone' => 'fa-compass', 'ordre' => 8],

            // Confort
            ['libelle' => 'Climatisation', 'categorie' => 'confort', 'icone' => 'fa-snowflake', 'ordre' => 1],
            ['libelle' => 'Chauffage', 'categorie' => 'confort', 'icone' => 'fa-fire', 'ordre' => 2],
            ['libelle' => 'Dessalinisateur', 'categorie' => 'confort', 'icone' => 'fa-droplet', 'ordre' => 3],
            ['libelle' => 'Groupe électrogène', 'categorie' => 'confort', 'icone' => 'fa-bolt', 'ordre' => 4],
            ['libelle' => 'Panneaux solaires', 'categorie' => 'confort', 'icone' => 'fa-solar-panel', 'ordre' => 5],
            ['libelle' => 'Éolienne', 'categorie' => 'confort', 'icone' => 'fa-fan', 'ordre' => 6],
            ['libelle' => 'Douche pont', 'categorie' => 'confort', 'icone' => 'fa-shower', 'ordre' => 7],
            ['libelle' => 'Bimini', 'categorie' => 'confort', 'icone' => 'fa-umbrella', 'ordre' => 8],
            ['libelle' => 'Taud de soleil', 'categorie' => 'confort', 'icone' => 'fa-sun', 'ordre' => 9],
            ['libelle' => 'Réfrigérateur', 'categorie' => 'confort', 'icone' => 'fa-temperature-low', 'ordre' => 10],
            ['libelle' => 'Congélateur', 'categorie' => 'confort', 'icone' => 'fa-temperature-arrow-down', 'ordre' => 11],

            // Sécurité
            ['libelle' => 'Radeau de survie', 'categorie' => 'securite', 'icone' => 'fa-life-ring', 'ordre' => 1],
            ['libelle' => 'Balise EPIRB', 'categorie' => 'securite', 'icone' => 'fa-satellite', 'ordre' => 2],
            ['libelle' => 'Extincteurs', 'categorie' => 'securite', 'icone' => 'fa-fire-extinguisher', 'ordre' => 3],
            ['libelle' => 'Gilets de sauvetage', 'categorie' => 'securite', 'icone' => 'fa-vest', 'ordre' => 4],
            ['libelle' => 'Harnais', 'categorie' => 'securite', 'icone' => 'fa-user-shield', 'ordre' => 5],
            ['libelle' => 'Ligne de vie', 'categorie' => 'securite', 'icone' => 'fa-link', 'ordre' => 6],
            ['libelle' => 'Fusées de détresse', 'categorie' => 'securite', 'icone' => 'fa-rocket', 'ordre' => 7],
            ['libelle' => 'Trousse de secours', 'categorie' => 'securite', 'icone' => 'fa-kit-medical', 'ordre' => 8],

            // Électronique
            ['libelle' => 'TV LED', 'categorie' => 'electronique', 'icone' => 'fa-tv', 'ordre' => 1],
            ['libelle' => 'Sono', 'categorie' => 'electronique', 'icone' => 'fa-music', 'ordre' => 2],
            ['libelle' => 'WiFi', 'categorie' => 'electronique', 'icone' => 'fa-wifi', 'ordre' => 3],
            ['libelle' => 'Prises USB', 'categorie' => 'electronique', 'icone' => 'fa-usb', 'ordre' => 4],
            ['libelle' => 'Convertisseur 220V', 'categorie' => 'electronique', 'icone' => 'fa-plug', 'ordre' => 5],
            ['libelle' => 'Batterie lithium', 'categorie' => 'electronique', 'icone' => 'fa-battery-full', 'ordre' => 6],

            // Manœuvre
            ['libelle' => 'Guindeau électrique', 'categorie' => 'manoeuvre', 'icone' => 'fa-anchor', 'ordre' => 1],
            ['libelle' => 'Propulseur d\'étrave', 'categorie' => 'manoeuvre', 'icone' => 'fa-fan', 'ordre' => 2],
            ['libelle' => 'Propulseur de poupe', 'categorie' => 'manoeuvre', 'icone' => 'fa-fan', 'ordre' => 3],
            ['libelle' => 'Winch électrique', 'categorie' => 'manoeuvre', 'icone' => 'fa-gear', 'ordre' => 4],
            ['libelle' => 'Enrouleur de génois', 'categorie' => 'manoeuvre', 'icone' => 'fa-rotate', 'ordre' => 5],
            ['libelle' => 'Enrouleur de grand-voile', 'categorie' => 'manoeuvre', 'icone' => 'fa-rotate', 'ordre' => 6],

            // Loisirs
            ['libelle' => 'Annexe', 'categorie' => 'loisirs', 'icone' => 'fa-ship', 'ordre' => 1],
            ['libelle' => 'Moteur hors-bord', 'categorie' => 'loisirs', 'icone' => 'fa-cog', 'ordre' => 2],
            ['libelle' => 'Paddle', 'categorie' => 'loisirs', 'icone' => 'fa-water', 'ordre' => 3],
            ['libelle' => 'Kayak', 'categorie' => 'loisirs', 'icone' => 'fa-water', 'ordre' => 4],
            ['libelle' => 'Matériel de plongée', 'categorie' => 'loisirs', 'icone' => 'fa-mask-snorkel', 'ordre' => 5],
            ['libelle' => 'Matériel de pêche', 'categorie' => 'loisirs', 'icone' => 'fa-fish', 'ordre' => 6],
        ];

        foreach ($equipements as $equipement) {
            Equipement::create($equipement);
        }
    }
}
