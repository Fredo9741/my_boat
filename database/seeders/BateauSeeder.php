<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bateau;
use App\Models\Type;
use App\Models\Zone;
use App\Models\Action;

class BateauSeeder extends Seeder
{
    private function createOrUpdateBateau(array $data): void
    {
        $slug = $data['slug'];
        Bateau::updateOrCreate(['slug' => $slug], $data);
    }

    public function run(): void
    {
        $this->createOrUpdateBateau([
            'visible' => true,
            'occasion' => false,
            'type_id' => Type::where('slug', 'vedette')->first()->id,
            'zone_id' => Zone::where('slug', 'madagascar')->first()->id,
            'slogan_id' => null,
            'modele' => 'Vedette Pro',
            'slug' => 'vedette-pro-6942b79c20160',
            'prix' => 225000.00,
            'afficher_prix' => true,
            'description' => 'À VENDRE — Bateau de charge / transport / remorquage / bord-à-bord
Unité professionnelle robuste, refondue en 2024, opérationnelle immédiatement -
Caractéristiques générales :
Construction : 1992
Chantier : Guy Couach
Coque : Polyester
Refonte complète : 2024
Pavillon : Madagascar
Équipage idéal : 2 -
Sellerie Beneteau -
Capacités :
Gasoil : 1 300 L
Eau douce : 400 L -
Propulsion :
2 moteurs IVECO 450 ch (8210) – SRM35 – Keel Cooling
Inverseurs Twin-Disc avec Trawling Valves
Vitesse max : 18 nds
Vitesse éco : 10 nds (35 L/h) -
Énergie :
2 alternateurs 80 A
4 batteries 200 Ah
Panneau solaire 450 W
1 batterie gel 200 Ah
Convertisseur 220 V / 2000 W -
Navigation et électronique
GPS / Sondeur Garmin 
Cartographie 
VHF -
Points forts : 
Parfait pour transport de charge, remorquage, missions portuaires ou bord-à-bord
Entretien et refonte réalisés en 2024
Fiable, économique à l’usage et immédiatement exploitable
Idéal pour opérateur maritime recherchant un navire polyvalent et solide. 
Infos: Quentin Whats ap +261 32 19 76 308',
            'symboles' => null,
            'mots' => null,
            'chantier' => 'Guy Couach',
            'architecte' => null,
            'pavillon' => 'Malgache',
            'annee' => 1992,
            'materiaux' => 'Polyester',
            'longueurht' => 15.50,
            'largeur' => 4.60,
            'tirantdeau' => 1.30,
            'poidslegeencharges' => 20000.00,
            'surfaceaupres' => null,
            'heuresmoteur' => 8000,
            'puissance' => null,
            'moteur' => null,
            'systemeantiderive' => null,
            'cabines' => null,
            'passagers' => null,
        ]);

        $this->createOrUpdateBateau([
            'visible' => true,
            'occasion' => true,
            'type_id' => Type::where('slug', 'catamaran-a-voile')->first()->id,
            'zone_id' => Zone::where('slug', 'madagascar')->first()->id,
            'slogan_id' => Action::where('slug', 'vendu')->first()->id,
            'modele' => 'Lagoon 410 S2',
            'slug' => 'lagoon-410-s2-6942ba2e80650',
            'prix' => 150000.00,
            'afficher_prix' => true,
            'description' => 'Catamaran Lagoon 410 S2 version propriétaire de 2003, sous pavillon français immatriculé à Mayotte (passeport malgache), de 12.37 mètres, avec une belle habitabilité, comprenant un carré spacieux et cuisine, 3 cabines et 2 salles de bain dont une propriétaire. Cette unité nécessite des travaux de remise en état (listés dans l’inventaire). Unité idéale pour du charter de croisière, ou pour navigations personnelles, prix sacrifié pour vente rapide. Contact et infos : Quentin +262 6 93 13 45 87',
            'symboles' => null,
            'mots' => null,
            'chantier' => 'Lagoon',
            'architecte' => 'VPLP Design = Marc Van Peteghem / Vincent Lauriot Prévost',
            'pavillon' => 'Français',
            'annee' => 2003,
            'materiaux' => 'Polyester',
            'longueurht' => 12.37,
            'largeur' => 7.00,
            'tirantdeau' => 1.20,
            'poidslegeencharges' => 7240.00,
            'surfaceaupres' => 94.00,
            'heuresmoteur' => 1400,
            'puissance' => 60,
            'moteur' => 'Volvo Penta',
            'systemeantiderive' => null,
            'cabines' => 3,
            'passagers' => 10,
        ]);

        $this->createOrUpdateBateau([
            'visible' => true,
            'occasion' => true,
            'type_id' => Type::where('slug', 'bateau-moteur')->first()->id,
            'zone_id' => Zone::where('slug', 'madagascar')->first()->id,
            'slogan_id' => Action::where('slug', 'affaire-a-saisir')->first()->id,
            'modele' => 'Cap Camarat',
            'slug' => 'cap-camarat-6942bd473a0c4',
            'prix' => 48000.00,
            'afficher_prix' => true,
            'description' => 'Bateau Jeanneau Cap Camarat 5m75 à vendre, équipé d’un Suzuki 140 CV 4 temps de 15heures, garantie 1 an ou 500 heures, en rodage. Longueur 5,75 m, largeur 1,90 m, flaps arrières portant la longueur totale à 6,05 m. Coque polyester repeinte intérieur/extérieur avec peinture polyuréthane et antifouling blanc. Direction hydraulique Ultraflex, commande à distance complète, batterie 100 Ah neuve avec bac, réservoir d’essence aluminium 160 L, compte-tours, faisceau et installation moteur professionnels. Le bateau dispose d’un poste de pilotage avec glacière 60 L, banquette arrière blanche et turquoise, deux coffres-bancs refaits, pompe de cale automatique, feux de navigation, coupe-circuit, GPS Garmin 9 pouces avec sonde et carte. Hard Top polyester blanc et bleu 1,90 × 1,30 m, structure inox Ø32 et Ø25, pare-brise 8 mm, quatre portes-cannes, prises USB et interrupteurs intégrés, coussins blancs et passe poils turquoise, mât de ski nautique inox. Mouillage complet avec ancre 8 kg, 12 m de chaîne Ø10, 15 m de corde Ø12. Ensemble en excellent état, prêt à naviguer immédiatement. Prix 48 000 euros. Contact Quentin WhatsApp +261 32 79 16 308.',
            'symboles' => null,
            'mots' => null,
            'chantier' => 'Jeanneau',
            'architecte' => 'Jeanneau',
            'pavillon' => 'Malgache',
            'annee' => 2008,
            'materiaux' => 'Polyester',
            'longueurht' => 5.75,
            'largeur' => 1.90,
            'tirantdeau' => 0.50,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => 15,
            'puissance' => 140,
            'moteur' => 'Suzuki DF140',
            'systemeantiderive' => null,
            'cabines' => null,
            'passagers' => null,
        ]);

        $this->createOrUpdateBateau([
            'visible' => true,
            'occasion' => false,
            'type_id' => Type::where('slug', 'bateau-moteur')->first()->id,
            'zone_id' => Zone::where('slug', 'mayotte')->first()->id,
            'slogan_id' => Action::where('slug', 'pret-a-naviguer')->first()->id,
            'modele' => 'Ultra Mar Shaft 7M30',
            'slug' => 'ultra-mar-shaft-7m30-6942c6d08f324',
            'prix' => 17000.00,
            'afficher_prix' => true,
            'description' => 'Ultra Mar Shaft 7,30 m (1991) – 2 moteurs Yamaha 115 CV
Bateau insubmersible, fiable et parfaitement entretenu. Dernière révision effectuée en septembre par un professionnel.
Idéal pour la pêche, les sorties en mer ou les balades côtières. Prêt à naviguer immédiatement.
Caractéristiques principales :
Longueur : 7,30 m
Largeur : 2,40 m
Poids : environ 2 300 kg (compris moteurs et pleins faits)
Motorisation : 2 moteurs Yamaha 115 CV essence (révisés) d\'environ 4000H
Réservoir carburant : 250 L
Réservoir d’eau douce : 100 L avec douche de pont
Coque polyester insubmersible à double coque
Catégorie : C (côtier)
Capacité : 6 à 8 personnes
Vitesse de croisière : 22–25 nœuds
Vitesse max : jusqu’à 40 nœuds

Équipements :
GPS / sondeur
VHF fixe
Taud de soleil
Douche de pont (100 L)
Échelle de bain
Gilets de sauvetage

Bateau sain, stable et sécurisant, entretenu par un professionnel.
Visible à Dzaoudzi – essai possible sur rendez-vous.
Ajustement de prix en novembre 2025 pour vente rapide',
            'symboles' => null,
            'mots' => null,
            'chantier' => 'Ultra marine',
            'architecte' => null,
            'pavillon' => 'Français',
            'annee' => 1991,
            'materiaux' => 'Polyester',
            'longueurht' => 7.30,
            'largeur' => 2.40,
            'tirantdeau' => 0.50,
            'poidslegeencharges' => 2300.00,
            'surfaceaupres' => null,
            'heuresmoteur' => 4000,
            'puissance' => 300,
            'moteur' => 'Yamaha h.b',
            'systemeantiderive' => null,
            'cabines' => null,
            'passagers' => null,
        ]);

        $this->createOrUpdateBateau([
            'visible' => true,
            'occasion' => true,
            'type_id' => Type::where('slug', 'voilier-monocoque')->first()->id,
            'zone_id' => Zone::where('slug', 'madagascar')->first()->id,
            'slogan_id' => Action::where('slug', 'prix-en-baisse')->first()->id,
            'modele' => 'Galapagos 43',
            'slug' => 'galapagos-43-694427f791cd0',
            'prix' => 550000.00,
            'afficher_prix' => true,
            'description' => 'À vendre – Voilier Galapagos 43 Ketch acier

Les mots du propriétaire : \\\"Après plus de 25 000 milles parcourus autour du monde en famille, notre fidèle compagnon \\\"E Pur Si Muove\\\" cherche un nouveau capitaine. Ce ketch en acier, robuste et marin, est prêt à repartir pour de nouvelles aventures.\\\"

Modèle : Galapagos 43 (avec jupe inox rallongée)

Année : 1977 – Pavillon français

Coque : Acier à bouchains, quille fixe

Dimensions : 13,67 m x 4 m – Tirant d’eau : 2,30 m

Localisation actuelle : La Réunion

Livrable à Mayotte ou Madagascar si besoin (traversée possible avec le futur acquéreur)


Voilier prêt à naviguer - équipé tour du monde – Inventaire complet sur demande


Contactez-nous pour plus d’infos ou pour planifier une visite.',
            'symboles' => null,
            'mots' => null,
            'chantier' => 'Vaille & Le Nuff',
            'architecte' => null,
            'pavillon' => 'Français',
            'annee' => 1977,
            'materiaux' => 'Acier',
            'longueurht' => 13.67,
            'largeur' => 4.00,
            'tirantdeau' => 2.30,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => 1700,
            'puissance' => 55,
            'moteur' => 'Sole Mini 55 - Base Mitsubishi',
            'systemeantiderive' => 'Quille Fixe',
            'cabines' => null,
            'passagers' => null,
        ]);

        $this->createOrUpdateBateau([
            'visible' => true,
            'occasion' => false,
            'type_id' => Type::where('slug', 'catamaran-a-voile')->first()->id,
            'zone_id' => Zone::where('slug', 'madagascar')->first()->id,
            'slogan_id' => Action::where('slug', 'coup-de-coeur')->first()->id,
            'modele' => 'Leopard 38',
            'slug' => 'leopard-38-694428fb10bc7',
            'prix' => 148500.00,
            'afficher_prix' => true,
            'description' => 'Disponible chez Myboat Océan Indien : Catamaran Leopard 384 de 2010, chantier Roberston and Caine sous pavillon français, (tva française non réglée)  à usage personnel, taxe seychelloise payée, équipé de 4 cabines, 2 salles de bains. Ce bateau est en bon état, bien entretenu par ses propriétaires depuis bientôt 10 années. Unité idéale pour navigations en croisière, équipée navigation hauturière. Haubans et batteries gel changés en 2025.  Inventaire complet disponible sur demande. VIDEO , VISIO également. Ajustement de prix novembre 2025, visible actuellement au sec à Nosy be Madagascar, à saisir! Renseignements : Quentin whats ap +261 32 79 16 308
Available at Myboat Indian Ocean: 2010 Leopard 384 Catamaran, built by Robertson and Caine, under French flag (French VAT not paid), for personal use, Seychellois tax paid. Equipped with 4 cabins and 2 bathrooms.
This boat is in good condition, well maintained by its owners for nearly 10 years. An ideal unit for cruising, equipped for offshore navigation. Shrouds and gel batteries replaced in 2025. Full inventory available on request. VIDEO and VISIO available as well.
Price adjustment November 2025. Currently visible on dry at Nosy Be, Madagascar — a great opportunity!

Contact: Quentin WhatsApp +261 32 79 16 308',
            'symboles' => null,
            'mots' => null,
            'chantier' => 'ROBERTSON AND CAINE',
            'architecte' => 'SIMONIS VOOGD DESIGN',
            'pavillon' => 'Français',
            'annee' => 2010,
            'materiaux' => 'Polyester',
            'longueurht' => 11.58,
            'largeur' => 6.04,
            'tirantdeau' => 1.05,
            'poidslegeencharges' => 8300.00,
            'surfaceaupres' => 92.00,
            'heuresmoteur' => 2000,
            'puissance' => 30,
            'moteur' => 'YANMAR  3YM30',
            'systemeantiderive' => null,
            'cabines' => 4,
            'passagers' => 8,
        ]);

        $this->createOrUpdateBateau([
            'visible' => true,
            'occasion' => true,
            'type_id' => Type::where('slug', 'voilier-monocoque')->first()->id,
            'zone_id' => Zone::where('slug', 'madagascar')->first()->id,
            'slogan_id' => null,
            'modele' => 'Sun Odyssey 39 i',
            'slug' => 'sun-odyssey-39-i-694429f94f1a2',
            'prix' => 90000.00,
            'afficher_prix' => true,
            'description' => 'À vendre : Jeanneau Sun Odyssey 39i – 2008 (mis à l’eau en 2009) 
Sous pavillon tanzanien, ce voilier de 11,62 m x 3,88 m avec tirant d’eau de 2,00 m est en parfait état et prêt à naviguer.
Il offre 3 cabines, 8 couchages et 2 salles de bain, un moteur Yanmar 40 CV, ainsi qu’un équipement complet : électronique Raymarine, panneaux solaires, cockpit spacieux en teck, grand-voile sur lazy bag et génois sur enrouleur.
Entretien irréprochable : sellerie et bimini refaits en 2023, batteries neuves en 2022. Sécurité hauturière complète avec radeau de survie 8 personnes. Annexe incluse.
 Opportunité rare pour navigateurs exigeants recherchant confort, performance et fiabilité. Disponible immédiatement.

For Sale: Jeanneau Sun Odyssey 39i – 2008 (launched 2009) 
Flying the Tanzanian flag, this 11.62 m x 3.88 m sailing yacht with 2.00 m draft is in perfect condition and ready to sail.
It features 3 cabins, 8 berths and 2 bathrooms, a Yanmar 40 HP engine, and full equipment: Raymarine electronics, solar panels, spacious teak cockpit, mainsail with lazy bag and furling genoa.
Meticulously maintained: upholstery and bimini renewed in 2023, new batteries in 2022. Offshore safety equipment with 8-person liferaft. Tender included.
 A rare opportunity for demanding sailors seeking comfort, performance and reliability. Available immediately.

Quentin Whats ap +261 32 79 16 308',
            'symboles' => null,
            'mots' => null,
            'chantier' => 'Jeanneau',
            'architecte' => null,
            'pavillon' => 'Tanzanien',
            'annee' => 2008,
            'materiaux' => 'Polyester',
            'longueurht' => 11.62,
            'largeur' => 3.88,
            'tirantdeau' => 2.00,
            'poidslegeencharges' => 7330.00,
            'surfaceaupres' => null,
            'heuresmoteur' => null,
            'puissance' => null,
            'moteur' => 'Yanmar',
            'systemeantiderive' => null,
            'cabines' => 3,
            'passagers' => 8,
        ]);

        $this->createOrUpdateBateau([
            'visible' => true,
            'occasion' => true,
            'type_id' => Type::where('slug', 'catamaran-a-voile')->first()->id,
            'zone_id' => Zone::where('slug', 'madagascar')->first()->id,
            'slogan_id' => Action::where('slug', 'ideal-premiere-acquisition')->first()->id,
            'modele' => 'Tiki 26',
            'slug' => 'tiki-26-69442af541181',
            'prix' => 9000.00,
            'afficher_prix' => true,
            'description' => 'A vendre : Catamaran Wharram Tiki 26

Caractéristiques :

Longueur : 8 m

Largeur : 4,50 m

Tirant d’eau : 30 cm

Poids : 750 kg à vide

Construit à La Réunion, pavillon français

Navigations longues réalisées : Réunion – Sainte-Marie, Sainte-Marie – Diego, Diego – Nosy Bé

Bateau stable, léger et rapide, idéal pour explorer

Gréement :

Mât alu 10 m et bôme alu

2 étais inox et 4 haubans inox

Trampoline à l’avant

Winch de mât

Grand voile lattée 17 m² (2 ris) en bon état

Foc enroulé 9 m² en bon état

Tourmentin 4 m² neuf

Mouillage : ancre 10 kg, chaîne 5 m, corde 40 m

Motorisation :

Moteur Yamaha 2 temps, 8 ch, 300 h de fonctionnement

Enduro, vitesse moteur seul : 6 nœuds

Nourrice 25 L et jerricans essence 75 L

Équipement :

Annexe gonflable 2 places avec rames (Décathlon)

80 m de drisses neuves et pièces inox diverses

Bouteille de gaz et équipement pour cuisine

Trousse à outils complète

Tauds de protection

Jerrican d’eau 100 L

2 couchettes avec filets de rangement

Coffres de rangement

Tente à placer dans le carré

A saisir pour navigations sympa dans le canal du Mozambique - Infos, visites: Quentin +261 32 79 16 308',
            'symboles' => null,
            'mots' => null,
            'chantier' => null,
            'architecte' => 'James Wharram Design',
            'pavillon' => 'Français',
            'annee' => null,
            'materiaux' => 'CP Epoxy',
            'longueurht' => 8.00,
            'largeur' => 4.50,
            'tirantdeau' => 0.30,
            'poidslegeencharges' => 750.00,
            'surfaceaupres' => 25.00,
            'heuresmoteur' => 300,
            'puissance' => 8,
            'moteur' => 'Yamaha',
            'systemeantiderive' => null,
            'cabines' => 2,
            'passagers' => null,
        ]);

    }
}
