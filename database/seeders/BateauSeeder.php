<?php

namespace Database\Seeders;

use App\Models\Bateau;
use App\Models\Zone;
use App\Models\Type;
use App\Models\Action;
use Illuminate\Database\Seeder;

class BateauSeeder extends Seeder
{
    /**
     * Run the database seeder.
     *
     * Auto-generated from JSON on 2025-12-28 11:41:55
     * Total bateaux: 55
     */
    public function run(): void
    {
        // Protection : ne pas re-seeder si des bateaux existent déjà
        if (Bateau::count() > 0) {
            echo "\n⏭️  Bateaux déjà présents en base, skip du seeding\n";
            return;
        }

        echo "\n🚢 Seeding 55 bateaux...\n\n";

        // Bateau 1: VEDETTE PRO
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'VEDETTE PRO',
            'slug' => 'vedette-pro',
            'prix' => 225000.0,
            'afficher_prix' => true,
            'description' => 'À VENDRE — Bateau de charge / transport / remorquage / bord-à-bord\nUnité professionnelle robuste, refondue en 2024, opérationnelle immédiatement -\nCaractéristiques générales :\nConstruction : 1992\nChantier : Guy Couach\nCoque : Polyester\nRefonte complète : 2024\nPavillon : Madagascar\nÉquipage idéal : 2 -\nSellerie Beneteau -\nCapacités :\nGasoil : 1 300 L\nEau douce : 400 L -\nPropulsion :\n2 moteurs IVECO 450 ch (8210) – SRM35 – Keel Cooling\nInverseurs Twin-Disc avec Trawling Valves\nVitesse max : 18 nds\nVitesse éco : 10 nds (35 L/h) -\nÉnergie :\n2 alternateurs 80 A\n4 batteries 200 Ah\nPanneau solaire 450 W\n1 batterie gel 200 Ah\nConvertisseur 220 V / 2000 W -\nNavigation et électronique\nGPS / Sondeur Garmin \nCartographie \nVHF -\nPoints forts : \nParfait pour transport de charge, remorquage, missions portuaires ou bord-à-bord\nEntretien et refonte réalisés en 2024\nFiable, économique à l’usage et immédiatement exploitable\nIdéal pour opérateur maritime recherchant un navire polyvalent et solide. \nInfos: Quentin Whats ap +261 32 19 76 308',
            'chantier' => 'Guy Couach',
            'architecte' => null,
            'pavillon' => 'Malgache',
            'annee' => 1992,
            'materiaux' => 'Polyester',
            'longueurht' => 15.5,
            'largeur' => 4.6,
            'tirantdeau' => 1.3,
            'poidslegeencharges' => 20.0,
            'surfaceaupres' => null,
            'heuresmoteur' => 8000.0,
            'puissance' => 502.0,
            'moteur' => 'IVECO',
            'systemeantiderive' => null,
            'cabines' => null,
            'passagers' => null,
            'published_at' => '2025-12-10T08:33:33',
        ];

        $type = Type::where('libelle', 'Bateau Moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Coup de coeur')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 2: LAGOON 410 S2
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'LAGOON 410 S2',
            'slug' => 'lagoon-410-s2',
            'prix' => 150000.0,
            'afficher_prix' => true,
            'description' => 'Catamaran Lagoon 410 S2 version propriétaire de 2003, sous pavillon français immatriculé à Mayotte (passeport malgache), de 12.37 mètres, avec une belle habitabilité, comprenant un carré spacieux et cuisine, 3 cabines et 2 salles de bain dont une propriétaire. Cette unité nécessite des travaux de remise en état (listés dans l’inventaire). Unité idéale pour du charter de croisière, ou pour navigations personnelles, prix sacrifié pour vente rapide. Contact et infos : Quentin +262 6 93 13 45 87',
            'chantier' => 'LAGOON',
            'architecte' => 'VPLP Design = Marc Van Peteghem / Vincent Lauriot Prévost',
            'pavillon' => 'FRANÇAIS',
            'annee' => 2003,
            'materiaux' => 'Polyester',
            'longueurht' => 12.37,
            'largeur' => 7.0,
            'tirantdeau' => 1.2,
            'poidslegeencharges' => 7240.0,
            'surfaceaupres' => 94.2,
            'heuresmoteur' => 1400.0,
            'puissance' => 60.0,
            'moteur' => 'VOLVO PENTA',
            'systemeantiderive' => null,
            'cabines' => 3,
            'passagers' => 8,
            'published_at' => '2025-11-27T09:15:01',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Vendu')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 3: CAP CAMARAT
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'CAP CAMARAT',
            'slug' => 'cap-camarat',
            'prix' => 48000.0,
            'afficher_prix' => true,
            'description' => 'Bateau Jeanneau Cap Camarat 5m75 à vendre, équipé d’un Suzuki 140 CV 4 temps de 15heures, garantie 1 an ou 500 heures, en rodage. Longueur 5,75 m, largeur 1,90 m, flaps arrières portant la longueur totale à 6,05 m. Coque polyester repeinte intérieur/extérieur avec peinture polyuréthane et antifouling blanc. Direction hydraulique Ultraflex, commande à distance complète, batterie 100 Ah neuve avec bac, réservoir d’essence aluminium 160 L, compte-tours, faisceau et installation moteur professionnels. Le bateau dispose d’un poste de pilotage avec glacière 60 L, banquette arrière blanche et turquoise, deux coffres-bancs refaits, pompe de cale automatique, feux de navigation, coupe-circuit, GPS Garmin 9 pouces avec sonde et carte. Hard Top polyester blanc et bleu 1,90 × 1,30 m, structure inox Ø32 et Ø25, pare-brise 8 mm, quatre portes-cannes, prises USB et interrupteurs intégrés, coussins blancs et passe poils turquoise, mât de ski nautique inox. Mouillage complet avec ancre 8 kg, 12 m de chaîne Ø10, 15 m de corde Ø12. Ensemble en excellent état, prêt à naviguer immédiatement. Prix 48 000 euros. Contact Quentin WhatsApp +261 32 79 16 308.',
            'chantier' => 'Jeanneau',
            'architecte' => 'Jeanneau',
            'pavillon' => 'Malgache',
            'annee' => 2008,
            'materiaux' => 'Polyester',
            'longueurht' => 5.75,
            'largeur' => 1.9,
            'tirantdeau' => 0.5,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => 15.0,
            'puissance' => 140.0,
            'moteur' => 'Suzuki DF140',
            'systemeantiderive' => null,
            'cabines' => null,
            'passagers' => null,
            'published_at' => '2025-11-25T14:01:02',
        ];

        $type = Type::where('libelle', 'Bateau Moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 4: Ultra Mar Shaft 7M30
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'Ultra Mar Shaft 7M30',
            'slug' => 'ultra-mar-shaft-7m30',
            'prix' => 17000.0,
            'afficher_prix' => true,
            'description' => 'Ultra Mar Shaft 7,30 m (1991) – 2 moteurs Yamaha 115 CV\nBateau insubmersible, fiable et parfaitement entretenu. Dernière révision effectuée en septembre par un professionnel.\nIdéal pour la pêche, les sorties en mer ou les balades côtières. Prêt à naviguer immédiatement.\nCaractéristiques principales :\nLongueur : 7,30 m\nLargeur : 2,40 m\nPoids : environ 2 300 kg (compris moteurs et pleins faits)\nMotorisation : 2 moteurs Yamaha 115 CV essence (révisés) d\'environ 4000H\nRéservoir carburant : 250 L\nRéservoir d’eau douce : 100 L avec douche de pont\nCoque polyester insubmersible à double coque\nCatégorie : C (côtier)\nCapacité : 6 à 8 personnes\nVitesse de croisière : 22–25 nœuds\nVitesse max : jusqu’à 40 nœuds\n\nÉquipements :\nGPS / sondeur\nVHF fixe\nTaud de soleil\nDouche de pont (100 L)\nÉchelle de bain\nGilets de sauvetage\n\nBateau sain, stable et sécurisant, entretenu par un professionnel.\nVisible à Dzaoudzi – essai possible sur rendez-vous.\nAjustement de prix en novembre 2025 pour vente rapide',
            'chantier' => 'Ultra marine',
            'architecte' => null,
            'pavillon' => 'Français',
            'annee' => 1991,
            'materiaux' => 'Polyester',
            'longueurht' => 7.3,
            'largeur' => 2.4,
            'tirantdeau' => 0.5,
            'poidslegeencharges' => 2.3,
            'surfaceaupres' => null,
            'heuresmoteur' => 4000.0,
            'puissance' => 230,
            'moteur' => 'Yamaha H.B',
            'systemeantiderive' => null,
            'cabines' => 1,
            'passagers' => null,
            'published_at' => '2025-11-25T12:45:08',
        ];

        $type = Type::where('libelle', 'Bateau Moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Mayotte')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 5: Galapagos 43
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'Galapagos 43',
            'slug' => 'galapagos-43',
            'prix' => 55000.0,
            'afficher_prix' => true,
            'description' => 'À vendre – Voilier Galapagos 43 Ketch acier\n\nLes mots du propriétaire : "Après plus de 25 000 milles parcourus autour du monde en famille, notre fidèle compagnon "E Pur Si Muove" cherche un nouveau capitaine. Ce ketch en acier, robuste et marin, est prêt à repartir pour de nouvelles aventures."\n\nModèle : Galapagos 43 (avec jupe inox rallongée)\n\nAnnée : 1977 – Pavillon français\n\nCoque : Acier à bouchains, quille fixe\n\nDimensions : 13,67 m x 4 m – Tirant d’eau : 2,30 m\n\nLocalisation actuelle : La Réunion\n\nLivrable à Mayotte ou Madagascar si besoin (traversée possible avec le futur acquéreur)\n\n\nVoilier prêt à naviguer - équipé tour du monde – Inventaire complet sur demande\n\n\nContactez-nous pour plus d’infos ou pour planifier une visite.',
            'chantier' => 'Vaille & Le Nuff',
            'architecte' => null,
            'pavillon' => 'Français',
            'annee' => 1977,
            'materiaux' => 'Acier',
            'longueurht' => 13.67,
            'largeur' => 4.0,
            'tirantdeau' => 2.3,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => 1700.0,
            'puissance' => 55.0,
            'moteur' => 'Sole Mini 55 – Base Mitsubishi',
            'systemeantiderive' => 'Quille fixe',
            'cabines' => null,
            'passagers' => null,
            'published_at' => '2025-11-20T08:52:49',
        ];

        $type = Type::where('libelle', 'Voilier monocoque')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Prix en baisse !')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Réunion')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 6: LEOPARD 38
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'LEOPARD 38',
            'slug' => 'leopard-38',
            'prix' => 148500.0,
            'afficher_prix' => true,
            'description' => 'Disponible chez Myboat Océan Indien : Catamaran Leopard 384 de 2010, chantier Roberston and Caine sous pavillon français, (tva française non réglée)  à usage personnel, taxe seychelloise payée, équipé de 4 cabines, 2 salles de bains. Ce bateau est en bon état, bien entretenu par ses propriétaires depuis bientôt 10 années. Unité idéale pour navigations en croisière, équipée navigation hauturière. Haubans et batteries gel changés en 2025.  Inventaire complet disponible sur demande. VIDEO , VISIO également. Ajustement de prix novembre 2025, visible actuellement au sec à Nosy be Madagascar, à saisir! Renseignements : Quentin whats ap +261 32 79 16 308\nAvailable at Myboat Indian Ocean: 2010 Leopard 384 Catamaran, built by Robertson and Caine, under French flag (French VAT not paid), for personal use, Seychellois tax paid. Equipped with 4 cabins and 2 bathrooms.\nThis boat is in good condition, well maintained by its owners for nearly 10 years. An ideal unit for cruising, equipped for offshore navigation. Shrouds and gel batteries replaced in 2025. Full inventory available on request. VIDEO and VISIO available as well.\nPrice adjustment November 2025. Currently visible on dry at Nosy Be, Madagascar — a great opportunity!\n\nContact: Quentin WhatsApp +261 32 79 16 308',
            'chantier' => 'ROBERTSON AND CAINE',
            'architecte' => 'SIMONIS VOOGD DESIGN',
            'pavillon' => 'FRANÇAIS',
            'annee' => 2010,
            'materiaux' => 'Polyester',
            'longueurht' => 11.58,
            'largeur' => 6.04,
            'tirantdeau' => 1.05,
            'poidslegeencharges' => 8300.0,
            'surfaceaupres' => 92.2,
            'heuresmoteur' => 4000.0,
            'puissance' => 230.0,
            'moteur' => 'YANMAR  3YM30',
            'systemeantiderive' => null,
            'cabines' => 4,
            'passagers' => 8,
            'published_at' => '2025-11-19T10:00:54',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Coup de coeur')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 7: SUN ODYSSEY 39 i
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'SUN ODYSSEY 39 i',
            'slug' => 'sun-odyssey-39-i',
            'prix' => 90000.0,
            'afficher_prix' => true,
            'description' => 'À vendre : Jeanneau Sun Odyssey 39i – 2008 (mis à l’eau en 2009) \nSous pavillon tanzanien, ce voilier de 11,62 m x 3,88 m avec tirant d’eau de 2,00 m est en parfait état et prêt à naviguer.\nIl offre 3 cabines, 8 couchages et 2 salles de bain, un moteur Yanmar 40 CV, ainsi qu’un équipement complet : électronique Raymarine, panneaux solaires, cockpit spacieux en teck, grand-voile sur lazy bag et génois sur enrouleur.\nEntretien irréprochable : sellerie et bimini refaits en 2023, batteries neuves en 2022. Sécurité hauturière complète avec radeau de survie 8 personnes. Annexe incluse.\n Opportunité rare pour navigateurs exigeants recherchant confort, performance et fiabilité. Disponible immédiatement.\n\nFor Sale: Jeanneau Sun Odyssey 39i – 2008 (launched 2009) \nFlying the Tanzanian flag, this 11.62 m x 3.88 m sailing yacht with 2.00 m draft is in perfect condition and ready to sail.\nIt features 3 cabins, 8 berths and 2 bathrooms, a Yanmar 40 HP engine, and full equipment: Raymarine electronics, solar panels, spacious teak cockpit, mainsail with lazy bag and furling genoa.\nMeticulously maintained: upholstery and bimini renewed in 2023, new batteries in 2022. Offshore safety equipment with 8-person liferaft. Tender included.\n A rare opportunity for demanding sailors seeking comfort, performance and reliability. Available immediately.\n\nQuentin Whats ap +261 32 79 16 308',
            'chantier' => 'Jeanneau',
            'architecte' => null,
            'pavillon' => 'Tanzanien',
            'annee' => 2008,
            'materiaux' => 'Polyester',
            'longueurht' => 11.62,
            'largeur' => 3.88,
            'tirantdeau' => 2.0,
            'poidslegeencharges' => 733.0,
            'surfaceaupres' => null,
            'heuresmoteur' => null,
            'puissance' => 40,
            'moteur' => 'Yanmar',
            'systemeantiderive' => 'Quille',
            'cabines' => 3,
            'passagers' => 8,
            'published_at' => '2025-11-19T09:30:34',
        ];

        $type = Type::where('libelle', 'Voilier monocoque')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Coup de coeur')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 8: TIKI 26
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'TIKI 26',
            'slug' => 'tiki-26',
            'prix' => 9000.0,
            'afficher_prix' => true,
            'description' => 'A vendre : Catamaran Wharram Tiki 26\n\nCaractéristiques :\n\nLongueur : 8 m\n\nLargeur : 4,50 m\n\nTirant d’eau : 30 cm\n\nPoids : 750 kg à vide\n\nConstruit à La Réunion, pavillon français\n\nNavigations longues réalisées : Réunion – Sainte-Marie, Sainte-Marie – Diego, Diego – Nosy Bé\n\nBateau stable, léger et rapide, idéal pour explorer\n\nGréement :\n\nMât alu 10 m et bôme alu\n\n2 étais inox et 4 haubans inox\n\nTrampoline à l’avant\n\nWinch de mât\n\nGrand voile lattée 17 m² (2 ris) en bon état\n\nFoc enroulé 9 m² en bon état\n\nTourmentin 4 m² neuf\n\nMouillage : ancre 10 kg, chaîne 5 m, corde 40 m\n\nMotorisation :\n\nMoteur Yamaha 2 temps, 8 ch, 300 h de fonctionnement\n\nEnduro, vitesse moteur seul : 6 nœuds\n\nNourrice 25 L et jerricans essence 75 L\n\nÉquipement :\n\nAnnexe gonflable 2 places avec rames (Décathlon)\n\n80 m de drisses neuves et pièces inox diverses\n\nBouteille de gaz et équipement pour cuisine\n\nTrousse à outils complète\n\nTauds de protection\n\nJerrican d’eau 100 L\n\n2 couchettes avec filets de rangement\n\nCoffres de rangement\n\nTente à placer dans le carré\n\nA saisir pour navigations sympa dans le canal du Mozambique - Infos, visites: Quentin +261 32 79 16 308',
            'chantier' => null,
            'architecte' => 'James Wharram Design',
            'pavillon' => 'Français',
            'annee' => null,
            'materiaux' => 'CP Epoxy',
            'longueurht' => 8.0,
            'largeur' => 4.5,
            'tirantdeau' => 0.3,
            'poidslegeencharges' => 750.0,
            'surfaceaupres' => 25.0,
            'heuresmoteur' => 300.0,
            'puissance' => 8.0,
            'moteur' => 'Yamaha',
            'systemeantiderive' => null,
            'cabines' => 2,
            'passagers' => null,
            'published_at' => '2025-11-14T13:23:54',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 9: Power Cat 36
        $bateauData = [
            'visible' => true,
            'occasion' => false,
            'modele' => 'Power Cat 36',
            'slug' => 'power-cat-36',
            'prix' => 60000.0,
            'afficher_prix' => true,
            'description' => 'Catamaran neuf en polyester équipé et prêt à naviguer. Dimensions 11 mètres par 3,70 mètres. Coque insubmersible avec bracket bi-moteurs, grand coffre avant et deux coffres arrière de 150 litres chacun équipés de pompes.\n\nMotorisé par deux Mercury Sea Pro 150 CV année 2019, avec direction hydraulique complète.\n\nLe bateau dispose de réservoirs inox de 200 litres, d’une console centrale avec T-top, de cinq porte-cannes, trois taquets d’amarrage, huit porte-canne inox, deux batteries de 100 Ah, d’un tableau électrique, d’une boussole, d’une sellerie complète et d’une barre inox.\n\nCatamaran idéal pour la pêche, les balades côtières ou le transport maritime. Construction robuste et finitions soignées.\nContact infos : Quentin whats ap +261 32 79 16 308',
            'chantier' => null,
            'architecte' => null,
            'pavillon' => 'Malgache',
            'annee' => 2025,
            'materiaux' => 'Polyester',
            'longueurht' => 11.0,
            'largeur' => 3.7,
            'tirantdeau' => 0.55,
            'poidslegeencharges' => 3200.0,
            'surfaceaupres' => null,
            'heuresmoteur' => 1500.0,
            'puissance' => 150.0,
            'moteur' => 'Mercury Sea pro 2019',
            'systemeantiderive' => null,
            'cabines' => null,
            'passagers' => null,
            'published_at' => '2025-10-14T14:02:04',
        ];

        $type = Type::where('libelle', 'Catamaran à moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 10: DEAN 440
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'DEAN 440',
            'slug' => 'dean-440',
            'prix' => 195000.0,
            'afficher_prix' => true,
            'description' => 'Superbe opportunité à saisir sur la côte ouest de Madagascar, Catamaran de 2005, modèle Dean 440 sous pavillon français, entièrement refité à neuf entre 2023 et 2024 par un chantier professionnel (remplacement moteurs, gréément courant et dormant, accastillage, cosmétique intérieure et extérieure, électronique, solaire, antifouling coppercoat... listés dans l\'inventaire, valeur supérieure à 60 000€), équipé de deux moteurs Yanmar 55CV en parfait état, jeu de voile neuf, autonomie solaire, réfrigération et congélation. Il dispose de 3 cabines doubles, 4 salles de bain et WC électriques, un grand carré et cockpit, plage arrière, portique panneaux solaires.\nUnité idéale pour activités de charter ou vie à bord et croisières.\nBaisse de prix au 1er février 2025 pour cause de changement de programme du propriétaire. Opportunité à saisir!\nUnité prête à naviguer, visite et infos Quentin Whats app +262 6 93 13 45 87 ou +261 32 79 16 308',
            'chantier' => 'Dean',
            'architecte' => 'Afrique du sud',
            'pavillon' => 'Français',
            'annee' => 2005,
            'materiaux' => 'Polyester',
            'longueurht' => 13.25,
            'largeur' => 7.05,
            'tirantdeau' => 1.1,
            'poidslegeencharges' => 1000.0,
            'surfaceaupres' => 135.0,
            'heuresmoteur' => 850.0,
            'puissance' => 55.0,
            'moteur' => 'Yanmar 4 cylindres',
            'systemeantiderive' => 'Quilleron',
            'cabines' => 4,
            'passagers' => 8,
            'published_at' => '2025-09-30T06:56:35',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Vendu')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 11: ASTUS 20.5 SPORT
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'ASTUS 20.5 SPORT',
            'slug' => 'astus-20-5-sport',
            'prix' => 36000.0,
            'afficher_prix' => true,
            'description' => 'L’Astus 20.5 Sport est un trimaran de croisière rapide avec coques en infusion, de 2020 du chantier Astusboats, de 5.95M de long par 4.5M, sous pavillon français, taxes d’import à Mayotte payées, de première main, avec remorque de transport et de mise à l’eau. Unité dotée d’un jeu de voile et d’un accastillage en excellent état. Idéale pour sorties, croisières et régates. Inventaire complet sur demande.Baisse de prix de 2 000€ en septembre 2025 pour vente rapide. Infos : Quentin Whats app +262 6 93 13 45 87',
            'chantier' => 'ASTUSBOATS',
            'architecte' => null,
            'pavillon' => 'FRANÇAIS',
            'annee' => 2020,
            'materiaux' => 'Polyester',
            'longueurht' => 5.95,
            'largeur' => 4.5,
            'tirantdeau' => null,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => 40.0,
            'puissance' => 3.5,
            'moteur' => 'HB MERCURY 4 Temps',
            'systemeantiderive' => null,
            'cabines' => null,
            'passagers' => null,
            'published_at' => '2025-09-30T06:55:12',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Prix en baisse !')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Mayotte')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 12: LAGOON 380
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'LAGOON 380',
            'slug' => 'lagoon-380',
            'prix' => 170000.0,
            'afficher_prix' => true,
            'description' => 'A vendre Lagoon 380 de 2002, version 4 cabines et 2 salles d’eau, idéal pour le charter et les \ncroisières dans l’océan Indien. Ce catamaran de 11,55 m de long et 6,53 m de large offre \nconfort, espace et fiabilité. \nÉquipé de deux moteurs Yanmar 3YM30 de 29 CV de 2016, il dispose de 600 Ah de \nbatteries, d’un convertisseur 1500 W, de panneaux solaires et d’un dessalinisateur 60 L/h. \nLe carré et le cockpit spacieux sont parfaitement pensés pour la vie à bord. On retrouve \nréfrigérateur, congélateur, douche de cockpit, table de cockpit et de nombreux rangements. \nLa navigation est facilitée par un GPS Garmin, un pilote automatique Raymarine, un \nanémomètre et un guindeau électrique. Les voiles sont en bon état avec une grand-voile \néquipée de lazy bag et lazy jack et un génois sur enrouleur. \nLe bateau est prêt à naviguer et a bénéficié d’un antifouling en juin 2024. Il est immatriculé \nau pavillon malgache et parfaitement adapté pour exploiter une activité de charter ou partir \nen croisière familiale en toute sérénité.\nPour toute demande de visite, visio et renseignements complémentaires : Quentin +261 32 79 16 308',
            'chantier' => 'Lagoon',
            'architecte' => 'VPLP',
            'pavillon' => 'Malgache',
            'annee' => 2002,
            'materiaux' => 'Polyester',
            'longueurht' => 11.55,
            'largeur' => 6.53,
            'tirantdeau' => 1.15,
            'poidslegeencharges' => 7300.0,
            'surfaceaupres' => 77.0,
            'heuresmoteur' => 5535.0,
            'puissance' => 29,
            'moteur' => 'Yanmar',
            'systemeantiderive' => 'Quilleron',
            'cabines' => 4,
            'passagers' => 10,
            'published_at' => '2025-09-09T11:25:01',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 13: DUFOUR 41
        $bateauData = [
            'visible' => true,
            'occasion' => false,
            'modele' => 'DUFOUR 41',
            'slug' => 'dufour-41',
            'prix' => 28000.0,
            'afficher_prix' => true,
            'description' => 'Voilier Dufour 41, version Sortilège, de 1972, sous pavillon malgache, de 12M50 de long par 3M75, équipé d\'un moteur perkins 4108 de 50cv avec 5000 heures évolutives. Notre unité contient 2 cabines doubles dont une propriétaire, 2 salles de bain et un WC (possibilité de rajouter un WC pour la cabine avant), un grand carré et cuisine.\nEquipé solaire, des travaux ont été réalisés par le propriétaire comme la peinture de pont et coque dernièrement,il est doté d\'une grand voile, génois médium et trinquette. Notre unité est idéale pour navigations et vie à bord.\nForte baisse de prix septembre 2025 pour changement de projet du propriétaire, affaire à saisir!\nInfos et visites Quentin +262 6 93 13 45 87 ou +261 32 79 16 308 (whats ap)',
            'chantier' => 'Dufour',
            'architecte' => null,
            'pavillon' => 'Malgache',
            'annee' => 1972,
            'materiaux' => 'Polyester',
            'longueurht' => 12.5,
            'largeur' => 3.75,
            'tirantdeau' => 2.2,
            'poidslegeencharges' => 9.0,
            'surfaceaupres' => 88.8,
            'heuresmoteur' => 5000.0,
            'puissance' => 50.0,
            'moteur' => 'Perkins 4108',
            'systemeantiderive' => 'Quille',
            'cabines' => 2,
            'passagers' => 6,
            'published_at' => '2025-09-06T07:35:15',
        ];

        $type = Type::where('libelle', 'Voilier monocoque')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Prix en baisse !')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 14: BAHIA 46
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'BAHIA 46',
            'slug' => 'bahia-46',
            'prix' => 220000.0,
            'afficher_prix' => true,
            'description' => 'Catamaran Fountaine Pajot, modèle Bahia 46, de 2006, conçu par Joubert-Nivelt, de 14M de long par 7M40. Cette unité, basée à Madagascar, comprend 4 cabines double, 2 cabines d\'équipage, 4 WC/salles de bain, idéale pour des activités de croisières, charter. Autonomie assurée par une installation solaire et groupe électrogène avec dessalinisateur, travaux récents à bord.\n \nDossier complet + visite : Quentin whats app +262 693134587',
            'chantier' => 'Fountaine Pajot',
            'architecte' => 'Joubert Nivelt',
            'pavillon' => 'Malgache',
            'annee' => 2006,
            'materiaux' => 'Polyester',
            'longueurht' => 14.0,
            'largeur' => 7.4,
            'tirantdeau' => 1.3,
            'poidslegeencharges' => 9500.0,
            'surfaceaupres' => 110.0,
            'heuresmoteur' => null,
            'puissance' => 53.0,
            'moteur' => 'Yanmar 4JH4E',
            'systemeantiderive' => 'sans dérive',
            'cabines' => 4,
            'passagers' => null,
            'published_at' => '2025-09-05T09:56:59',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Prix en baisse !')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 15: LAGOON 52S
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'LAGOON 52S',
            'slug' => 'lagoon-52s',
            'prix' => 599000.0,
            'afficher_prix' => true,
            'description' => 'Ce Lagoon 52S de 2016, entièrement refité en 2023, est un catamaran haut de gamme prêt pour de longues navigations hauturières. Parfaitement entretenu, il offre confort, espace et performance pour vos projets de croisières.\n\nCaractéristiques principales :\n\nAnnée de construction : 2016\nAnnée de refit : 2023\nType : Catamaran (Voile)\nLongueur : 15,85 m\nLargeur : 8,60 m\nTirant d’eau : 1,50 m\nType de lest : Quillard, PTE\nCatégorie de navigation : A (hauturière)\nArmement : Hauturier\nPavillon : Français\n\n\nPour plus d\'informations détaillées, consulter l\'inventaire et le dossier complet.\nAjustement de prix septembre 2025 - 150 000€ pour vente rapide!\nContact : Quentin, via WhatsApp au +262 6 93 13 45 87.',
            'chantier' => 'Lagoon',
            'architecte' => null,
            'pavillon' => 'Français',
            'annee' => 2016,
            'materiaux' => 'Polyester',
            'longueurht' => 15.85,
            'largeur' => 8.6,
            'tirantdeau' => 1.5,
            'poidslegeencharges' => 16.0,
            'surfaceaupres' => 140.0,
            'heuresmoteur' => null,
            'puissance' => 80.0,
            'moteur' => 'Yanmar',
            'systemeantiderive' => 'Quillerons',
            'cabines' => 6,
            'passagers' => 12,
            'published_at' => '2025-08-26T07:06:35',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Prix en baisse !')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Seychelles')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 16: DJERBA 470
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'DJERBA 470',
            'slug' => 'djerba-470',
            'prix' => 22000.0,
            'afficher_prix' => true,
            'description' => 'Opportunité unique d’acquérir une société en activité, implantée à Nosy Be, spécialisée dans les excursions et loisirs nautiques. L’entreprise est vendue avec l’ensemble de ses actifs matériels et digitaux, prête à être exploitée immédiatement.\nLa vente comprend :\n- La société enregistrée à Madagascar, avec tous les papiers à jour.\n- Un bateau Djerba 470 (année 1981), sous pavillon malgache, parfaitement entretenu, équipé d’un moteur Suzuki DF90 fiable et économique.\n- Deux corps-morts sécurisés et bien positionnés pour l’amarrage.\n- Quatre bouées tractées, en très bon état, prêtes à l’utilisation pour les activités nautiques à sensation.\n- Le site internet professionnel de la société, avec bon référencement et contenu optimisé.\n- Les comptes réseaux sociaux actifs (Facebook, Instagram).\nCe pack complet est idéal pour un investisseur ou un professionnel du secteur souhaitant s’implanter rapidement sur une île touristique à fort potentiel.\nPrix de vente du lot complet : 22 000€',
            'chantier' => 'JEANNEAU',
            'architecte' => null,
            'pavillon' => 'Malgache',
            'annee' => 1981,
            'materiaux' => 'Polyester',
            'longueurht' => 4.7,
            'largeur' => 1.8,
            'tirantdeau' => 0.3,
            'poidslegeencharges' => 350.0,
            'surfaceaupres' => null,
            'heuresmoteur' => null,
            'puissance' => 90.0,
            'moteur' => 'Suzuki',
            'systemeantiderive' => null,
            'cabines' => null,
            'passagers' => 4,
            'published_at' => '2025-08-20T08:36:50',
        ];

        $type = Type::where('libelle', 'Bateau Moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Prix en baisse !')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 17: JEANNEAU SUN ODYSSEY 45.1.1
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'JEANNEAU SUN ODYSSEY 45.1.1',
            'slug' => 'jeanneau-sun-odyssey-45-1-1',
            'prix' => 90000.0,
            'afficher_prix' => true,
            'description' => 'VOILIER EN PARFAIT ETAT .Construit dans la plus pure tradition du chantier JEANNEAU, le SUN ODYSSEY 45.1 est l\'un des fleurons de la gamme des bateaux de croisière JEANNEAU. Conçu pour tenir toutes les conditions de haute mer, ce grand voilier représente un équilibre harmonieux entre performance, confort et élégance. Ligne d\'eau fines, carène douce et rapide, plan de pont dégagé en font un majestueux géant des mers., 3 jolies cabines, dont une propriétaire avec salle de bain, grand carré.\nCe dernier, construit en 1995, sous pavillon français (Mayotte taxes import payées) a reçu pour 60 000e de travaux de refit et d’équipements en 2022. Le bateau est prêt à naviguer, inventaire dispo sur demande avec liste complète des travaux et équipements effectués, visio possible. Je suis sur place : Quentin Whats app +262 6 93 13 45 87.',
            'chantier' => 'JEANNEAU',
            'architecte' => null,
            'pavillon' => 'FRANCAIS',
            'annee' => 1995,
            'materiaux' => 'Polyester',
            'longueurht' => 14.5,
            'largeur' => 4.48,
            'tirantdeau' => 1.75,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => 1000.0,
            'puissance' => 75.0,
            'moteur' => 'YANMAR',
            'systemeantiderive' => null,
            'cabines' => 3,
            'passagers' => 8,
            'published_at' => '2025-08-13T14:18:24',
        ];

        $type = Type::where('libelle', 'Voilier monocoque')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Prix en baisse !')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 18: Wharram
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'Wharram',
            'slug' => 'wharram',
            'prix' => 33000.0,
            'afficher_prix' => true,
            'description' => 'À vendre, catamaran modèle Wharram, d’une longueur de 11 mètres, situé à Madagascar. Ce bateau unique, conçu pour la navigation en haute mer, allie performance et confort.\n\n*Caractéristiques :\n\n- Modèle : Wharram\n- Longueur : 11 mètres\n- Structure : Contreplaqué époxy, offrant résistance et légèreté\n- État : Travaux de cosmétique et divers à prévoir\n- Refit complet structurel en 2022.\n\n*Avantages :\n\n- Idéal pour les croisières en famille ou entre amis\n- Conception stable et maniable\n- Adapté à une navigation dans les eaux tropicales\n- Energie solaire\n\n\n*Contact :\n\nPour plus d’informations ou pour organiser une visite : Quentin Whats ap : +262 6 93 13 45 87 / local : 032 79 16 308.\n\nNe manquez pas cette opportunité d’acquérir un catamaran exceptionnel dans un cadre idyllique !\nAjustement de prix en juillet 2025, pour vente rapide, vendeur motivé!',
            'chantier' => null,
            'architecte' => 'Wharram',
            'pavillon' => 'Malgache',
            'annee' => 1969,
            'materiaux' => 'CP Epoxy',
            'longueurht' => 11.0,
            'largeur' => 5.5,
            'tirantdeau' => 0.8,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => null,
            'puissance' => 25.0,
            'moteur' => 'Yamaha H.B',
            'systemeantiderive' => null,
            'cabines' => 3,
            'passagers' => 8,
            'published_at' => '2025-07-25T07:27:00',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Prix en baisse !')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 19: HARMONY 47
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'HARMONY 47',
            'slug' => 'harmony-47',
            'prix' => 90000.0,
            'afficher_prix' => true,
            'description' => 'VOILIER HARMONY 47 en parfait état\nDe retour de voyage, prèt a repartir\n4 Cabines doubles/\n- 1 Cabine double avant\n- 1 Cabine double latérale avec deux lits superposés (tribord)\n- 2 Cabines doubles arrière\n2 Cabinets de toilette avec douche lavabo et WC\nEau chaude et froide sous pression\nRéservoir d’eau 500 L\nChauffe eau 220V\nCarré sur tribord avec table et banquette\nCuisine en long sur bâbord\nBasé a la Réunion.visio , visite sur demande. 0692706610',
            'chantier' => 'PONCIN YACHTS',
            'architecte' => 'A.MORTAIN et Y.MAVRIKIOS',
            'pavillon' => 'FRANÇAIS',
            'annee' => 2007,
            'materiaux' => 'Polyester',
            'longueurht' => 13.95,
            'largeur' => 4.25,
            'tirantdeau' => 1.6,
            'poidslegeencharges' => 10650.0,
            'surfaceaupres' => null,
            'heuresmoteur' => null,
            'puissance' => 75.0,
            'moteur' => 'VOLVO',
            'systemeantiderive' => 'QUILLE',
            'cabines' => 4,
            'passagers' => 8,
            'published_at' => '2025-07-15T19:49:24',
        ];

        $type = Type::where('libelle', 'Voilier monocoque')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Vendu')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Réunion')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 20: SCHOONER 50
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'SCHOONER 50',
            'slug' => 'schooner-50',
            'prix' => 240000.0,
            'afficher_prix' => true,
            'description' => 'Goélette de croisière Schooner 50’ en strip planking, du chantier Mike Allen (Carmen), design Nigel Irens, construite aux Philippines en 2010 par un passionné. Unité exceptionnelle de 15 mètres, de première main, dotée d’une cabine propriétaire, spacieux carré et cuisine, équipée pour navigations au long cours. Dossier inventaire complet sur demande, visite par Quentin whats app +262 6 93 13 45 87.\nLes mots du propriétaire motivé : "Tout d’abord, sachez que je vend a regret ce bateau pour des raisons familliales, personnelles . \nPour la petite histoire, nous sommes arrive d’asie dans la region il y a 5 ans avec ce bateau, passer un an a la réunion, et depuis l’avant ”Covid”  nous sommes a nosy be madagascar. \nLe bateau a très peu navigué depuis, faute de petit entretien courant, il est a 90 % fonctionnel, le carénage a faire , mais difficile de trouver ici de l’antifouling de bonne qualite.. \nLes mâts, bome, gaffes entierement en carbone sont parfait, le greement dormant en dynema neuf a été changé à la reunion. Le gréement courant, drisses est partiellement a remplacer car devenu réche.( gréement aurique,  les drisses, 2 par voile, sont des palans a 4 brins...., les voiles sont comme neuves et de très bonne qualitée. le moteur kubota atmospherique de 3.3 litres, tourne a 1600 rpm en route,  inverseur est parfait, comme neuf.\nMouillage, guindeau, chaine, ancre en parfait état.\nLe watermaker, osmoseur, a sans doute la membrane a changer.\nLe groupe diesel de 6 hp kubota produit du 12 volt est ok, peut être l’alternateur a reviser . \nBatterie principale 6 x 600 amp en 2 volts , changer en arrivant ici , ont éte très peu solicite depuis, celles moteurs, 2x 120 amp en 12 volts  idem, mais de mauvaise qualitée ,sont a changer \nPompe des toilettes electrique a verifier.\nIl y a quelques petits travaux de bois a prevoir en contrplaque de 18 mm , sur l’empillage de base de mat de misaine, et sur 2 petites zone du pont, chaque zone douteuse environ 0,5x0,5 m egalement des etancheites aux jambettes. Et les peintures a rafraichir\nLes housses des coussins egalement.\nElectronique fonctionnelle mais les écrans ont des defauts, le fishing sondeur a un probleme, sans doute le cable, et l’ecran de l”ais ( saab class C ) devenu illisible . Ordinateur de bord et ecran de nav ok. \nAnodes de l’hélice repliable Darglow et bague hydrolube disponible en pièces detachés a bord .\nDes béquilles pour échouage sont a bord. Frigo, four , gaziniére ok. Extincteur a révise, plus de radeau de sauvetage, une annexe epoxy avec son moteur 3 hp malta yamaha.\nRégulateur d’allure . Panneaux solaire flexibles chinois fonctionnels mais depolies a changer , 4 x 80w . Il y a un chargeur automatique et un convertisseur 220v de 1000w \nSysteme de derive hydraulique ok.\nVoila, c’est un bateau unique et parfaitement marin , rapide , confortable et esthetique.\nJe suis dispose a négocier le prix , a hauteur du montant des travaux d’entretien ci dessus par exemple, si je suis certain que l’acheteur saura l’entretenir et surtout de naviguer avec ! \nVoyage europe a  ici deduit si achat bien sur .\nN’hesitez pas si questions bien sur."',
            'chantier' => 'MIKE ALLEN',
            'architecte' => 'NIGEL IRENS',
            'pavillon' => 'Malaisien',
            'annee' => 2010,
            'materiaux' => 'strip-planking',
            'longueurht' => 15.0,
            'largeur' => 4.2,
            'tirantdeau' => 0.17,
            'poidslegeencharges' => 21.0,
            'surfaceaupres' => null,
            'heuresmoteur' => 2000.0,
            'puissance' => null,
            'moteur' => 'KUBOTA',
            'systemeantiderive' => 'Quille longue / dériveur',
            'cabines' => 1,
            'passagers' => 8,
            'published_at' => '2025-07-04T09:56:48',
        ];

        $type = Type::where('libelle', 'Voilier monocoque')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Prix en baisse !')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 21: NORMAN CROSS 36R
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'NORMAN CROSS 36R',
            'slug' => 'norman-cross-36r',
            'prix' => 56000.0,
            'afficher_prix' => true,
            'description' => 'Trimaran Norman Cross 36R de 1983 en contreplaqué fibre de verre, fabriqué par Bernard Hardy, de 10M98 de long, équipé d\'un moteur Yanmar 3YM30AE, jeu de voile récent et en très bon état. Travaux de refit récents effectués, comprenant l\'électronique de qualité Raymarine, autonomie solaire avec panneaux solaires, contrôleur de batterie MPPT et batteries Victron AGM, dessalinisateur Katadyn powersurvivor 40E. Une expertise de juillet 2024 a été effectuée en juillet 2024. Renseignements, inventaire et photos disponible sur demande pour cette très belle unité : Whats ap +262 6 93 13 45 87 Quentin\nBaisse de prix juin 2025 de 10 000€, cause changement de programme du propriétaire.',
            'chantier' => 'Bernard Hadry',
            'architecte' => null,
            'pavillon' => 'Mauricien',
            'annee' => 1983,
            'materiaux' => 'Contre plaqué fibre de verre',
            'longueurht' => 10.98,
            'largeur' => 6.4,
            'tirantdeau' => 1.3,
            'poidslegeencharges' => 3500.0,
            'surfaceaupres' => null,
            'heuresmoteur' => 250.0,
            'puissance' => 30.0,
            'moteur' => 'Yanmar 3YM30AE',
            'systemeantiderive' => null,
            'cabines' => 1,
            'passagers' => null,
            'published_at' => '2025-06-19T13:44:33',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Maurice')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 22: TROPICAL BOAT 14M80
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'TROPICAL BOAT 14M80',
            'slug' => 'tropical-boat-14m80',
            'prix' => 125000.0,
            'afficher_prix' => true,
            'description' => 'Catamaran TROPICAL BOAT – 2013 – Pavillon Malgache  \nCe power catamaran de 14,80m de long pour 5,50m de large, construit en contreplaqué résiné époxy au chantier Tropical Boat, est une unité solide et bien équipée, parfaitement adaptée pour la croisière côtière, les excursions touristiques ou un usage professionnel.  \nMotorisation : \n- 2 moteurs hors-bord Suzuki 150cv – 5000h – Bon état de fonctionnement \n- Réservoirs essence : 2 x 450L  \n\nAménagements intérieurs : \n- 2 cabines simples dans les flotteurs  \n- 2 cabines doubles dans le carré  \n- **Possibilité d’ajouter une cabine double sur le fly  \n- 1 salle d’eau avec douche et WC \n- Carré ventilé \n- Cuisine équipée:  \n  - 1 réfrigérateur  \n  - 2 congélateurs (175L et 50L)  \n  - Four, plaque 4 feux  \n  - Barbecue  \n\nAutonomie & équipements énergétiques:  \n- Installation électrique haut de gamme (valeur 15 000€) Victron et lithium :  \n  - Convertisseur Victron Multiplus 3000W  \n  - 2 régulateurs MPPT 150/85  \n  - 8 panneaux solaires 200W  \n  - 24 batteries lithium 2V  \n- Tension disponible en 220V à bord  \n\nEquipements de navigation & sécurité :  \n- Guindeau électrique avec 50m de chaîne de 12  \n- 2 ancres de 25Kg  \n- Électronique:  \n  - Sondeur Humminbird  \n  - VHF fixe  \n  - Pilote automatique Raymarine \n\nAnnexe sans moteur incluse  \n\nCapacité légale : 28 passagers + 3 membres d’équipage** – Idéal pour activité charter ou croisière privée  \n\nEntretien à jour:  \n- Dernier carénage : 2024 \n- Peinture de pont neuve (réalisée pour la vente)\nValeur neuve : 220 000€** – Prix actuel : 130 000€. Ajustement de prix au 12/06/2025 125 000€.\n\nVisible sous pavillon malgache – Prêt à naviguer',
            'chantier' => 'Tropical Boat',
            'architecte' => 'Vandame',
            'pavillon' => 'Malgache',
            'annee' => 2013,
            'materiaux' => 'CP Epoxy',
            'longueurht' => 14.8,
            'largeur' => 5.5,
            'tirantdeau' => 1.5,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => 5000.0,
            'puissance' => 150.0,
            'moteur' => 'Suzuki',
            'systemeantiderive' => null,
            'cabines' => 4,
            'passagers' => 8,
            'published_at' => '2025-06-12T13:58:55',
        ];

        $type = Type::where('libelle', 'Catamaran à moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Prix en baisse !')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 23: TRIMAKI
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'TRIMAKI',
            'slug' => 'trimaki',
            'prix' => 8500.0,
            'afficher_prix' => true,
            'description' => '- Trimaki est un trimaran de 18 pieds, « one off » démontable et transportable sur remorque, conçu pour la balade sportive (4 personnes) et le raid côtier en autonomie complète (2 personnes).\n- C’est un bateau idéal pour le lagon de Mayotte, et également autour de Madagascar, sur les lacs et le canal des Pangalanes. Il est actuellement à Madagascar.\n- Remorque pro\n- Prix sacrifié\nPlus de photos sur demande.',
            'chantier' => 'Vincent LEGER',
            'architecte' => 'Vincent LEGER',
            'pavillon' => 'MALGACHE',
            'annee' => 2010,
            'materiaux' => 'composite verre-bois-époxy stratifié',
            'longueurht' => null,
            'largeur' => 12.84,
            'tirantdeau' => 2.51,
            'poidslegeencharges' => 340.0,
            'surfaceaupres' => null,
            'heuresmoteur' => null,
            'puissance' => 2.5,
            'moteur' => 'TOHATSU',
            'systemeantiderive' => '_',
            'cabines' => null,
            'passagers' => 4,
            'published_at' => '2025-06-11T10:08:36',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Prix en baisse !')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 24: TRISWOOD 35
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'TRISWOOD 35',
            'slug' => 'triswood-35',
            'prix' => 19000.0,
            'afficher_prix' => true,
            'description' => 'VOILIER DERIVEUR INTEGRAL OCEANIQUE BI-SAFRANS\n- Grand volume habitable et très rapide\n-Quille relevable entièrement\n-Se pose sur la plage directement - semelle sous coque en polypropylène indéformable\n-Construction très robuste par Chantier professionnel France CBM a Abancourt 60220\nREFIT 2022 :-Moteur diésel SD Volvo 28 cv à réviser. Nombre d’heures inconnues\nCe voilier transocéanique a été désarmé entièrement pour réaliser un refit a\nneuf coque - pont - intérieur - doublage stratifié époxy et peinture bi-composante 2\ncouches - antidérapant de pont. Tous les hublots du navire ont étés changés a neuf.\nL’accastillage et les équipements de navigation ont été remontés.\nLe bateau a subi un refit électrique, nouvelle électronique à bord (GPS, sondeur…),\nfactures sur demande.\nLe gréement courant a été intégralement remplacé, révision des voiles faite.\nLa sellerie intérieure a été refaite également, ainsi que la cosmétique intérieure.\nTotal travaux (fourniture et main d’œuvre): 10 000€.\nAJUSTEMENT DE PRIX AU 05/06/2025 : - 10 000€ pour cause de travaux à prévoir et changement de projet du propriétaire. Affaire à saisir.\nContact: Quentin +261 32 79 16 308 (whats ap)',
            'chantier' => 'CBM FRANCE',
            'architecte' => null,
            'pavillon' => 'FRANÇAIS',
            'annee' => 1989,
            'materiaux' => 'CP EPOXY',
            'longueurht' => 11.5,
            'largeur' => 3.5,
            'tirantdeau' => 0.7,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => null,
            'puissance' => 28.0,
            'moteur' => 'VOLVO PENTA',
            'systemeantiderive' => 'Dérive',
            'cabines' => 2,
            'passagers' => 6,
            'published_at' => '2025-06-05T09:26:12',
        ];

        $type = Type::where('libelle', 'Voilier monocoque')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Prix en baisse !')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 25: WELLCRAFT SCARAB 30
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'WELLCRAFT SCARAB 30',
            'slug' => 'wellcraft-scarab-30',
            'prix' => 44320.0,
            'afficher_prix' => true,
            'description' => 'Libérez la puissance du Wellcraft Scarab 30 : une bête de mer élégante et performante, conçue pour la vitesse, l\'agilité et l\'aventure. Avec ses deux moteurs offrant des accélérations fulgurantes, sa coque en V profond pour une maniabilité supérieure et son design audacieux qui ne passe pas inaperçu, ce bateau est parfait pour les amateurs de sensations fortes comme pour les passionnés de sports nautiques.\n\nÉquipement\nSalle de bains entièrement rénovée\n5 places assises\nCabine pour deux personnes et capacité pour la nuit\nSalle de bain spacieuse\n\nUnleash the power of the Wellcraft Scarab 30—a sleek, high-performance offshore beast built for speed, agility, and adventure. With twin engines delivering heart-pounding acceleration, a deep-V hull for superior handling, and a bold design that turns heads, this boat is perfect for adrenaline seekers and weekend warriors alike.\n\nEquipment\nFully renovated seating area\nSeating for 5\nCabin birth for 2 and capacity for overnight\ndecent size head',
            'chantier' => null,
            'architecte' => null,
            'pavillon' => null,
            'annee' => null,
            'materiaux' => 'Polyester',
            'longueurht' => 9.14,
            'largeur' => null,
            'tirantdeau' => 0.7,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => 90.0,
            'puissance' => 502.0,
            'moteur' => 'Mercruiser 350 MAG X2',
            'systemeantiderive' => null,
            'cabines' => null,
            'passagers' => null,
            'published_at' => '2025-05-26T11:15:14',
        ];

        $type = Type::where('libelle', 'Bateau Moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Maurice')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 26: DONZI 35
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'DONZI 35',
            'slug' => 'donzi-35',
            'prix' => 110975.0,
            'afficher_prix' => true,
            'description' => 'Avec ses lignes élégantes et aérodynamiques et ses moteurs à haute performance, cette machine domine l\'eau, offrant une vitesse et des sensations fortes qui laissent tout le reste dans son sillage.\nÀ l\'intérieur, le ZR 40 vous fait chouchouter avec des sièges luxueux, des finitions premium et un système audio conçu pour donner vie à vos aventures. Sa conception avancée de coque assure une expérience lisse et stable, même à des vitesses de pointe.\nCe n\'est pas seulement un bateau - c\'est l\'occasion de posséder un joyau d\'occasion en état immaculé. Entrez à bord, prenez la barre et faites-en le vôtre aujourd\'hui.\nDÉTAIL\nMercruiser 496 mag ho\nÉquipement\n3 pompes à cale automatique\n1 pompe manuelle\nChargeur de batterie\nWinch\n2 ancres\nTrousse de secours\nRéfrigérateur\nSystème de son pionnier\n\nImagine slicing through the waves with power, precision, and unmistakable style. The Donzi ZR 35 isn’t just a boat—it’s a statement. With its sleek, aerodynamic lines and twin high-performance engines, this machine dominates the water, delivering speed and thrills that leave everything else in its wake.\n\nInside, the ZR 40 pampers you with luxury—plush seating, premium finishes, and a sound system designed to bring your adventures to life. Its advanced hull design ensures a smooth, stable experience, even at top speeds.\n\nThis isn’t just a boat—it’s an opportunity to own a second-hand gem in immaculate condition. Step aboard, take the helm, and make it yours today.\n\nDETAIL\nMotor Boat\n\nSecond Hand\n\nMercruiser 496 Mag HO\n\nEquipment\n3 Automatic bilge pumps\n1 Manual bilge pump\nBattery charger\nFull size head\nWindlass\n2 anchors\nFirst aid kit\nFridge\nPioneer sound system',
            'chantier' => 'Donzi 35',
            'architecte' => null,
            'pavillon' => null,
            'annee' => null,
            'materiaux' => 'Polyester',
            'longueurht' => 10.7,
            'largeur' => null,
            'tirantdeau' => 0.8,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => 695.0,
            'puissance' => null,
            'moteur' => '2X Mercruiser 496Mag Ho',
            'systemeantiderive' => null,
            'cabines' => null,
            'passagers' => null,
            'published_at' => '2025-05-26T10:47:24',
        ];

        $type = Type::where('libelle', 'Bateau Moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Maurice')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 27: JEANNEAU CAP CAMARAT 10.5 CC
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'JEANNEAU CAP CAMARAT 10.5 CC',
            'slug' => 'jeanneau-cap-camarat-10-5-cc',
            'prix' => 279850.0,
            'afficher_prix' => true,
            'description' => 'Prêt pour votre prochaine aventure? Ce Camarat 1023 Jeanneau Cap Camarat 10.5cc est en excellent état, ayant été légèrement utilisé et entretenu professionnellement depuis son arrivée à Maurice. Le bateau est toujours connecté à la puissance du rivage sur un ponton de la marina assurant un système électrique parfaitement fonctionnel. Polyvalent et puissant - idéal pour la croisière, la manipulation des mers difficiles avec facilité ou la pêche. De plus, il est assez confortable pour les escapades le week-end avec des hébergements à bord.\nDÉTAIL\nÉquipement\n2 x Suzuki DF 300 AP (25 heures)\nT-top avec éclairage LED\nRemorque galvanisé\nVaigrage à l\'extérieur de haute qualité - Ice Silvertex\nCoussin + couvercles de console (ajustés à la taille et coupés)\nSalle de bain avec toilettes et douche électriques d\'eau douce\nGuindeau électrique\nPorte de plongée avec échelle de natation\nLumières LED à l\'intérieur et à l\'extérieur\nTabs de garniture Zipwake\n49L FRIGO Dans la cuisine en cockpit\nCircuit 220 V avec chargeur et puissance de rivage\n1 x Garmin GPS Map 1223xsv Écran\nGarmin VHF avec antenne\nSounder en profondeur Garmin GT15M-IH\nSérie de signature du système Sound Fusion (subwoofer, amplificateur, 2 haut-parleurs à l\'intérieur, 6 haut-parleurs à l\'extérieur)\nKit d\'amarrage (ancre de 16 kg, chaîne de 28 m, corde 40m)\n2 x couvercle de l\'ombre pour la zone du cockpit avant et arrière\n2Coussin + couvercles de console\nMât nautique\nPlates-formes de nage étendues\nTable de cockpit en polyester à l\'arrière\nTable de cockpit en bois à l\'avant\nTapis de sol amovibles pour l\'extérieur\nTapis dans le sol de la cabine\nPropulseur à arc\nPompe à eau de mer électrique pour le lavage du pont\nCuiseur à gaz dans le cockpit\nFridge 49L dans la cabine\nChauffe-eau 220V\n\nReady for your next adventure? This 2023 Jeanneau Cap Camarat 10.5CC is in excellent condition, having been lightly used and professionally maintained since its arrival in Mauritius. The boat is always connected to shore power on a pontoon at the marina ensuring a perfectly working electrical system. Versatile & Powerful – Ideal for cruising, handling rough seas with ease, or fishing. Plus, it’s comfortable enough for weekend getaways with sleeping accommodations onboard.\nEquipment\n2 x SUZUKI DF 300 AP (25 hours)\nT-Top with LED lighting\nGalvanised trailor\nHigh quality outside upholstery – SILVERTEX ICE\nCushion + console covers (fit to size and clipped)\nBathroom with fresh water electric toilet and shower\nElectric windlass\nRod holders\nDive door with swimming ladder\nInside and outside LED lights\nZipwake Trim tabs\n49L fridge in kitchen in cockpit\n220V circuit with charger and shore power\n1 x GARMIN Gps Map 1223xsv screen\nGarmin VHF with antenna\nDepth sounder Garmin GT15M-IH\nFusion sound system signature series (Subwoofer, amplifier, 2 speakers inside, 6 speakers outside)\nMooring kit (16Kg anchor, 28m chain, 40m rope)\n2 x Shade cover for front and back cockpit area\nCushion + console covers\nWaterskiiing mast\nExtended swimming platforms\nPolyester cockpit table in the back\nWooden cockpit table in the front\nRemovable floor mats for outside\nCarpet in the cabin floor\nBow thruster\nElectric seawater pump for deck wash\nGaz cooker in cockpit\n49L fridge in the cabin\nWater heater 220v',
            'chantier' => 'JEANNEAU',
            'architecte' => null,
            'pavillon' => null,
            'annee' => 2023,
            'materiaux' => 'Polyester',
            'longueurht' => 10.0,
            'largeur' => 3.2,
            'tirantdeau' => 0.7,
            'poidslegeencharges' => 4500.0,
            'surfaceaupres' => null,
            'heuresmoteur' => 25.0,
            'puissance' => 300.0,
            'moteur' => 'Suzuki DF 300',
            'systemeantiderive' => null,
            'cabines' => 1,
            'passagers' => null,
            'published_at' => '2025-05-26T10:28:16',
        ];

        $type = Type::where('libelle', 'Bateau Moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Coup de coeur')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Maurice')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 28: CRAMAR 37
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'CRAMAR 37',
            'slug' => 'cramar-37',
            'prix' => 130000.0,
            'afficher_prix' => true,
            'description' => 'À vendre : yacht à moteur Cramar de 37 pieds de 2012, construit par le célèbre chantier naval italien Cranchi. Propulsé par deux moteurs diesel Yamaha de 275 CV (moins de 180 heures) avec Z-Drive Hydradrive, ce bateau offre une vitesse de croisière de 27 nœuds à seulement 60L/h et une vitesse maximale de 32 nœuds. Avec un tirant d\'eau de seulement 80 cm, il est parfait pour la navigation côtière.Équipé de deux cabines doubles, d\'une salle de bains, de la climatisation, d\'un chauffe-eau, et d\'un chargeur de batterie 100A et onduleur Victron 3,5 kW flambant neuf, ce yacht allie confort et efficacité. En excellent état mécanique et extrêmement économique, il est prêt à naviguer. Contactez-nous maintenant pour organiser une visite.\nFor sale: 2012 Cramar 37ft motor yacht, built by renowned Italian shipyard Cranchi. Powered by twin Yamaha 275HP diesel engines (under 180 hours) with Z-Drive Hydradrive, this boat delivers a cruising speed of 27 knots at just 60L/hr and a top speed of 32 knots. With a shallow 80cm draft, it’s perfect for coastal cruising.\nFeaturing two double cabins, one bathroom, air conditioning, a water heater, and brand-new 100A battery charger and Victron 3.5kW inverter, this yacht blends comfort with efficiency. In excellent mechanical condition and extremely economical, it’s ready to cruise. Contact now to arrange a viewing.',
            'chantier' => 'Cranchi',
            'architecte' => null,
            'pavillon' => null,
            'annee' => 2012,
            'materiaux' => 'Polyester',
            'longueurht' => 10.92,
            'largeur' => 3.84,
            'tirantdeau' => 0.8,
            'poidslegeencharges' => 6832.0,
            'surfaceaupres' => null,
            'heuresmoteur' => 180.0,
            'puissance' => 275.0,
            'moteur' => 'Yamaha',
            'systemeantiderive' => null,
            'cabines' => 2,
            'passagers' => null,
            'published_at' => '2025-05-26T10:09:40',
        ];

        $type = Type::where('libelle', 'Bateau Moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Maurice')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 29: COLOMBO ALIANTE 32S
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'COLOMBO ALIANTE 32S',
            'slug' => 'colombo-aliante-32s',
            'prix' => 98430.0,
            'afficher_prix' => true,
            'description' => 'Opportunité incroyable : Colombo Aliante 32 S – Comme neuf, entièrement équipé, excellence italienneDécouvrez le mélange parfait de luxe, performance et artisanat avec ce Colombo Aliante 32 S – une rare opportunité de posséder un bateau en état véritablement exceptionnel.Cette unité a été entretenue selon les normes les plus strictes par un propriétaire méticuleux, stockée dans un garage privé pendant la majeure partie de l\'année, et utilisée seulement pendant quelques courtes semaines chaque année. Le résultat est un navire pratiquement intact - pas une seule rayure, à l\'intérieur comme à l\'extérieur.Équipé d\'un éventail d\'options haut de gamme, ce Aliante 32 S a été amélioré pour offrir un maximum de facilité d\'utilisation, un confort accru et une fonctionnalité sans faille. De la navigation au farniente, chaque détail a été soigneusement choisi pour élever la vie sur l\'eau.Grâce à ses doubles Z-Drives, le bateau offre une manœuvrabilité exceptionnelle, permettant au capitaine d\'approcher la côte avec aisance – parfait pour jeter l\'ancre à quelques mètres des plus belles plages de l\'île Maurice.\nConstruit par Colombo Boats, l\'un des plus prestigieux et historiques chantiers navals d\'Italie, l\'Aliante 32 S est un témoignage de décennies de savoir-faire, d\'élégance en design et de performances sur l\'eau. Connue pour ses matériaux de qualité, sa finition précise et son style raffiné, Colombo offre un niveau d\'excellence que peu peuvent égaler. Que vous envisagiez des croisières côtières relaxantes, des sauts rapides vers des îles ou des sorties élégantes en journée avec des amis, ce bateau est prêt à dépasser les attentes — avec l\'apparence et la sensation d\'un navire tout neuf, et tous les bons extras déjà à bord. Contactez-nous dès aujourd\'hui pour organiser une visite ou pour en savoir plus sur cette opportunité exceptionnelle. Équipement : Sellerie rénovée d\'Italie, Historique de service complet de Volvo, État 10/10, Système de charge à triple batterie tout neuf de Vitron, Système stéréo Fusion tout neuf, Réfrigérateur, Toilette électrique, Douche, Bimini en carbone sur mesure de grande taille, Gardé dans un garage la majeure partie de l\'année, Remorque comme neuf incluse.\nReady for your next adventure?\nAmazing opportunity: Colombo Aliante 32 S – Like New, Fully Loaded, Italian Excellence\nDiscover the perfect blend of luxury, performance, and craftsmanship with this Colombo Aliante 32 S – a rare opportunity to own a boat that’s in truly exceptional condition.\nThis unit has been maintained to the highest standards by a meticulous owner, stored in a private garage for most of the year, and used for just a few short weeks annually. The result is a vessel that’s virtually untouched — not a single scratch, inside or out.\nFitted with a range of brand-new, high-end options, this Aliante 32 S has been upgraded to offer maximum ease of use, enhanced comfort, and seamless functionality. From navigation to lounging, every detail has been carefully chosen to elevate life on the water.\nThanks to its twin Z-Drives, the boat offers outstanding maneuverability, allowing the captain to approach the shoreline with ease — perfect for dropping anchor just meters from Mauritius’ most beautiful beaches.\nBuilt by Colombo Boats, one of Italy’s most prestigious and historic boatbuilders, the Aliante 32 S is a testament to decades of fine craftsmanship, design elegance, and performance on the water. Known for their quality materials, precision finishing, and refined style, Colombo delivers a level of excellence that few can match.\nWhether you’re planning relaxing coastal cruises, quick island hops, or stylish day outings with friends, this boat is ready to exceed expectations — with the looks and feel of a brand-new vessel, and all the right extras already on board.\nContact us today to arrange a viewing or to learn more about this exceptional opportunity.\nEquipment\nRefurbished upholstery from Italy\nFull service history from Volvo\nCondition 10/10\nBrand new tripple battery charging system from Vitron\nBrand new fusion stereo system\nFridge\nElectric Toilet\nShower\nFull size custom made carbon bimini\nKept in a garage most of the year\nLike new trailer included',
            'chantier' => 'Colombo boats',
            'architecte' => null,
            'pavillon' => null,
            'annee' => 2010,
            'materiaux' => 'Polyester',
            'longueurht' => 9.96,
            'largeur' => 2.8,
            'tirantdeau' => 0.5,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => 380.0,
            'puissance' => 260.0,
            'moteur' => '2X D4 Volvo PENTA Diesel Z drive',
            'systemeantiderive' => null,
            'cabines' => 1,
            'passagers' => null,
            'published_at' => '2025-05-26T10:09:07',
        ];

        $type = Type::where('libelle', 'Bateau Moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Maurice')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 30: IRIS 37
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'IRIS 37',
            'slug' => 'iris-37',
            'prix' => 175000.0,
            'afficher_prix' => true,
            'description' => 'vendre : Iris 37 - Catamaran à moteur 32 places\n\nPrix de vente : 180 000€\n\nNous proposons à la vente un Iris 37, un catamaran à moteur de 32 places, idéal pour une utilisation professionnelle.\nCe bateau est parfaitement adapté pour des sorties à la journée, l\'observation des baleines, les excursions à Nosy Sakatia, ainsi que pour des trajets de fret ou passagers entre Nosy Be et la Grande Terre.\n\nCaractéristiques :\n\nMoteurs : 2 moteurs Nanni 130cv, version professionnelle, très fiables et révisés régulièrement toutes les 250 heures. Total des heures de fonctionnement : 3000h.\nConsommation : 6L/h pour une vitesse de croisière de 14 nœuds.\nCapacité : 32 passagers.\nCaractéristiques supplémentaires :\nGros ombrage pour un confort optimal des passagers.\nGrandes jupes pour faciliter les mises à l\'eau.\nRéservoir de carburant de 1200L.\nTirant d’eau : 60 cm.\nType de bateau : Professionnel, vérifié chaque année.\nUsage : Idéal pour les journées sur les îles, les plongées, ou même pour l\'observation des requins-baleines.\nHistorique : Navigue avec succès depuis 20 ans dans notre flotte, répondant parfaitement à toutes nos attentes.\nLe bateau est en excellent état et prêt à partir pour de nouvelles aventures. Nous le vendons uniquement car nous avons besoin d’un modèle plus grand.\nConvoyage zone océan indien possible.\nInfos et dossier complet : Quentin Whats ap +262 6 93 13 45 87',
            'chantier' => 'Fountaine Pajot',
            'architecte' => 'Joubert Nivelt',
            'pavillon' => 'Français',
            'annee' => 2000,
            'materiaux' => 'GRP Sandwich',
            'longueurht' => 12.0,
            'largeur' => 5.1,
            'tirantdeau' => 0.6,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => 3000.0,
            'puissance' => 130.0,
            'moteur' => 'Nanni',
            'systemeantiderive' => null,
            'cabines' => null,
            'passagers' => 32,
            'published_at' => '2025-02-26T12:12:45',
        ];

        $type = Type::where('libelle', 'Catamaran à moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Réunion')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 31: LAGOON 450
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'LAGOON 450',
            'slug' => 'lagoon-450',
            'prix' => 350000.0,
            'afficher_prix' => true,
            'description' => 'Spacieux et Luxueux : Le Lagoon 450 offre un espace généreux pour la détente et le plaisir. Avec sa disposition bien pensée, il dispose de cabines confortables, d\'un salon élégant et d\'une cuisine entièrement équipée, garantissant une expérience luxueuse tout au long de votre voyage. Que vous vous prélassiez dans le cockpit spacieux ou que vous vous détendiez à l\'intérieur moelleux, chaque moment à bord est conçu pour offrir un confort maximal.\nLe Lagoon 450 est spécialement conçu pour améliorer la vie en plein air. Son cockpit spacieux offre un cadre idéal pour les repas en plein air, la socialisation ou tout simplement profiter des vues panoramiques. La zone de trampoline à l\'avant est parfaite pour prendre des bains de soleil ou observer les étoiles, offrant une connexion incomparable avec la nature. En naviguant d\'un mouillage à un autre, vous aurez l\'occasion de vous prélasser au soleil chaud et de sentir la brise marine rafraîchissante.\nInfo contact : Quentin +262 6 93 13 45 87 ou + 261 32 79 16 308',
            'chantier' => 'Lagoon',
            'architecte' => null,
            'pavillon' => 'Français (H.T)',
            'annee' => 2018,
            'materiaux' => 'polyester',
            'longueurht' => 13.96,
            'largeur' => 7.87,
            'tirantdeau' => 1.3,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => null,
            'puissance' => 257.0,
            'moteur' => 'Yanmar',
            'systemeantiderive' => 'Quillerons',
            'cabines' => 4,
            'passagers' => 10,
            'published_at' => '2025-01-30T08:49:26',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Seychelles')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 32: LAGOON 380
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'LAGOON 380',
            'slug' => 'lagoon-380',
            'prix' => 215000.0,
            'afficher_prix' => true,
            'description' => 'Lagoon 380 2016. Ce modèle emblématique de Lagoon offre un mélange parfait de confort, de performance et de polyvalence, ce qui en fait un choix idéal pour vos aventures en mer.\nLe Lagoon 380 est réputé pour sa stabilité en mer et sa facilité de manœuvre, ce qui en fait un bateau adapté aussi bien aux navigateurs expérimentés qu\'aux novices. Son design bien pensé offre un agencement spacieux et fonctionnel, avec un grand salon lumineux, une cuisine équipée et des cabines confortables.\nAvec ses 4 cabines doubles et ses deux pointes avant, il peut accueillir jusqu\'à 10 personnes, ce qui en fait un choix parfait pour les familles ou les groupes d\'amis. Chaque cabine est équipée de sa propre salle de bains, offrant intimité et confort à tous les occupants.\nInfos contact : Quentin +262 6 93 13 45 87 ou + 261 32 79 308 (whats ap)',
            'chantier' => 'Lagoon',
            'architecte' => null,
            'pavillon' => 'Français (H.T)',
            'annee' => 2016,
            'materiaux' => 'Polyester',
            'longueurht' => 11.55,
            'largeur' => 6.53,
            'tirantdeau' => 1.15,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => null,
            'puissance' => 29,
            'moteur' => 'Yanmar',
            'systemeantiderive' => 'Quillerons',
            'cabines' => 4,
            'passagers' => 10,
            'published_at' => '2025-01-30T08:36:45',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Seychelles')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 33: LAGOON 40
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'LAGOON 40',
            'slug' => 'lagoon-40',
            'prix' => 290000.0,
            'afficher_prix' => true,
            'description' => 'Catamaran Lagoon 40 aux Seychelles, avec ses cabines spacieuses et ses deux pointes avant aménagées, il offre un espace confortable pour vous et vos compagnons de voyage.\nLe Lagoon 40 est réputé pour son design moderne et fonctionnel. Son aménagement intérieur bien pensé comprend des cabines confortables où vous pourrez vous reposer et vous détendre après une journée d\'exploration. Les deux pointes avant aménagées offrent un espace supplémentaire pour les invités, ce qui en fait un choix idéal pour les familles ou les groupes d\'amis.\nLe Lagoon 40 offre également une excellente performance en mer, vous permettant de naviguer en toute confiance dans les eaux des Seychelles. Son design équilibré et ses coques bien construites offrent une navigation en douceur et une stabilité remarquable.\nInfos contact : Quentin +262 6 93 13 45 87 ou +261 32 79 16 308 (whats ap)',
            'chantier' => 'Lagoon',
            'architecte' => null,
            'pavillon' => 'Français (H.T)',
            'annee' => 2019,
            'materiaux' => 'Polyester',
            'longueurht' => 11.74,
            'largeur' => 6.76,
            'tirantdeau' => 1.35,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => null,
            'puissance' => 240.0,
            'moteur' => 'Yanmar',
            'systemeantiderive' => 'Quillerons',
            'cabines' => 4,
            'passagers' => 10,
            'published_at' => '2025-01-30T08:21:28',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Seychelles')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 34: LAGOON 42
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'LAGOON 42',
            'slug' => 'lagoon-42',
            'prix' => 330000.0,
            'afficher_prix' => true,
            'description' => 'Avec 1000 unités naviguant à travers le monde, le Lagoon 42 est LE modèle de catamaran à voile le plus populaire conçu pour une croisière confortable.\nIl offre un mélange de performances, de style et d\'espaces de vie spacieux, ce qui en fait un favori parmi les passionnés de voile et les compagnies de charter.\nLe Lagoon 42 a remporté de nombreux prix : Boat Of The Year 2017, Best Boats 2017, Sailing Today Awards 2016, Asia Boating Award 2016, Meilleur voilier multicoque...\nActuellement aux Seychelles, notre catamaran a été mis à l\'eau en 2016 et est entièrement équipé pour le grand bleu !\n \nChaque élément du bateau a été soigneusement pensé :\nIl présente des lignes de coque élégantes et modernes qui améliorent ses performances de navigation et son attrait esthétique.\nL\'aménagement du pont est optimisé pour la facilité de déplacement et la sécurité. Le poste de barre, situé sur babord offre une excellente visibilité et un cockpit spacieux.\nLe cockpit est bien protégé, doté d\'un coin repas et de nombreux sièges. Il est directement connecté au carré, créant un espace de vie intérieur-extérieur homogène.\nLe carré est lumineux et aéré grâce à de grandes fenêtres offrant une vue panoramique. Il comprend un espace confortable, une table à manger et une cuisine bien équipée.\nLa cuisine dispose d\'appareils modernes, de nombreux rangements, ce qui la rend pratique pour la préparation des repas en mer.\nLe Lagoon 42 est connu pour ses excellentes performances de navigation. Il est équipé d\'un gréement puissant et d\'un plan de voilure bien équilibré, le rendant facile à manœuvrer dans diverses conditions.\nInfos contact : Quentin +262 6 93 13 45 87 ou +261 32 79 16 308 (Whats ap)',
            'chantier' => 'Lagoon',
            'architecte' => null,
            'pavillon' => 'Français (H.T)',
            'annee' => 2016,
            'materiaux' => 'Polyester',
            'longueurht' => 12.8,
            'largeur' => 7.7,
            'tirantdeau' => 1.25,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => null,
            'puissance' => 257.0,
            'moteur' => 'Yanmar',
            'systemeantiderive' => 'Quillerons',
            'cabines' => 4,
            'passagers' => 10,
            'published_at' => '2025-01-30T08:13:33',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Seychelles')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 35: DEAN 441
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'DEAN 441',
            'slug' => 'dean-441',
            'prix' => 150000.0,
            'afficher_prix' => true,
            'description' => 'Catamaran de croisière version propriétaire.\nMarin et bon marcheur le DEAN 441 offre une grande plateforme arrière, un vaste cockpit protégé, un poste de barre à demi hauteur . L\'intérieur dispose de beaucoup de volumes notamment dans la très vaste cabine propriétaire et propose une finition haut de gamme des menuiseries.\nBateau équipé grand voyage. Travaux sur les cloisons à prévoir.\nMoteurs neufs, unité à finir de refiter (électronique, et autres)\nVoiles neuves\nAFFAIRE A SAISIR VENDEUR TRES MOTIVE - Travaux réalisables aux Seychelles.\nInfos : Quentin +262 6 93 13 45 87  ou +261 32 79 16 308(whats ap)',
            'chantier' => 'DEAN CATAMARAN',
            'architecte' => 'PETER DEAN',
            'pavillon' => null,
            'annee' => 2011,
            'materiaux' => 'Sandwich / Polyester',
            'longueurht' => 13.41,
            'largeur' => 7.32,
            'tirantdeau' => 1.1,
            'poidslegeencharges' => 13000.0,
            'surfaceaupres' => 135.2,
            'heuresmoteur' => null,
            'puissance' => 552.0,
            'moteur' => 'YANMAR',
            'systemeantiderive' => null,
            'cabines' => 3,
            'passagers' => 6,
            'published_at' => '2025-01-30T06:23:32',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Prix en baisse !')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Seychelles')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 36: AZIMUT 43S
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'AZIMUT 43S',
            'slug' => 'azimut-43s',
            'prix' => 370000.0,
            'afficher_prix' => true,
            'description' => 'Cabin cruiser Azimut 43S de 2011 produit par le chantier Azimut en Italie, actuellement au ponton au Mozambique.\nL\'Azimut 43S est équipé de 2 cabines, tirant d\'eau de 1,15 mètre, il peut atteindre des vitesses allant jusqu\'à 34 nœuds avec ses deux moteurs Volvo Penta D6 IPS600 de 435cv chacuns.\nRefité récemment (design intérieur, agencement, peintures, remplacement des vaigrages, moteurs chez Volvo Portugal...) pour plus de 110 000€.\nL\'électronique de navigation est complète et en bon état, cette superbe unité est prête à naviguer, les taxes au Mozambique ont été payées (valeur 60 000€), ainsi que son convoyage pour le Mozambique.\nTarif très compétitif pour ce type d\'unité dans la zone Océan Indien.\nInfos : Quentin whats app +262 6 93 13 45 87.',
            'chantier' => 'Azimut',
            'architecte' => 'Neo design',
            'pavillon' => 'Mozambique',
            'annee' => 2011,
            'materiaux' => 'Polyester',
            'longueurht' => 13.37,
            'largeur' => 4.22,
            'tirantdeau' => 1.15,
            'poidslegeencharges' => 14500.0,
            'surfaceaupres' => null,
            'heuresmoteur' => 275.0,
            'puissance' => 435.0,
            'moteur' => '2 X Volvo Penta IPS600',
            'systemeantiderive' => null,
            'cabines' => 2,
            'passagers' => 8,
            'published_at' => '2025-01-10T05:41:45',
        ];

        $type = Type::where('libelle', 'Bateau Moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 37: Toky 12M
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'Toky 12M',
            'slug' => 'toky-12m',
            'prix' => 70000.0,
            'afficher_prix' => true,
            'description' => 'Catamaran moteur de 2020 sous pavillon malgache, entièrement refité et aménagé pour transport de passagers, excursions et croisières pour 20 personnes.\nEquipé solaire (6000€ de solaire à bord), autonome en énergie, 12V et 220V à bord, sur convertisseur victron phoenix. 2 moteurs suzuki 140 cv avec 2x 140L de réservoirs essence, GPS lowrance HDS9 et sonde 500W, 150L de réserve eau douce, très faible tirant d\'eau.\nEspace cuisine avec réfrigérateur congélateur, 3 cabines, 1 salle de bain et WC, cabines, sun deck, flybridge, nombreux rangements à bord...\nPrix sacrifié pour vente rapide, unité idéale pour investisseurs, hôtels (charter, croisières, plongées, excursions...)\nInfos et visites : Quentin whats ap +262 6 93 13 45 87 / GSM : 032 79 16 308',
            'chantier' => 'Toky Naval',
            'architecte' => null,
            'pavillon' => 'Malgache',
            'annee' => 2020,
            'materiaux' => 'Polyester',
            'longueurht' => 12.0,
            'largeur' => 5.0,
            'tirantdeau' => 0.35,
            'poidslegeencharges' => 7.0,
            'surfaceaupres' => null,
            'heuresmoteur' => null,
            'puissance' => 280,
            'moteur' => 'Suzuki',
            'systemeantiderive' => null,
            'cabines' => 3,
            'passagers' => 20,
            'published_at' => '2024-12-18T08:45:07',
        ];

        $type = Type::where('libelle', 'Catamaran à moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 38: Toky 9M50
        $bateauData = [
            'visible' => true,
            'occasion' => false,
            'modele' => 'Toky 9M50',
            'slug' => 'toky-9m50',
            'prix' => 36000.0,
            'afficher_prix' => true,
            'description' => 'Coque polyester type Toky, de 2017, sous pavillon malgache, de 9M50 de long par 2M40 de large, équipée d\'un moteur Suzuki 300CV récent, capacité 20 personnes. L\'ensemble est en bon état général, idéal pour activités touristiques et professionnelles (plongée, pêche, croisières).\nPossibilité de vente de la coque seule et du moteur.\nInfos et visite : Quentin whats ap +262 6 93 13 45 87 - gsm local : 032.79.16.308',
            'chantier' => 'Toky Naval',
            'architecte' => null,
            'pavillon' => 'Malgache',
            'annee' => 2017,
            'materiaux' => 'Polyester',
            'longueurht' => 9.5,
            'largeur' => 2.4,
            'tirantdeau' => 0.5,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => 1500.0,
            'puissance' => 300.0,
            'moteur' => 'Suzuki',
            'systemeantiderive' => null,
            'cabines' => null,
            'passagers' => 20,
            'published_at' => '2024-12-18T06:01:23',
        ];

        $type = Type::where('libelle', 'Bateau Moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 39: EDEL CAT 35 OPEN
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'EDEL CAT 35 OPEN',
            'slug' => 'edel-cat-35-open',
            'prix' => 52000.0,
            'afficher_prix' => true,
            'description' => 'Catamaran à voile Edel Cat 35, de 1989, sous pavillon français (importé à la Réunion), de 10.60M de long, équipé d\'un moteur Mercury 20CV 4 temps, en bon état général. Trois cabines double, 2 salle de bain, de nombreux rangements à bord. Cette unité disponible à la vente chez Myboat-oi, a été refité par le propriétaire, avec de nombreux travaux (coque, pont, électricité, électronique, sécurité...) listés dans l\'inventaire, régulièrement entretenu (carénage septembre 2024...), prête à naviguer.\nAutonome en énergie, avec 2X240W de panneaux, installation solaire victron de qualité, l\'edel cat 35 est parfait pour des croisières, charter, ou encore vie à bord.\nVisite et inventaire sur demande, Quentin whats ap +262 6 93 13 45 87 - Tél local : 032 79 16 308.',
            'chantier' => 'Edel Strat France',
            'architecte' => 'Maurice Edel',
            'pavillon' => 'Français',
            'annee' => 1989,
            'materiaux' => 'Polyester',
            'longueurht' => 10.6,
            'largeur' => 6.04,
            'tirantdeau' => 0.85,
            'poidslegeencharges' => 2.6,
            'surfaceaupres' => 67.0,
            'heuresmoteur' => null,
            'puissance' => 20.0,
            'moteur' => 'Mercury H.B 4 temps',
            'systemeantiderive' => 'Quilleron',
            'cabines' => 3,
            'passagers' => 8,
            'published_at' => '2024-11-06T12:22:52',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Prix en baisse !')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Réunion')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 40: DIX HARVEY 55Ft SEA TRIBE
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'DIX HARVEY 55Ft SEA TRIBE',
            'slug' => 'dix-harvey-55ft-sea-tribe',
            'prix' => 555000.0,
            'afficher_prix' => true,
            'description' => 'Catamaran DIX HARVEY 55ft construit par Sea Tribe Yachts de Durban, en Afrique du Sud, et conçu conjointement par Dudley Dix et Phil Harvey, en 2019 pour un coût de construction de 980 000€.\nCe DH 550 Cat est une trouvaille rare, entièrement équipé, prêt à naviguer, climatisé, autonome en énergie, bateau de croisière hauturier luxueux performant et de classe mondiale, avec des aménagements pour huit personnes dans quatre cabines. Idéal pour charters et croisières dans l\'océan indien. Affaire rare à saisir.\nLe DH 550 est capable d\'atteindre des vitesses de croisière beaucoup plus élevées qu\'un catamaran de série de même longueur. Comme de nombreux catamarans semi-personnalisés sud-africains, le constructeur a accordé une attention exquise aux détails à l\'intérieur. Le yacht ne manque pas non plus d\'accès, de lumière naturelle avec ses belles fenêtres de salon.\nPropriétaire sérieusement motivé à vendre.\nDossier complet, infos : Quentin whatsp : +262 6 93 13 45 87',
            'chantier' => 'Sea Tribe Yachts Durban',
            'architecte' => 'Dudley Dix et Phil Harvey',
            'pavillon' => 'Seychelles',
            'annee' => 2019,
            'materiaux' => 'Composite',
            'longueurht' => 16.76,
            'largeur' => 8.53,
            'tirantdeau' => 1.0,
            'poidslegeencharges' => 12500.0,
            'surfaceaupres' => 150.0,
            'heuresmoteur' => 1500.0,
            'puissance' => 562.0,
            'moteur' => 'Vetus',
            'systemeantiderive' => 'Ailerons fixes',
            'cabines' => 4,
            'passagers' => 8,
            'published_at' => '2024-10-25T14:09:44',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Coup de coeur')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Seychelles')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 41: CUMBERLAND 46
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'CUMBERLAND 46',
            'slug' => 'cumberland-46',
            'prix' => 350000.0,
            'afficher_prix' => true,
            'description' => 'En exclusivité chez Myboat-oi,\nCumberland 46 de 2008, bateau en parfait état de navigabilité, taxes payées.\nCe trawler est proposé en trois cabines dotées chacune d\'une salle d\'eau et de wc. la coque de bâbord reçoit l\'immense cabine de propriétaire, et celle de tribord deux doubles, dont l\'une proposant trois couchages. L\'habitabilité en mer comme à l\'escale est le point fort de ce bateau, avec un fly de 18 m2 (à 4 m au-dessus de l\'eau !) et un carré, dont la table accueille sans peine huit personnes. Le poste de pilotage intérieur est lui aussi remarquablement conçu avec sa table à carte d\'un côté et, de l\'autre, une banquette pour deux personnes, ce qui apporte au lieu une atmosphère de convivialité décidément bien pensée.\n Possibilité de visio, inventaire complet sur demande.',
            'chantier' => 'FOUNTAINE PAJOT',
            'architecte' => 'Joubert – Nivelt',
            'pavillon' => 'POLONAIS',
            'annee' => 2008,
            'materiaux' => 'FIBRE DE VERRE',
            'longueurht' => 13.95,
            'largeur' => 6.5,
            'tirantdeau' => 1.2,
            'poidslegeencharges' => 14000.0,
            'surfaceaupres' => null,
            'heuresmoteur' => 2300.0,
            'puissance' => 330.0,
            'moteur' => 'VOLVO',
            'systemeantiderive' => null,
            'cabines' => 3,
            'passagers' => 6,
            'published_at' => '2024-09-27T08:20:11',
        ];

        $type = Type::where('libelle', 'Catamaran à moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Coup de coeur')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Seychelles')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 42: Hammercat 35 Neuf
        $bateauData = [
            'visible' => true,
            'occasion' => false,
            'modele' => 'Hammercat 35 Neuf',
            'slug' => 'hammercat-35-neuf',
            'prix' => 420000.0,
            'afficher_prix' => true,
            'description' => 'Le HammerCat 35 est le premier modèle d\'une nouvelle génération de catamarans à moteur. Construit par Hammer Yachts au Cap, en Afrique du Sud, il est le premier catamaran moteur combinant un look audacieux et agressif.\nLe HammerCat 35 combine sa belle apparence et ses lignes épurées au-dessus de la ligne de flottaison avec une coque efficace et moderne, pour des performances optimales.\nNos navires sont construits en utilisant uniquement des matériaux composites époxy et du carbone fibre. Le HammerCat 35 pèse ainsi 40 % moins lourd que les bateaux équivalents au tarif de départ de 420 000€ (hors livraison devis sur demande).\nFiche technique, et liste d’options sur demande, livraison Océan Indien possible.\nWhats app Quentin +262 6 93 13 45 87',
            'chantier' => 'Hammer Yachts',
            'architecte' => 'Hammer Yachts',
            'pavillon' => 'Sud Africain',
            'annee' => 2024,
            'materiaux' => 'Composite epoxy et fibre carbone',
            'longueurht' => 10.4,
            'largeur' => 3.7,
            'tirantdeau' => null,
            'poidslegeencharges' => 4.0,
            'surfaceaupres' => null,
            'heuresmoteur' => 0.0,
            'puissance' => 350.0,
            'moteur' => 'Suzuki HP Dual Prop',
            'systemeantiderive' => null,
            'cabines' => null,
            'passagers' => 10,
            'published_at' => '2024-09-27T08:19:24',
        ];

        $type = Type::where('libelle', 'Bateau Moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 43: Beneteau Flyer 7/8/9 Neuf
        $bateauData = [
            'visible' => true,
            'occasion' => false,
            'modele' => 'Beneteau Flyer 7/8/9 Neuf',
            'slug' => 'beneteau-flyer-7-8-9-neuf',
            'prix' => 45000.0,
            'afficher_prix' => true,
            'description' => 'A la fois puissant et élégant, le Flyer revisite le day-boat sur un mode résolument\ninnovant. Inspiré des codes design de l’univers automobile, le style Flyer séduit\npar son style épuré. Le sens du détail et de la qualité s’exprime aussi bien dans le\ntravail des inox, que celui des boiseries ou des selleries. Par son exploitation\ningénieuse de la largeur de coque, chaque modèle de Flyer maximise les espaces\nde vie à bord. Place aux sensations !\nOffres à partir de 45 000€ pour un Flyer 7 prix départ Europe (hors motorisation et livraison - devis et brochure complète sur demande).\nPlusieurs modèles neufs et tailles différentes dans la gamme Flyer (infos - specs - photos - tarification sur demande).\nInfos: Quentin Whats app +262 6 93 13 45 87.',
            'chantier' => 'Beneteau',
            'architecte' => 'Beneteau Power Boats',
            'pavillon' => null,
            'annee' => 2024,
            'materiaux' => 'Polyester',
            'longueurht' => 6.41,
            'largeur' => 2.48,
            'tirantdeau' => 4.01,
            'poidslegeencharges' => 1473.0,
            'surfaceaupres' => null,
            'heuresmoteur' => null,
            'puissance' => 200.0,
            'moteur' => null,
            'systemeantiderive' => null,
            'cabines' => null,
            'passagers' => null,
            'published_at' => '2024-09-27T08:18:49',
        ];

        $type = Type::where('libelle', 'Bateau Moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Réunion')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 44: MARYLAND 37
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'MARYLAND 37',
            'slug' => 'maryland-37',
            'prix' => 160000.0,
            'afficher_prix' => true,
            'description' => 'Catamaran à moteur, type Maryland 37 de 2001, sous pavillon français taxes seychelloises réglées, expertisé 175 000€ au 1er Mai 2021, rapport disponible ainsi que l\'inventaire sur demande.\nTrès belle unité, bien entretenue et équipée, électronique de qualité, propulsée par 2 moteurs Yanmar de 125 CV. L\'ensemble du bateau a été rénové en 2016 \nConfortable à bord avec 4 cabines, 2 salles de bain, poste de pilotage, carré avec une table pour 6 personnes.\nIdéale pour les activités professionnelles de croisières, plongée, charter, pêche au gros.\nVisible aux Seychelles',
            'chantier' => 'FONTAINE PAJOT',
            'architecte' => 'Joubert-Nivelt Design',
            'pavillon' => 'FRANÇAIS',
            'annee' => 2001,
            'materiaux' => 'Polyester monolithique',
            'longueurht' => 11.15,
            'largeur' => 5.1,
            'tirantdeau' => 1.1,
            'poidslegeencharges' => 7400.0,
            'surfaceaupres' => null,
            'heuresmoteur' => 2500.0,
            'puissance' => 125.0,
            'moteur' => 'YANMAR 4JH3DTE',
            'systemeantiderive' => null,
            'cabines' => 4,
            'passagers' => 8,
            'published_at' => '2024-09-27T08:18:02',
        ];

        $type = Type::where('libelle', 'Catamaran à moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Coup de coeur')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Seychelles')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 45: LEOPARD 53
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'LEOPARD 53',
            'slug' => 'leopard-53',
            'prix' => 1222000.0,
            'afficher_prix' => true,
            'description' => 'Powercat de 2021 Leopard 53. Ce luxueux et spacieux catamaran est idéal pour la croisière en famille et le charter. Il dispose de 3 cabines doubles, dont 1 cabine propriétaire et de 3 salles de bain. Il est également équipé d\'un taud de navigation, de deux réfrigérateurs, d\'un générateur, d\'un chargeur de batterie, d\'un onduleur, d\'une prise 12V, d\'un guindeau électrique, d\'un sondeur de profondeur, d\'instruments à vent, d\'un indicateur de vitesse du registre, d\'un VHF, d\'une chaîne stéréo Bluetooth, de la climatisation, de l\'eau chaude, d\'un traceur de carte GPS, d\'une télévision LED, d\'un moteur hors-bord, d\'une annexe, d\'une douche de cockpit, de lumières de pont, de wifi et de réservoirs d\'eaux usées.\nLes mots du chantier "Construit par Robertson et Caine et conçu par les architectes navals de Simonis Voogd Design, le Leopard 53 Powercat allie confort, performance et facilité de manœuvre, offrant une expérience inégalable en grande croisière. Ce catamaran de 4ème génération présente tous les atouts qui ont fait le succès de ses prédécesseurs, tout en réinventant le concept de catamaran à moteur"\nInventaire et dossier sur demande.',
            'chantier' => 'Robertson and Caine',
            'architecte' => 'Simonis Voogd Design',
            'pavillon' => null,
            'annee' => 2021,
            'materiaux' => 'Polyester',
            'longueurht' => 16.19,
            'largeur' => 7.67,
            'tirantdeau' => 1.0,
            'poidslegeencharges' => 21.0,
            'surfaceaupres' => null,
            'heuresmoteur' => null,
            'puissance' => 370.0,
            'moteur' => 'Yanmar',
            'systemeantiderive' => null,
            'cabines' => 3,
            'passagers' => null,
            'published_at' => '2024-09-27T08:17:24',
        ];

        $type = Type::where('libelle', 'Catamaran à moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Seychelles')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 46: LEOPARD 53 2020
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'LEOPARD 53 2020',
            'slug' => 'leopard-53-2020',
            'prix' => 1270000.0,
            'afficher_prix' => true,
            'description' => 'Powercat de 2021 Leopard 53. Ce luxueux et spacieux catamaran est idéal pour la croisière en famille et le charter. Il dispose de 3 cabines doubles, dont 1 cabine propriétaire et de 3 salles de bain.\nLes mots du chantier "Construit par Robertson et Caine et conçu par les architectes navals de Simonis Voogd Design, le Leopard 53 Powercat allie confort, performance et facilité de manœuvre, offrant une expérience inégalable en grande croisière. Ce catamaran de 4ème génération présente tous les atouts qui ont fait le succès de ses prédécesseurs, tout en réinventant le concept de catamaran à moteur". Tarif TTC.\nInventaire et dossier sur demande.',
            'chantier' => 'Robertson and Caine',
            'architecte' => 'Simonis Voogd Design',
            'pavillon' => null,
            'annee' => 2020,
            'materiaux' => 'Polyester',
            'longueurht' => 16.19,
            'largeur' => 7.67,
            'tirantdeau' => 1.0,
            'poidslegeencharges' => 21.0,
            'surfaceaupres' => null,
            'heuresmoteur' => null,
            'puissance' => 370.0,
            'moteur' => 'Yanmar',
            'systemeantiderive' => null,
            'cabines' => 3,
            'passagers' => null,
            'published_at' => '2024-09-27T08:17:03',
        ];

        $type = Type::where('libelle', 'Catamaran à moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Seychelles')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 47: SESSA 43
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'SESSA 43',
            'slug' => 'sessa-43',
            'prix' => 197000.0,
            'afficher_prix' => true,
            'description' => 'Cette unité est un sports cruiser, de type Sessa C43 construit en Italie. Il a une coque en V profonde. A l’arrière se trouve une plate-forme de bain, suivie d’un bain de soleil qui peut être soulevé hydrauliquement pour accéder au garage de l’annexe et à la salle des machines.\nLa salle des machines est bien équipée, les moteurs principaux étant situés au centre du navire.\nSur le pont principal, il y a un salon à bâbord, et à côté se trouve une cuisine. À l’avant, sur le côté tribord, se trouve le poste de pilotage, équipé d’un siège de skipper rabattable et des aides à la navigation nécessaires. La zone est protégée par un toit rétractable. \nSous le pont, il y a des sièges sur le côté tribord, une autre cuisine, une cabine principale avec une salle de bains privative et une cabine d’invités avec des couchettes en « V ». Le navire a récemment fait l’objet d’importantes rénovations et de modifications. \nInventaires et infos sur demande.',
            'chantier' => 'Sessa Marine',
            'architecte' => null,
            'pavillon' => null,
            'annee' => 2010,
            'materiaux' => 'Polyester',
            'longueurht' => 13.02,
            'largeur' => 3.99,
            'tirantdeau' => 1.0,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => 1000.0,
            'puissance' => 375.0,
            'moteur' => 'Volvo Penta',
            'systemeantiderive' => null,
            'cabines' => 2,
            'passagers' => null,
            'published_at' => '2024-09-24T15:19:55',
        ];

        $type = Type::where('libelle', 'Bateau Moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Seychelles')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 48: LAGOON 46
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'LAGOON 46',
            'slug' => 'lagoon-46',
            'prix' => 800000.0,
            'afficher_prix' => true,
            'description' => 'Le Lagoon 46 est un catamaran de croisière luxueux, conçu pour offrir un confort et une performance exceptionnels en mer. Avec ses 14,02 mètres de longueur et 7,96 mètres de largeur, ce bateau offre un intérieur spacieux et élégant, ainsi que de vastes espaces extérieurs pour profiter du soleil et de la mer. Le Lagoon 46 est équipé de tout ce dont les plaisanciers ont besoin pour une croisière de courte ou longue durée, y compris une voilure performante et une motorisation puissante.\nIl comprend un moteur Yanmar de 57 ch, une grand-voile à batten complète et une gamme d\'équipements. électroniquesAvec trois cabines, chacune avec une salle de bains attenante, et un intérieur bien aménagé, il allie confort et performance.\nInfos et inventaire sur demande.',
            'chantier' => 'Lagoon',
            'architecte' => 'VPLP',
            'pavillon' => null,
            'annee' => 2021,
            'materiaux' => 'Polyester',
            'longueurht' => 14.02,
            'largeur' => 7.96,
            'tirantdeau' => 1.3,
            'poidslegeencharges' => 16.0,
            'surfaceaupres' => 141.2,
            'heuresmoteur' => null,
            'puissance' => 57.0,
            'moteur' => 'Yanmar 4jh57sd - 57ch',
            'systemeantiderive' => null,
            'cabines' => 3,
            'passagers' => null,
            'published_at' => '2024-09-24T11:27:25',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Nouveau sur le marché')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Seychelles')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 49: SUN ODYSSEY 349 Limited Edition
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'SUN ODYSSEY 349 Limited Edition',
            'slug' => 'sun-odyssey-349-limited-edition',
            'prix' => 160000.0,
            'afficher_prix' => true,
            'description' => 'Jeanneau Sun Odyssey 349 Limited Edition.\n Superbe sun odyssey 349 de 2021 en etat remarquable ,l\'interieur est parfait ,les voiles ont peu servies le moteur totalise 15 h\nl\'equilibre parfait avec une naviguation facile agréable et rapide et le volume et confort d\'un grand voilier .\nSon equipement (propulseur d\'etrave, pilote automatique ,voiles enrouleur permettent de gerer le bateau seul ou de partager la naviguation dans un cockpit genereux et convival pour des moments ensemble au mouillage ou au port merveilleux .\nTrès peu servi, nous serons tres heureux de vous le présenter, nous restons a votre disposition pour plus d\'infos, ou visio.',
            'chantier' => 'JEANNEAU',
            'architecte' => 'MARC LOMBARD',
            'pavillon' => 'MAURICIEN',
            'annee' => 2021,
            'materiaux' => 'Stratifié verre-polyester monolithique',
            'longueurht' => 9.97,
            'largeur' => 3.44,
            'tirantdeau' => 1.98,
            'poidslegeencharges' => 5340.0,
            'surfaceaupres' => null,
            'heuresmoteur' => 15.0,
            'puissance' => 115.0,
            'moteur' => 'YANMAR 21HP',
            'systemeantiderive' => null,
            'cabines' => 2,
            'passagers' => 8,
            'published_at' => '2024-09-04T09:38:02',
        ];

        $type = Type::where('libelle', 'Voilier monocoque')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Prix en baisse !')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Maurice')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 50: HUNTER 23.5
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'HUNTER 23.5',
            'slug' => 'hunter-23-5',
            'prix' => 15000.0,
            'afficher_prix' => true,
            'description' => 'Le Hunter 23.5 est un voilier américain remorquable qui a été conçu par le Hunter Design Team et construit pour la première fois en 1992.\nC’est un voilier spacieux, performant et sécuritaire.\nSa quille rétractable offre une grande polyvalence, facile à manœuvrer et à mettre à l’eau.\nSa longueur de coque est de 7,21 m soit 23.5 pieds, et sa largeur de coque de 2,3 m.\nSon tirant d’eau est de 0,5 m quille rétractée et de 1.7 m quille déployée.\n\nLe voilier, gréé en sloop avec genoa enrouleur et spi asymétrique est basé à Tamatave.\nIl vient d’être rénové intérieurement.\nÉquipé en panneaux solaires, de voiles en bon état, d’une cuisinière 4 feux neuve, d’un congélateur neuf, d’un pilote automatique, il est prêt à naviguer.\nLe carré est spacieux et le bateau peut accueillir 6 personnes en couchette (3 doubles).\nLe bateau possède une remorque permettant la mise à l’eau et la sortie de façon autonome.\nLe mât peut être gréé par deux personnes.\n\nIdéal pour les navigations sur les lacs des Pangalanes, à Sainte Marie ou Nosy-Be.\nPrix sacrifié pour vente rapide, baisse de prix de 4000€, cause changement de projet. Contact et infos : Quentin Whats app +262 6 93 13 45 87',
            'chantier' => 'HUNTER',
            'architecte' => 'H D T',
            'pavillon' => 'FRANÇAIS',
            'annee' => 1993,
            'materiaux' => 'Polyester',
            'longueurht' => 7.21,
            'largeur' => 2.3,
            'tirantdeau' => 0.5,
            'poidslegeencharges' => 880.0,
            'surfaceaupres' => null,
            'heuresmoteur' => 100.0,
            'puissance' => null,
            'moteur' => 'MARINER 5.88KVA',
            'systemeantiderive' => null,
            'cabines' => 6,
            'passagers' => null,
            'published_at' => '2024-08-13T06:15:42',
        ];

        $type = Type::where('libelle', 'Voilier monocoque')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Prix en baisse !')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 51: FIRST 211
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'FIRST 211',
            'slug' => 'first-211',
            'prix' => 15000.0,
            'afficher_prix' => true,
            'description' => 'Le voilier First 211 est un monocoque course-croisière, construit par le chantier Bénéteau en France. Ce voilier Quille relevable, gréé en Sloop fractionné, réalisé par l\'architecte naval Groupe Finot, mesure 6.2 m de long avec un tirant d\'eau maximum de 1.8 m. La production a démarré en 1999 et s\'est terminée en 2003. \nBasé a Madagascar. Prix sacrifié pour vente rapide, baisse de prix de 4000€, cause changement de projet. Contact et infos : Quentin Whats app +262 6 93 13 45 87',
            'chantier' => 'BENETEAU',
            'architecte' => null,
            'pavillon' => 'FRANÇAIS',
            'annee' => 1999,
            'materiaux' => 'Polyester',
            'longueurht' => 6.25,
            'largeur' => 2.3,
            'tirantdeau' => 0.5,
            'poidslegeencharges' => null,
            'surfaceaupres' => null,
            'heuresmoteur' => null,
            'puissance' => 6.0,
            'moteur' => 'MARINER',
            'systemeantiderive' => null,
            'cabines' => null,
            'passagers' => 4,
            'published_at' => '2024-08-13T06:12:19',
        ];

        $type = Type::where('libelle', 'Voilier monocoque')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Prix en baisse !')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 52: Beneteau Gran Turismo  40
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'Beneteau Gran Turismo  40',
            'slug' => 'beneteau-gran-turismo-40',
            'prix' => 360000.0,
            'afficher_prix' => true,
            'description' => 'Le Gran Turismo 40 régénère le concept du sport-cruiser. Né sous le crayon du talentueu duo Nuvolari et Lenard, cette unité offre autant de plaisir à l’œil que de sensations en pilotage. Un bateau d’harmonie aux intérieurs parfaitement organisés et aux finitions très soignées. \nCe yacht à moteur de 40 pieds de seconde main est une bonne opportunité pour des activités de croisières, charters d’exception au tarif de 360 000€. Avec ses 2 moteurs in-bord de 300HP, son générateur, sa climatisation, son BBQ électrique, sa plateforme de natation hydraulique, etc il dispose de tout l’équipement nécessaire pour passer un moment incroyable sur l’eau. Le bateau est disponible pour des visites et des essais en mer à Maurice. Livraison possible dans l’Océan Indien, inventaire et dossier photos sur demande, contact whats ap Quentin + 262 6 93 13 45 87',
            'chantier' => 'Beneteau',
            'architecte' => 'Beneteau Power Boats',
            'pavillon' => null,
            'annee' => 2018,
            'materiaux' => 'Polyester',
            'longueurht' => 13.0,
            'largeur' => 4.0,
            'tirantdeau' => 0.9,
            'poidslegeencharges' => 7900.0,
            'surfaceaupres' => null,
            'heuresmoteur' => 1000.0,
            'puissance' => 300.0,
            'moteur' => 'Volvo D4-300',
            'systemeantiderive' => null,
            'cabines' => 2,
            'passagers' => null,
            'published_at' => '2024-07-11T09:31:01',
        ];

        $type = Type::where('libelle', 'Bateau Moteur')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Coup de coeur')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Maurice')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 53: LAGOON 420
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'LAGOON 420',
            'slug' => 'lagoon-420',
            'prix' => 445000.0,
            'afficher_prix' => true,
            'description' => 'Le Lagoon 420 est un catamaran de croisière construit par le chantier Lagoon en France. Conçu par\nles architectes navals Van Peteghem et Lauriot Prévost, il est construit sur un sloop fendu et mesure\n12,61 mètres de long. Notre unité est de 2017, sous pavillon français.\nCe grand catamaran, idéal pour naviguer en famille ou entre amis. Sur le pont, le carré offre un\nespace généreux et une distribution optimale.\nNotre unité est disponible à la vente cette fin d’année 2024, visite en visio possible,\nQuentin +262 6 93 13 45 87 a votre disposition',
            'chantier' => 'construit par le chantier CNB',
            'architecte' => 'dessiné par VPLP',
            'pavillon' => 'FRANÇAIS',
            'annee' => 2017,
            'materiaux' => 'Sandwich / Polyester',
            'longueurht' => 12.61,
            'largeur' => 7.5,
            'tirantdeau' => 1.25,
            'poidslegeencharges' => 12170.0,
            'surfaceaupres' => 98.2,
            'heuresmoteur' => null,
            'puissance' => 257.0,
            'moteur' => 'YANMAR 4JH57',
            'systemeantiderive' => 'Sail drive',
            'cabines' => 4,
            'passagers' => 8,
            'published_at' => '2024-05-31T14:35:18',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $slogan = Action::where('libelle', 'Coup de coeur')->first();
        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Seychelles')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 54: LAGOON 470
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'LAGOON 470',
            'slug' => 'lagoon-470',
            'prix' => 220000.0,
            'afficher_prix' => true,
            'description' => 'le Lagoon 470 offre un cran supérieur de confort et d\'espace, des atouts sensibles pour qui aime l\'intimité des cabines ou la convivialité du carré, le volume dans les cabinets de toilettes ou la fonctionnalité dans la cuisine, la possibilité de déjeuner en plein air ...\n4 cabines double , 4 cabinets toilette / WC\nA venir découvrir a Madagascar , Quentin est sur place pour plus de photos ou vidéo .',
            'chantier' => 'LAGOON',
            'architecte' => 'VPLP = Van Peteghem – Lauriot Prévost.',
            'pavillon' => 'Malgache',
            'annee' => 2003,
            'materiaux' => 'Polyester',
            'longueurht' => 14.7,
            'largeur' => 7.9,
            'tirantdeau' => 1.4,
            'poidslegeencharges' => 9611500.0,
            'surfaceaupres' => null,
            'heuresmoteur' => null,
            'puissance' => 255.0,
            'moteur' => 'YANMAR',
            'systemeantiderive' => null,
            'cabines' => 4,
            'passagers' => 8,
            'published_at' => '2024-02-06T15:31:15',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Madagascar')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        // Bateau 55: DRAGONFLY 28
        $bateauData = [
            'visible' => true,
            'occasion' => true,
            'modele' => 'DRAGONFLY 28',
            'slug' => 'dragonfly-28',
            'prix' => 145000.0,
            'afficher_prix' => true,
            'description' => 'Ce trimaran de 2012 léger et repliable, en excellent état, visible à la Réunion, idéal pour des navigations\ndans l’Océan Indien, et particulièrement sur Madagascar et Mayotte avec son faible tirant d’eau. De\nnombreux travaux récents, un entretien optimal font de ce Dragonfly 28 une belle unité à saisir chez\nMyBoat. Plus d\'infos : Quentin : 0693134587',
            'chantier' => 'DRAGONFLY',
            'architecte' => null,
            'pavillon' => 'FRANÇAIS',
            'annee' => 2012,
            'materiaux' => 'Polyester',
            'longueurht' => 8.75,
            'largeur' => 6.5,
            'tirantdeau' => 4.02,
            'poidslegeencharges' => 21002850.0,
            'surfaceaupres' => 53.2,
            'heuresmoteur' => 220.0,
            'puissance' => 15.0,
            'moteur' => 'HB HONDA',
            'systemeantiderive' => null,
            'cabines' => 2,
            'passagers' => 7,
            'published_at' => '2022-02-17T09:07:44',
        ];

        $type = Type::where('libelle', 'Catamaran à voile')->first();
        $bateauData['type_id'] = $type ? $type->id : null;

        $bateau = Bateau::updateOrCreate(
            ['slug' => $bateauData['slug']],
            $bateauData
        );

        // Assigner la zone (première du tableau)
        $zone = Zone::where('libelle', 'Réunion')->first();
        if ($zone) {
            $bateau->zone_id = $zone->id;
            $bateau->save();
        }

        echo "  ✓ {$bateau->modele} ({$bateau->slug})\n";

        echo "\n✅ " . 55 . " bateaux importés avec succès!\n";
    }
}
