<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipementSeeder extends Seeder
{
    public function run(): void
    {
        $equipements = [
            // Navigation
            ['libelle' => 'GPS', 'categorie' => 'Navigation', 'ordre' => 1],
            ['libelle' => 'Pilote automatique', 'categorie' => 'Navigation', 'ordre' => 2],
            ['libelle' => 'Compas', 'categorie' => 'Navigation', 'ordre' => 3],
            ['libelle' => 'Anémomètre', 'categorie' => 'Navigation', 'ordre' => 4],
            ['libelle' => 'Loch/Speedomètre', 'categorie' => 'Navigation', 'ordre' => 5],
            ['libelle' => 'Sondeur', 'categorie' => 'Navigation', 'ordre' => 6],

            // Confort
            ['libelle' => 'Climatisation', 'categorie' => 'Confort', 'ordre' => 1],
            ['libelle' => 'Chauffage', 'categorie' => 'Confort', 'ordre' => 2],
            ['libelle' => 'Congélateur', 'categorie' => 'Confort', 'ordre' => 3],
            ['libelle' => 'Réfrigérateur', 'categorie' => 'Confort', 'ordre' => 4],
            ['libelle' => 'Eau chaude', 'categorie' => 'Confort', 'ordre' => 5],
            ['libelle' => 'Douche de pont', 'categorie' => 'Confort', 'ordre' => 6],
            ['libelle' => 'Toilettes marines', 'categorie' => 'Confort', 'ordre' => 7],
            ['libelle' => 'Dessalinisateur', 'categorie' => 'Confort', 'ordre' => 8],
            ['libelle' => 'TV/Système audio', 'categorie' => 'Confort', 'ordre' => 9],

            // Sécurité
            ['libelle' => 'Radeau de survie', 'categorie' => 'Sécurité', 'ordre' => 1],
            ['libelle' => 'Gilets de sauvetage', 'categorie' => 'Sécurité', 'ordre' => 2],
            ['libelle' => 'Extincteurs', 'categorie' => 'Sécurité', 'ordre' => 3],
            ['libelle' => 'EPIRB (balise de détresse)', 'categorie' => 'Sécurité', 'ordre' => 4],
            ['libelle' => 'Fusées de détresse', 'categorie' => 'Sécurité', 'ordre' => 5],
            ['libelle' => 'Harnais et longes', 'categorie' => 'Sécurité', 'ordre' => 6],
            ['libelle' => 'Pompe de cale électrique', 'categorie' => 'Sécurité', 'ordre' => 7],
            ['libelle' => 'Pompe de cale manuelle', 'categorie' => 'Sécurité', 'ordre' => 8],

            // Électronique
            ['libelle' => 'VHF', 'categorie' => 'Électronique', 'ordre' => 1],
            ['libelle' => 'AIS (émetteur/récepteur)', 'categorie' => 'Électronique', 'ordre' => 2],
            ['libelle' => 'Radar', 'categorie' => 'Électronique', 'ordre' => 3],
            ['libelle' => 'Traceur GPS', 'categorie' => 'Électronique', 'ordre' => 4],
            ['libelle' => 'Panneau solaire', 'categorie' => 'Électronique', 'ordre' => 5],
            ['libelle' => 'Éolienne', 'categorie' => 'Électronique', 'ordre' => 6],
            ['libelle' => 'Groupe électrogène', 'categorie' => 'Électronique', 'ordre' => 7],
            ['libelle' => 'Convertisseur 12V/220V', 'categorie' => 'Électronique', 'ordre' => 8],
            ['libelle' => 'Chargeur de batterie', 'categorie' => 'Électronique', 'ordre' => 9],

            // Manœuvre
            ['libelle' => 'Guindeau électrique', 'categorie' => 'Manœuvre', 'ordre' => 1],
            ['libelle' => 'Winch électrique', 'categorie' => 'Manœuvre', 'ordre' => 2],
            ['libelle' => 'Propulseur d\'étrave', 'categorie' => 'Manœuvre', 'ordre' => 3],
            ['libelle' => 'Propulseur de poupe', 'categorie' => 'Manœuvre', 'ordre' => 4],
            ['libelle' => 'Enrouleur de génois', 'categorie' => 'Manœuvre', 'ordre' => 5],
            ['libelle' => 'Lazy bag', 'categorie' => 'Manœuvre', 'ordre' => 6],
            ['libelle' => 'Bôme', 'categorie' => 'Manœuvre', 'ordre' => 7],
            ['libelle' => 'Tangon de spi', 'categorie' => 'Manœuvre', 'ordre' => 8],

            // Loisirs
            ['libelle' => 'Annexe', 'categorie' => 'Loisirs', 'ordre' => 1],
            ['libelle' => 'Moteur hors-bord', 'categorie' => 'Loisirs', 'ordre' => 2],
            ['libelle' => 'Paddle/SUP', 'categorie' => 'Loisirs', 'ordre' => 3],
            ['libelle' => 'Matériel de plongée', 'categorie' => 'Loisirs', 'ordre' => 4],
            ['libelle' => 'Matériel de pêche', 'categorie' => 'Loisirs', 'ordre' => 5],
            ['libelle' => 'Kayak', 'categorie' => 'Loisirs', 'ordre' => 6],
            ['libelle' => 'Équipement de snorkeling', 'categorie' => 'Loisirs', 'ordre' => 7],
            ['libelle' => 'Barbecue', 'categorie' => 'Loisirs', 'ordre' => 8],
            ['libelle' => 'Bimini/Taud de soleil', 'categorie' => 'Loisirs', 'ordre' => 9],
            ['libelle' => 'Taud de mouillage', 'categorie' => 'Loisirs', 'ordre' => 10],
        ];

        foreach ($equipements as $equipement) {
            \App\Models\Equipement::updateOrCreate(
                [
                    'libelle' => $equipement['libelle'],
                    'categorie' => $equipement['categorie']
                ],
                ['ordre' => $equipement['ordre']]
            );
        }
    }
}
