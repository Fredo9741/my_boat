@extends('layouts.app')

@section('title', 'Politique de Confidentialité - My Boat')

@section('content')

<div class="bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-gray-800">Politique de Confidentialité</h1>
    </div>
</div>

<x-breadcrumb :items="[
    ['label' => 'Accueil', 'url' => route('home')],
    ['label' => 'Confidentialité', 'url' => '#']
]" />

<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">

        <div class="prose prose-lg max-w-none space-y-8">

            <section>
                <p class="text-lg text-gray-700">
                    My Boat s'engage à protéger la confidentialité et la sécurité de vos données personnelles.
                    Cette politique explique comment nous collectons, utilisons et protégeons vos informations.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">1. Responsable du Traitement</h2>
                <p><strong>Raison sociale :</strong> My Boat</p>
                <p><strong>Adresse :</strong> Port de Saint-Gilles, 97434 La Réunion</p>
                <p><strong>Email :</strong> contact@myboat.re</p>
                <p><strong>Téléphone :</strong> +262 692 XX XX XX</p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">2. Données Collectées</h2>
                <p>Nous collectons les données personnelles suivantes :</p>

                <h3 class="text-xl font-bold text-gray-700 mb-2 mt-4">2.1 Données d'Identité</h3>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Nom et prénom</li>
                    <li>Adresse postale</li>
                    <li>Numéro de téléphone</li>
                    <li>Adresse email</li>
                </ul>

                <h3 class="text-xl font-bold text-gray-700 mb-2 mt-4">2.2 Données de Navigation</h3>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Adresse IP</li>
                    <li>Type de navigateur</li>
                    <li>Pages visitées</li>
                    <li>Durée de visite</li>
                    <li>Cookies et traceurs</li>
                </ul>

                <h3 class="text-xl font-bold text-gray-700 mb-2 mt-4">2.3 Données Transactionnelles</h3>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Informations sur le bateau (pour vendeurs)</li>
                    <li>Critères de recherche (pour acheteurs)</li>
                    <li>Historique des communications</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">3. Finalités du Traitement</h2>
                <p>Vos données personnelles sont collectées pour :</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Gérer votre compte client</li>
                    <li>Traiter vos demandes (achat, vente, estimation)</li>
                    <li>Vous envoyer des informations sur nos services</li>
                    <li>Améliorer notre site web et nos services</li>
                    <li>Respecter nos obligations légales</li>
                    <li>Prévenir la fraude et garantir la sécurité</li>
                    <li>Réaliser des statistiques et analyses</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">4. Base Légale du Traitement</h2>
                <p>Nous traitons vos données personnelles sur la base de :</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li><strong>Exécution du contrat :</strong> pour la gestion de votre mandat de vente ou d'achat</li>
                    <li><strong>Consentement :</strong> pour l'envoi de communications marketing (newsletters, offres)</li>
                    <li><strong>Intérêt légitime :</strong> pour améliorer nos services et assurer la sécurité du site</li>
                    <li><strong>Obligation légale :</strong> pour respecter nos obligations fiscales et comptables</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">5. Destinataires des Données</h2>
                <p>Vos données personnelles peuvent être partagées avec :</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Les acheteurs potentiels (pour les vendeurs) et vice versa</li>
                    <li>Nos prestataires de services (hébergement, emailing, photographes)</li>
                    <li>Les autorités légales si requis par la loi</li>
                    <li>Nos partenaires commerciaux (avec votre consentement)</li>
                </ul>
                <p class="mt-4">
                    Nous ne vendons jamais vos données personnelles à des tiers à des fins commerciales.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">6. Durée de Conservation</h2>
                <ul class="list-disc pl-6 space-y-2">
                    <li><strong>Données clients actifs :</strong> pendant la durée de la relation commerciale + 3 ans</li>
                    <li><strong>Données prospects :</strong> 3 ans à compter du dernier contact</li>
                    <li><strong>Données comptables :</strong> 10 ans (obligation légale)</li>
                    <li><strong>Cookies :</strong> 13 mois maximum</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">7. Vos Droits</h2>
                <p>Conformément au RGPD, vous disposez des droits suivants :</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li><strong>Droit d'accès :</strong> obtenir une copie de vos données personnelles</li>
                    <li><strong>Droit de rectification :</strong> corriger vos données inexactes ou incomplètes</li>
                    <li><strong>Droit à l'effacement :</strong> supprimer vos données dans certains cas</li>
                    <li><strong>Droit à la limitation :</strong> limiter le traitement de vos données</li>
                    <li><strong>Droit à la portabilité :</strong> recevoir vos données dans un format structuré</li>
                    <li><strong>Droit d'opposition :</strong> vous opposer au traitement de vos données</li>
                    <li><strong>Droit de retirer votre consentement :</strong> à tout moment</li>
                </ul>

                <p class="mt-4">
                    Pour exercer vos droits, contactez-nous à :
                    <a href="mailto:contact@myboat.re" class="text-blue-600 hover:underline">contact@myboat.re</a>
                </p>

                <p class="mt-2">
                    Vous disposez également du droit d'introduire une réclamation auprès de la CNIL
                    (<a href="https://www.cnil.fr" target="_blank" class="text-blue-600 hover:underline">www.cnil.fr</a>).
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">8. Sécurité des Données</h2>
                <p>Nous mettons en œuvre les mesures techniques et organisationnelles appropriées pour protéger vos données :</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Chiffrement des données sensibles (SSL/TLS)</li>
                    <li>Accès restreint aux données personnelles</li>
                    <li>Sauvegardes régulières</li>
                    <li>Surveillance et audits de sécurité</li>
                    <li>Formation du personnel à la protection des données</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">9. Cookies</h2>
                <p>Notre site utilise des cookies pour :</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li><strong>Cookies essentiels :</strong> nécessaires au fonctionnement du site</li>
                    <li><strong>Cookies de performance :</strong> mesurer l'audience (Google Analytics)</li>
                    <li><strong>Cookies fonctionnels :</strong> mémoriser vos préférences</li>
                    <li><strong>Cookies marketing :</strong> personnaliser la publicité (avec votre consentement)</li>
                </ul>

                <p class="mt-4">
                    Vous pouvez gérer vos préférences de cookies à tout moment via les paramètres de votre navigateur.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">10. Transfert de Données Hors UE</h2>
                <p>
                    Vos données personnelles sont hébergées au sein de l'Union Européenne.
                    Si nous devons transférer vos données hors UE, nous nous assurerons qu'elles bénéficient d'une protection adéquate
                    conformément au RGPD.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">11. Modification de la Politique</h2>
                <p>
                    Nous nous réservons le droit de modifier cette politique de confidentialité à tout moment.
                    Les modifications seront publiées sur cette page avec une nouvelle date de mise à jour.
                </p>
                <p class="mt-2">
                    Nous vous encourageons à consulter régulièrement cette page pour rester informé de nos pratiques.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">12. Contact</h2>
                <p>
                    Pour toute question concernant cette politique de confidentialité ou le traitement de vos données personnelles :
                </p>
                <div class="bg-blue-50 p-6 rounded-lg mt-4">
                    <p><strong>Email :</strong> <a href="mailto:contact@myboat.re" class="text-blue-600 hover:underline">contact@myboat.re</a></p>
                    <p><strong>Téléphone :</strong> +262 692 XX XX XX</p>
                    <p><strong>Courrier :</strong> My Boat - Port de Saint-Gilles, 97434 La Réunion</p>
                </div>
            </section>

            <section class="bg-green-50 p-6 rounded-lg mt-8">
                <p class="text-sm text-gray-600">
                    <i class="fas fa-shield-alt text-green-600 mr-2"></i>
                    <strong>Dernière mise à jour :</strong> {{ date('d/m/Y') }}
                </p>
                <p class="text-sm text-gray-600 mt-2">
                    Cette politique est conforme au Règlement Général sur la Protection des Données (RGPD)
                    et à la loi Informatique et Libertés.
                </p>
            </section>

        </div>
    </div>
</div>

@endsection
