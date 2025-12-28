<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipementSeeder extends Seeder
{
    /**
     * Seed des équipements disponibles
     *
     * COMPORTEMENT INTELLIGENT :
     * - Ajoute les équipements manquants
     * - Met à jour les équipements existants (via libelle + catégorie)
     * - Préserve les équipements ajoutés manuellement en production
     * - Met à jour icône et ordre si modifiés dans le code
     * - Peut être exécuté à chaque déploiement sans risque
     */
    public function run(): void
    {
        $equipements = [
            // Navigation
            ['libelle' => 'GPS', 'categorie' => 'navigation', 'icone' => 'fa-location-dot', 'ordre' => 1],
            ['libelle' => 'Pilote automatique', 'categorie' => 'navigation', 'icone' => 'fa-route', 'ordre' => 2],
            ['libelle' => 'Compas', 'categorie' => 'navigation', 'icone' => 'fa-compass', 'ordre' => 3],
            ['libelle' => 'Anémomètre', 'categorie' => 'navigation', 'icone' => 'fa-wind', 'ordre' => 4],
            ['libelle' => 'Loch/Speedomètre', 'categorie' => 'navigation', 'icone' => 'fa-gauge', 'ordre' => 5],
            ['libelle' => 'Sondeur', 'categorie' => 'navigation', 'icone' => 'fa-water', 'ordre' => 6],

            // Confort
            ['libelle' => 'Climatisation', 'categorie' => 'confort', 'icone' => 'fa-snowflake', 'ordre' => 1],
            ['libelle' => 'Chauffage', 'categorie' => 'confort', 'icone' => 'fa-fire', 'ordre' => 2],
            ['libelle' => 'Congélateur', 'categorie' => 'confort', 'icone' => 'fa-ice-cream', 'ordre' => 3],
            ['libelle' => 'Réfrigérateur', 'categorie' => 'confort', 'icone' => 'fa-refrigerator', 'ordre' => 4],
            ['libelle' => 'Eau chaude', 'categorie' => 'confort', 'icone' => 'fa-faucet-drip', 'ordre' => 5],
            ['libelle' => 'Douche de pont', 'categorie' => 'confort', 'icone' => 'fa-shower', 'ordre' => 6],
            ['libelle' => 'Toilettes marines', 'categorie' => 'confort', 'icone' => 'fa-restroom', 'ordre' => 7],
            ['libelle' => 'Dessalinisateur', 'categorie' => 'confort', 'icone' => 'fa-droplet', 'ordre' => 8],
            ['libelle' => 'TV/Système audio', 'categorie' => 'confort', 'icone' => 'fa-tv', 'ordre' => 9],

            // Sécurité
            ['libelle' => 'Radeau de survie', 'categorie' => 'securite', 'icone' => 'fa-life-ring', 'ordre' => 1],
            ['libelle' => 'Gilets de sauvetage', 'categorie' => 'securite', 'icone' => 'fa-vest', 'ordre' => 2],
            ['libelle' => 'Extincteurs', 'categorie' => 'securite', 'icone' => 'fa-fire-extinguisher', 'ordre' => 3],
            ['libelle' => 'EPIRB (balise de détresse)', 'categorie' => 'securite', 'icone' => 'fa-tower-broadcast', 'ordre' => 4],
            ['libelle' => 'Fusées de détresse', 'categorie' => 'securite', 'icone' => 'fa-rocket', 'ordre' => 5],
            ['libelle' => 'Harnais et longes', 'categorie' => 'securite', 'icone' => 'fa-link', 'ordre' => 6],
            ['libelle' => 'Pompe de cale électrique', 'categorie' => 'securite', 'icone' => 'fa-pump', 'ordre' => 7],
            ['libelle' => 'Pompe de cale manuelle', 'categorie' => 'securite', 'icone' => 'fa-pump-medical', 'ordre' => 8],

            // Électronique
            ['libelle' => 'VHF', 'categorie' => 'electronique', 'icone' => 'fa-radio', 'ordre' => 1],
            ['libelle' => 'AIS (émetteur/récepteur)', 'categorie' => 'electronique', 'icone' => 'fa-satellite-dish', 'ordre' => 2],
            ['libelle' => 'Radar', 'categorie' => 'electronique', 'icone' => 'fa-radar', 'ordre' => 3],
            ['libelle' => 'Traceur GPS', 'categorie' => 'electronique', 'icone' => 'fa-map-location-dot', 'ordre' => 4],
            ['libelle' => 'Panneau solaire', 'categorie' => 'electronique', 'icone' => 'fa-solar-panel', 'ordre' => 5],
            ['libelle' => 'Éolienne', 'categorie' => 'electronique', 'icone' => 'fa-fan', 'ordre' => 6],
            ['libelle' => 'Groupe électrogène', 'categorie' => 'electronique', 'icone' => 'fa-plug', 'ordre' => 7],
            ['libelle' => 'Convertisseur 12V/220V', 'categorie' => 'electronique', 'icone' => 'fa-bolt', 'ordre' => 8],
            ['libelle' => 'Chargeur de batterie', 'categorie' => 'electronique', 'icone' => 'fa-car-battery', 'ordre' => 9],

            // Manœuvre
            ['libelle' => 'Guindeau électrique', 'categorie' => 'manoeuvre', 'icone' => 'fa-anchor', 'ordre' => 1],
            ['libelle' => 'Winch électrique', 'categorie' => 'manoeuvre', 'icone' => 'fa-gears', 'ordre' => 2],
            ['libelle' => 'Propulseur d\'étrave', 'categorie' => 'manoeuvre', 'icone' => 'fa-jet-fighter', 'ordre' => 3],
            ['libelle' => 'Propulseur de poupe', 'categorie' => 'manoeuvre', 'icone' => 'fa-jet-fighter', 'ordre' => 4],
            ['libelle' => 'Enrouleur de génois', 'categorie' => 'manoeuvre', 'icone' => 'fa-circle-notch', 'ordre' => 5],
            ['libelle' => 'Lazy bag', 'categorie' => 'manoeuvre', 'icone' => 'fa-bag-shopping', 'ordre' => 6],
            ['libelle' => 'Bôme', 'categorie' => 'manoeuvre', 'icone' => 'fa-minus', 'ordre' => 7],
            ['libelle' => 'Tangon de spi', 'categorie' => 'manoeuvre', 'icone' => 'fa-arrows-left-right', 'ordre' => 8],

            // Loisirs
            ['libelle' => 'Annexe', 'categorie' => 'loisirs', 'icone' => 'fa-person-swimming', 'ordre' => 1],
            ['libelle' => 'Moteur hors-bord', 'categorie' => 'loisirs', 'icone' => 'fa-propeller', 'ordre' => 2],
            ['libelle' => 'Paddle/SUP', 'categorie' => 'loisirs', 'icone' => 'fa-person-walking', 'ordre' => 3],
            ['libelle' => 'Matériel de plongée', 'categorie' => 'loisirs', 'icone' => 'fa-person-swimming', 'ordre' => 4],
            ['libelle' => 'Matériel de pêche', 'categorie' => 'loisirs', 'icone' => 'fa-fish', 'ordre' => 5],
            ['libelle' => 'Kayak', 'categorie' => 'loisirs', 'icone' => 'fa-kayaking', 'ordre' => 6],
            ['libelle' => 'Équipement de snorkeling', 'categorie' => 'loisirs', 'icone' => 'fa-mask-snorkel', 'ordre' => 7],
            ['libelle' => 'Barbecue', 'categorie' => 'loisirs', 'icone' => 'fa-fire-burner', 'ordre' => 8],
            ['libelle' => 'Bimini/Taud de soleil', 'categorie' => 'loisirs', 'icone' => 'fa-umbrella-beach', 'ordre' => 9],
            ['libelle' => 'Taud de mouillage', 'categorie' => 'loisirs', 'icone' => 'fa-tarp', 'ordre' => 10],
        ];

        foreach ($equipements as $equipement) {
            \App\Models\Equipement::updateOrCreate(
                [
                    'libelle' => $equipement['libelle'],
                    'categorie' => $equipement['categorie']
                ],
                [
                    'icone' => $equipement['icone'],
                    'ordre' => $equipement['ordre']
                ]
            );
        }
    }
}
