<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleNosBySeeder extends Seeder
{
    public function run(): void
    {
        $content = <<<'HTML'
<p>Vous venez d'acquérir un bateau à Nosy Bé, ou vous êtes sur place pour une visite — l'aéroport international de Fascène (code IATA : NOS) est votre porte d'entrée dans l'île. Ce guide logistique est fait pour les plaisanciers : pas de conseil touristique généraliste, uniquement ce qui compte pour passer de la piste à votre cockpit sans mauvaise surprise.</p>

<h2>L'aéroport de Fascène — ce qu'il faut savoir dès l'atterrissage</h2>

<p>L'aéroport de Nosy Bé est un terminal international de taille modeste. Il accueille principalement les vols <strong>Air Austral</strong> et <strong>Corsair</strong> depuis La Réunion et Paris, ainsi que des charters saisonniers. Le terminal dispose d'un bureau de change, mais les taux y sont défavorables — mieux vaut embarquer avec des euros ou des dollars.</p>

<p><strong>Checklist à l'atterrissage :</strong></p>
<ul>
    <li>Visa : obtention à l'arrivée pour les ressortissants français et européens (~53 €)</li>
    <li>Monnaie : l'ariary malgache (MGA) — 1 € ≈ 4 900 MGA ; le dollar est aussi largement accepté</li>
    <li>Bagages : carrousel unique, prévoir 20 à 30 minutes avant de sortir</li>
    <li>Connectivité : SIM locale disponible à la sortie (opérateur Telma), 4G en zone urbaine</li>
</ul>

<h2>De Fascène à la marina : le point sur les transports</h2>

<p>C'est ici que la plupart des plaisanciers se font surprendre. <strong>Il n'y a pas de taxi officiel à compteur à Nosy Bé.</strong> Les prix se négocient à la sortie du terminal — avec plusieurs sacs à dos, du matériel de rechange et éventuellement des voiles sous le bras, l'affaire peut vite devenir épuisante après un vol tôt le matin depuis La Réunion.</p>

<p><strong>Les options disponibles :</strong></p>

<ul>
    <li><strong>Taxi local</strong> — disponible à la sortie, tarifs non officiels. Comptez 80 000 à 120 000 MGA selon la destination et votre degré de fatigue post-vol.</li>
    <li><strong>Transfert organisé par le chantier ou l'hôtel</strong> — si vous êtes attendu sur place, confirmez 48h à l'avance. C'est souvent gratuit ou inclus.</li>
    <li><strong>Transfert privé réservé à l'avance</strong> — l'option la plus confortable pour les plaisanciers chargés. Des services comme <a href="https://zaavy.mg/transferts">Zaavy</a> permettent de réserver un <strong>transfert privé depuis l'aéroport de Fascène</strong> avant même d'embarquer : chauffeur avec panneau à l'arrivée, prix annoncé, zéro négociation à l'atterrissage.</li>
</ul>

<blockquote>
    <p>Conseil pratique : si vous arrivez en haute saison (juillet–décembre), les taxis de l'aéroport peuvent être pris d'assaut sur les vols du matin. Réserver à l'avance vous évite 30 minutes de tractation en plein soleil avec vos bagages.</p>
</blockquote>

<h2>Les zones nautiques de Nosy Bé</h2>

<p>Une fois sorti de l'aéroport, voici les zones qui intéressent les plaisanciers :</p>

<h3>Hell-Ville (Andoany) — 12 km de Fascène</h3>
<p>C'est le port principal de l'île et le cœur du marché nautique malgache. Les passages hauturiers y transitent régulièrement entre deux saisons, et c'est souvent là que les meilleures occasions se libèrent. Le quai des yachts se trouve face à l'hôtel de ville. Avitaillement en gasoil possible au port, tirant d'eau limité.</p>

<h3>Ambatoloaka / Madirokely — 18 km de Fascène</h3>
<p>Zone touristique animée avec plusieurs mouillages forains. Pratique pour les escales courtes, moins adapté pour les séjours longue durée bateau. Commerces, restaurants, pharmacie à proximité.</p>

<h3>Dzamandzar — 22 km de Fascène</h3>
<p>Mouillage calme, peu fréquenté. Idéal pour les plaisanciers qui attendent une fenêtre météo ou une pièce de rechange commandée de Métropole.</p>

<h3>Andilana — 32 km de Fascène</h3>
<p>Pointe nord de l'île, mouillage ouvert mais superbe. Base de départ naturelle pour les croisières vers les îles du nord : Nosy Iranja, Nosy Sakatia, Nosy Mitsio.</p>

<h2>Services nautiques disponibles sur place</h2>

<p>Nosy Bé dispose de plusieurs chantiers navals opérationnels, principalement concentrés à Hell-Ville. Les prestations y sont significativement moins chères qu'à La Réunion ou en Europe, avec des compétences solides sur les coques polyester et bois.</p>

<ul>
    <li><strong>Pièces détachées</strong> : anticiper les commandes depuis La Réunion ou la Métropole pour les marques spécifiques — les délais de livraison à Madagascar restent imprévisibles</li>
    <li><strong>Voilerie</strong> : présente sur place, délais raisonnables pour les réparations courantes</li>
    <li><strong>Gasoil</strong> : disponible à Hell-Ville (quai), en bidon dans les autres zones</li>
    <li><strong>Eau douce</strong> : à Hell-Ville, prévoir un filtre ou des pastilles en complément</li>
</ul>

<h2>Naviguer depuis Nosy Bé : les routes à ne pas manquer</h2>

<p>La position de Nosy Bé — à l'angle nord-ouest de Madagascar — en fait une base de départ idéale pour plusieurs croisières régionales :</p>

<ul>
    <li><strong>Les îles environnantes</strong> : Nosy Komba (lémuriens noirs), Nosy Tanikely (réserve marine, tortues), Nosy Sakatia (hippocampes pygmées) — navigations d'une journée</li>
    <li><strong>Le nord de Madagascar</strong> : cap Diégo-Suarez et la baie d'Antsiranana, une des plus grandes baies naturelles du monde — 200 nm, prévoir 4 à 5 jours</li>
    <li><strong>Les Comores</strong> : Mayotte à 220 nm, Grande Comore à 250 nm — croisière régionale faisable en saison favorable (avril–mai, octobre–novembre)</li>
</ul>

<hr>

<p>Vous cherchez un bateau à vendre à Nosy Bé ou dans le reste de Madagascar ? Consultez nos annonces actuelles — voiliers d'occasion, catamarans de charter et bateaux à moteur régulièrement disponibles à des prix inférieurs aux marchés européens.</p>
HTML;

        Article::create([
            'title'        => 'De l\'aéroport de Fascène à la marina : guide pratique du plaisancier à Nosy Bé',
            'slug'         => 'de-l-aeroport-de-fascene-a-la-marina-guide-pratique-du-plaisancier-a-nosy-be',
            'content'      => $content,
            'status'       => 'published',
            'user_id'      => 1,
            'published_at' => now(),
        ]);

        $this->command->info('Article Nosy Bé créé avec succès.');
        $this->command->info('Slug : de-l-aeroport-de-fascene-a-la-marina-guide-pratique-du-plaisancier-a-nosy-be');
    }
}
