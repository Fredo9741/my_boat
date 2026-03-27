<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleNosyBeSeeder extends Seeder
{
    public function run(): void
    {
        Article::updateOrCreate(
            ['slug' => 'acheter-bateau-nosy-be-guide-complet'],
            [
                'title'        => 'Acheter un bateau à Nosy Bé : guide complet pour naviguer dans l\'Océan Indien',
                'slug'         => 'acheter-bateau-nosy-be-guide-complet',
                'status'       => 'published',
                'published_at' => now(),
                'content'      => <<<'HTML'
<p>Nosy Bé, surnommée l'île aux parfums, est bien plus qu'une destination touristique de rêve : c'est l'un des marchés nautiques les plus actifs de l'Océan Indien. Que vous souhaitiez acheter un bateau à Nosy Bé pour la plaisance, la pêche sportive ou l'activité charter, ce guide vous donne toutes les clés pour réussir votre acquisition.</p>

<h2>Pourquoi acheter un bateau à Nosy Bé ?</h2>

<p>Nosy Bé bénéficie d'une position géographique exceptionnelle dans le nord-ouest de Madagascar. Ses eaux cristallines, ses alizés réguliers et son archipel d'îles sauvages en font un terrain de navigation idéal. Acheter un bateau à Nosy Bé, c'est accéder à :</p>

<ul>
  <li><strong>Un mouillage protégé toute l'année</strong> dans la baie d'Ankify et le port de Hell-Ville</li>
  <li><strong>Des services nautiques compétents</strong> : chantiers navals, mécaniciens, voileries</li>
  <li><strong>Un marché d'occasion actif</strong> avec des bateaux à des prix compétitifs face à l'Europe</li>
  <li><strong>Un accès direct aux Comores, aux Seychelles et à la côte est africaine</strong></li>
  <li><strong>Une fiscalité avantageuse</strong> pour les résidents et les bateaux immatriculés à Madagascar</li>
</ul>

<h2>Quels types de bateaux trouve-t-on à Nosy Bé ?</h2>

<p>Le marché de Nosy Bé est varié. On y trouve aussi bien des embarcations locales que des voiliers de passage en tour du monde cherchant à revendre avant de rentrer en Europe.</p>

<h3>Les voiliers</h3>
<p>Les voiliers constituent la majorité des annonces de vente bateau à Nosy Bé. Monocoques et catamarans de 30 à 50 pieds sont fréquents, souvent à des prix inférieurs de 20 à 40 % par rapport au marché européen. Les marques Bénéteau, Jeanneau, Lagoon et Catana sont bien représentées.</p>

<h3>Les bateaux à moteur</h3>
<p>Vedettes rapides, semi-rigides et barques de pêche constituent l'autre grande famille du marché local. Ces embarcations sont très prisées pour les activités charter, la pêche au gros et les transfers inter-îles vers Nosy Komba, Nosy Iranja ou Nosy Tanikely.</p>

<h3>Les catamarans de luxe</h3>
<p>Un segment en pleine croissance : les catamarans de charter haut de gamme. Avec l'essor du tourisme nautique à Nosy Bé, plusieurs propriétaires cherchent à céder leur unité pour renouveler leur flotte. C'est une opportunité réelle pour un investisseur.</p>

<h2>Où acheter un bateau à Nosy Bé ?</h2>

<p>Plusieurs circuits existent pour trouver un bateau à vendre à Nosy Bé :</p>

<ul>
  <li><strong>Les plateformes de petites annonces spécialisées</strong> comme MyBoat, qui référence les bateaux disponibles dans tout l'Océan Indien et à Nosy Bé en particulier</li>
  <li><strong>Les chantiers navals locaux</strong> : plusieurs chantiers à Hell-Ville proposent des bateaux de construction locale, reconnus pour leur robustesse dans des eaux tropicales</li>
  <li><strong>Les marinas et mouillages</strong> : une visite au port de Hell-Ville ou dans les mouillages de Cratère et d'Ambatoloaka permet souvent de trouver des vendeurs directs</li>
  <li><strong>Les groupes de la communauté expatriée</strong> sur les réseaux sociaux, très actifs à Nosy Bé</li>
</ul>

<h2>Les points de vigilance avant d'acheter</h2>

<p>Acheter un bateau à Nosy Bé demande quelques précautions spécifiques au contexte malgache :</p>

<h3>Le contrôle technique</h3>
<p>Faites systématiquement appel à un expert maritime indépendant. Le climat tropical (humidité, UV, eau salée chaude) accélère la dégradation des coques en polyester et des équipements électroniques. Osmose, corrosion des accastillages et état du gréement sont à vérifier impérativement.</p>

<h3>Les formalités administratives</h3>
<p>L'immatriculation d'un bateau à Madagascar est gérée par les services des Affaires Maritimes de Nosy Bé. Prévoyez un délai de 4 à 8 semaines pour les démarches. Un courtier maritime local peut vous accompagner dans ces formalités.</p>

<h3>Le régime douanier</h3>
<p>Si vous achetez un bateau déjà en régime d'admission temporaire à Madagascar, renseignez-vous sur les droits de douane applicables en cas de changement de propriétaire. Cette étape est souvent sous-estimée par les acheteurs étrangers.</p>

<h2>Quel budget prévoir ?</h2>

<p>Le marché de Nosy Bé offre des bateaux dans une large fourchette de prix :</p>

<ul>
  <li><strong>Barques et semi-rigides locaux</strong> : à partir de 3 000 €</li>
  <li><strong>Voiliers monocoques d'occasion (30-38 pieds)</strong> : entre 15 000 et 60 000 €</li>
  <li><strong>Catamarans d'occasion (40-50 pieds)</strong> : entre 80 000 et 250 000 €</li>
  <li><strong>Bateaux à moteur (vedettes, open)</strong> : entre 20 000 et 120 000 €</li>
</ul>

<p>Ces prix restent attractifs comparés aux marchés méditerranéens ou antillais pour des bateaux de même niveau. L'entretien annuel est également moins coûteux qu'en Europe, les chantiers locaux pratiquant des tarifs très compétitifs.</p>

<h2>Vendre son bateau à Nosy Bé</h2>

<p>Vous êtes propriétaire d'un bateau à Nosy Bé et souhaitez le vendre ? Le marché local est porteur. Les acheteurs potentiels sont nombreux : nouveaux résidents expatriés, opérateurs charter en développement, plaisanciers en tour du monde à la recherche d'une belle occasion avant de rentrer.</p>

<p>Pour maximiser vos chances de vente rapide, pensez à :</p>

<ul>
  <li>Publier des photos de qualité, prises par beau temps avec le bateau à flot</li>
  <li>Fournir un inventaire complet et à jour de l'équipement</li>
  <li>Proposer une expertise récente pour rassurer les acheteurs</li>
  <li>Indiquer clairement le statut administratif du bateau (pavillon, immatriculation, admission temporaire)</li>
</ul>

<h2>MyBoat : votre partenaire pour acheter ou vendre à Nosy Bé</h2>

<p>MyBoat est la première plateforme spécialisée dans la vente de bateaux dans l'Océan Indien. Basés à La Réunion avec une présence active à Nosy Bé, Madagascar, Maurice et Mayotte, nous vous accompagnons dans toutes les étapes de votre projet nautique.</p>

<p>Consultez dès maintenant nos <a href="/bateaux?zone=nosy-be"><strong>annonces de bateaux à vendre à Nosy Bé</strong></a> ou parcourez l'ensemble des <a href="/bateaux?zone=madagascar"><strong>bateaux disponibles à Madagascar</strong></a>. Que vous soyez acheteur ou vendeur, notre équipe est à votre disposition pour vous guider.</p>

<p>Vous souhaitez vendre votre bateau ? <a href="/vendre"><strong>Demandez une estimation gratuite</strong></a> ou <a href="/fiche-bateau"><strong>déposez votre annonce</strong></a> directement en ligne.</p>
HTML,
            ]
        );
    }
}
