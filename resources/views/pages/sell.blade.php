@extends('layouts.app')

@section('title', 'Vendre Mon Bateau - My Boat | Courtage Maritime')
@section('description', 'Confiez la vente de votre bateau à My Boat. Service professionnel, estimation gratuite, photos pro et accompagnement personnalisé dans l\'océan Indien.')

@section('content')

<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">Vendez Votre Bateau</h1>
            <p class="text-xl md:text-2xl text-blue-100 mb-8">
                Profitez de notre expertise pour une vente rapide et au meilleur prix
            </p>
            <a href="#formulaire" class="inline-block bg-white text-blue-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-blue-50 transition shadow-xl">
                <i class="fas fa-rocket mr-2"></i>
                Estimation Gratuite
            </a>
        </div>
    </div>
</div>

<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'Accueil', 'url' => route('home')],
    ['label' => 'Vendre mon bateau', 'url' => '#']
]" />

<div class="container mx-auto px-4 py-12">

    <!-- Avantages -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
            Pourquoi Vendre avec My Boat ?
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-euro-sign text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Estimation Gratuite</h3>
                <p class="text-gray-600 text-sm">
                    Expertise professionnelle gratuite pour connaître la valeur réelle de votre bateau
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-camera text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Photos Professionnelles</h3>
                <p class="text-gray-600 text-sm">
                    Reportage photo et vidéo de qualité pour valoriser votre bateau
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bullhorn text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Large Diffusion</h3>
                <p class="text-gray-600 text-sm">
                    Visibilité maximale sur 3 îles de l'océan Indien
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition text-center">
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-handshake text-orange-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Accompagnement 100%</h3>
                <p class="text-gray-600 text-sm">
                    Conseiller dédié de l'annonce jusqu'à la signature
                </p>
            </div>
        </div>
    </div>

    <!-- Process en 4 Étapes -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
            Comment Ça Marche ?
        </h2>
        <div class="max-w-4xl mx-auto">
            <div class="space-y-6">
                <!-- Étape 1 -->
                <div class="flex items-start bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                    <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-xl flex-shrink-0 mr-6">
                        1
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Demande d'Estimation</h3>
                        <p class="text-gray-600">
                            Remplissez notre formulaire en ligne avec les informations de votre bateau. Nous vous recontactons sous 24h pour organiser une visite.
                        </p>
                    </div>
                </div>

                <!-- Étape 2 -->
                <div class="flex items-start bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                    <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-xl flex-shrink-0 mr-6">
                        2
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Expertise et Estimation</h3>
                        <p class="text-gray-600">
                            Un expert maritime se déplace pour inspecter votre bateau et vous proposer une estimation réaliste basée sur le marché actuel.
                        </p>
                    </div>
                </div>

                <!-- Étape 3 -->
                <div class="flex items-start bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                    <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-xl flex-shrink-0 mr-6">
                        3
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Création de l'Annonce</h3>
                        <p class="text-gray-600">
                            Nous réalisons les photos et vidéos professionnelles, rédigeons une description attractive et publions votre annonce sur notre plateforme.
                        </p>
                    </div>
                </div>

                <!-- Étape 4 -->
                <div class="flex items-start bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                    <div class="w-12 h-12 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-xl flex-shrink-0 mr-6">
                        4
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Vente et Formalités</h3>
                        <p class="text-gray-600">
                            Nous organisons les visites, négocions pour vous et gérons toutes les formalités administratives jusqu'à la signature de l'acte de vente.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Nos Services Vendeur -->
    <div class="mb-16 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl p-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
            Nos Services Vendeur
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 text-xl mr-3 mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-800">Estimation gratuite et sans engagement</h4>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 text-xl mr-3 mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-800">Reportage photo et vidéo professionnel</h4>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 text-xl mr-3 mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-800">Diffusion multi-canaux optimisée</h4>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 text-xl mr-3 mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-800">Gestion des visites et pré-qualification</h4>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 text-xl mr-3 mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-800">Négociation et conseil tarifaire</h4>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 text-xl mr-3 mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-800">Accompagnement juridique et administratif</h4>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 text-xl mr-3 mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-800">Suivi post-vente et conseils</h4>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 text-xl mr-3 mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-800">Commission transparente et compétitive</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire d'Estimation -->
    <div id="formulaire" class="mb-16">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-2xl p-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Demande d'Estimation Gratuite</h2>
                    <p class="text-gray-600">Remplissez ce formulaire et recevez une estimation sous 24h</p>
                </div>

                @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <p class="text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="sujet" value="estimation">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nom complet <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nom" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Téléphone <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="telephone" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Type de bateau
                            </label>
                            <select name="type_bateau"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionnez</option>
                                <option value="Voilier">Voilier</option>
                                <option value="Catamaran">Catamaran</option>
                                <option value="Yacht à moteur">Yacht à moteur</option>
                                <option value="Semi-rigide">Semi-rigide</option>
                                <option value="Bateau de pêche">Bateau de pêche</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Marque / Chantier
                            </label>
                            <input type="text" name="marque"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Modèle
                            </label>
                            <input type="text" name="modele"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Année
                            </label>
                            <input type="number" name="annee" min="1950" max="{{ date('Y') + 1 }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Longueur (m)
                            </label>
                            <input type="number" name="longueur" step="0.01"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Pays
                            </label>
                            <select name="localisation"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionnez un pays</option>
                                <optgroup label="Océan Indien (Priorité)">
                                    <option value="La Réunion">La Réunion</option>
                                    <option value="Maurice">Maurice</option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="Mayotte">Mayotte</option>
                                    <option value="Seychelles">Seychelles</option>
                                    <option value="Comores">Comores</option>
                                </optgroup>
                                <optgroup label="Tous les pays">
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Afrique du Sud">Afrique du Sud</option>
                                    <option value="Albanie">Albanie</option>
                                    <option value="Algérie">Algérie</option>
                                    <option value="Allemagne">Allemagne</option>
                                    <option value="Andorre">Andorre</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Antigua-et-Barbuda">Antigua-et-Barbuda</option>
                                    <option value="Arabie Saoudite">Arabie Saoudite</option>
                                    <option value="Argentine">Argentine</option>
                                    <option value="Arménie">Arménie</option>
                                    <option value="Australie">Australie</option>
                                    <option value="Autriche">Autriche</option>
                                    <option value="Azerbaïdjan">Azerbaïdjan</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahreïn">Bahreïn</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbade">Barbade</option>
                                    <option value="Belgique">Belgique</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Bénin">Bénin</option>
                                    <option value="Bhoutan">Bhoutan</option>
                                    <option value="Biélorussie">Biélorussie</option>
                                    <option value="Birmanie">Birmanie</option>
                                    <option value="Bolivie">Bolivie</option>
                                    <option value="Bosnie-Herzégovine">Bosnie-Herzégovine</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Brésil">Brésil</option>
                                    <option value="Brunei">Brunei</option>
                                    <option value="Bulgarie">Bulgarie</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cambodge">Cambodge</option>
                                    <option value="Cameroun">Cameroun</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Cap-Vert">Cap-Vert</option>
                                    <option value="Chili">Chili</option>
                                    <option value="Chine">Chine</option>
                                    <option value="Chypre">Chypre</option>
                                    <option value="Colombie">Colombie</option>
                                    <option value="Congo">Congo</option>
                                    <option value="Corée du Nord">Corée du Nord</option>
                                    <option value="Corée du Sud">Corée du Sud</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                    <option value="Croatie">Croatie</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Danemark">Danemark</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominique">Dominique</option>
                                    <option value="Égypte">Égypte</option>
                                    <option value="Émirats arabes unis">Émirats arabes unis</option>
                                    <option value="Équateur">Équateur</option>
                                    <option value="Érythrée">Érythrée</option>
                                    <option value="Espagne">Espagne</option>
                                    <option value="Estonie">Estonie</option>
                                    <option value="Eswatini">Eswatini</option>
                                    <option value="États-Unis">États-Unis</option>
                                    <option value="Éthiopie">Éthiopie</option>
                                    <option value="Fidji">Fidji</option>
                                    <option value="Finlande">Finlande</option>
                                    <option value="France">France</option>
                                    <option value="Gabon">Gabon</option>
                                    <option value="Gambie">Gambie</option>
                                    <option value="Géorgie">Géorgie</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Grèce">Grèce</option>
                                    <option value="Grenade">Grenade</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guinée">Guinée</option>
                                    <option value="Guinée équatoriale">Guinée équatoriale</option>
                                    <option value="Guinée-Bissau">Guinée-Bissau</option>
                                    <option value="Guyana">Guyana</option>
                                    <option value="Haïti">Haïti</option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hongrie">Hongrie</option>
                                    <option value="Inde">Inde</option>
                                    <option value="Indonésie">Indonésie</option>
                                    <option value="Irak">Irak</option>
                                    <option value="Iran">Iran</option>
                                    <option value="Irlande">Irlande</option>
                                    <option value="Islande">Islande</option>
                                    <option value="Israël">Israël</option>
                                    <option value="Italie">Italie</option>
                                    <option value="Jamaïque">Jamaïque</option>
                                    <option value="Japon">Japon</option>
                                    <option value="Jordanie">Jordanie</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kirghizistan">Kirghizistan</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="Koweït">Koweït</option>
                                    <option value="Laos">Laos</option>
                                    <option value="Lesotho">Lesotho</option>
                                    <option value="Lettonie">Lettonie</option>
                                    <option value="Liban">Liban</option>
                                    <option value="Liberia">Liberia</option>
                                    <option value="Libye">Libye</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lituanie">Lituanie</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Macédoine du Nord">Macédoine du Nord</option>
                                    <option value="Malaisie">Malaisie</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malte">Malte</option>
                                    <option value="Maroc">Maroc</option>
                                    <option value="Marshall">Marshall</option>
                                    <option value="Mauritanie">Mauritanie</option>
                                    <option value="Mexique">Mexique</option>
                                    <option value="Micronésie">Micronésie</option>
                                    <option value="Moldavie">Moldavie</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Mongolie">Mongolie</option>
                                    <option value="Monténégro">Monténégro</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Namibie">Namibie</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Népal">Népal</option>
                                    <option value="Nicaragua">Nicaragua</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Norvège">Norvège</option>
                                    <option value="Nouvelle-Zélande">Nouvelle-Zélande</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Ouganda">Ouganda</option>
                                    <option value="Ouzbékistan">Ouzbékistan</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Palaos">Palaos</option>
                                    <option value="Palestine">Palestine</option>
                                    <option value="Panama">Panama</option>
                                    <option value="Papouasie-Nouvelle-Guinée">Papouasie-Nouvelle-Guinée</option>
                                    <option value="Paraguay">Paraguay</option>
                                    <option value="Pays-Bas">Pays-Bas</option>
                                    <option value="Pérou">Pérou</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Pologne">Pologne</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="République centrafricaine">République centrafricaine</option>
                                    <option value="République démocratique du Congo">République démocratique du Congo</option>
                                    <option value="République dominicaine">République dominicaine</option>
                                    <option value="République tchèque">République tchèque</option>
                                    <option value="Roumanie">Roumanie</option>
                                    <option value="Royaume-Uni">Royaume-Uni</option>
                                    <option value="Russie">Russie</option>
                                    <option value="Rwanda">Rwanda</option>
                                    <option value="Saint-Christophe-et-Niévès">Saint-Christophe-et-Niévès</option>
                                    <option value="Saint-Marin">Saint-Marin</option>
                                    <option value="Saint-Vincent-et-les-Grenadines">Saint-Vincent-et-les-Grenadines</option>
                                    <option value="Sainte-Lucie">Sainte-Lucie</option>
                                    <option value="Salomon">Salomon</option>
                                    <option value="Salvador">Salvador</option>
                                    <option value="Samoa">Samoa</option>
                                    <option value="Sao Tomé-et-Principe">Sao Tomé-et-Principe</option>
                                    <option value="Sénégal">Sénégal</option>
                                    <option value="Serbie">Serbie</option>
                                    <option value="Sierra Leone">Sierra Leone</option>
                                    <option value="Singapour">Singapour</option>
                                    <option value="Slovaquie">Slovaquie</option>
                                    <option value="Slovénie">Slovénie</option>
                                    <option value="Somalie">Somalie</option>
                                    <option value="Soudan">Soudan</option>
                                    <option value="Soudan du Sud">Soudan du Sud</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Suède">Suède</option>
                                    <option value="Suisse">Suisse</option>
                                    <option value="Suriname">Suriname</option>
                                    <option value="Syrie">Syrie</option>
                                    <option value="Tadjikistan">Tadjikistan</option>
                                    <option value="Tanzanie">Tanzanie</option>
                                    <option value="Tchad">Tchad</option>
                                    <option value="Thaïlande">Thaïlande</option>
                                    <option value="Timor oriental">Timor oriental</option>
                                    <option value="Togo">Togo</option>
                                    <option value="Tonga">Tonga</option>
                                    <option value="Trinité-et-Tobago">Trinité-et-Tobago</option>
                                    <option value="Tunisie">Tunisie</option>
                                    <option value="Turkménistan">Turkménistan</option>
                                    <option value="Turquie">Turquie</option>
                                    <option value="Tuvalu">Tuvalu</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="Uruguay">Uruguay</option>
                                    <option value="Vanuatu">Vanuatu</option>
                                    <option value="Vatican">Vatican</option>
                                    <option value="Venezuela">Venezuela</option>
                                    <option value="Viêt Nam">Viêt Nam</option>
                                    <option value="Yémen">Yémen</option>
                                    <option value="Zambie">Zambie</option>
                                    <option value="Zimbabwe">Zimbabwe</option>
                                </optgroup>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Ville / Région
                            </label>
                            <input type="text" name="ville" placeholder="Ex: Saint-Denis, Port-Louis..."
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Informations complémentaires <span class="text-red-500">*</span>
                        </label>
                        <textarea name="message" rows="5" required
                                  placeholder="Décrivez l'état général du bateau, équipements, travaux récents, etc."
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 text-white px-8 py-4 rounded-lg font-bold text-lg transition shadow-lg hover:shadow-xl">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Demander Mon Estimation Gratuite
                    </button>

                    <p class="text-sm text-gray-500 text-center">
                        <i class="fas fa-shield-alt mr-1"></i>
                        Vos données sont sécurisées et ne seront jamais partagées
                    </p>
                </form>
            </div>
        </div>
    </div>

    <!-- FAQ Vendeur -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
            Questions Fréquentes
        </h2>
        <div class="max-w-4xl mx-auto space-y-4">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="font-bold text-gray-800 mb-2 flex items-start">
                    <i class="fas fa-question-circle text-blue-600 mr-2 mt-1"></i>
                    Combien coûte votre service de courtage ?
                </h3>
                <p class="text-gray-600 text-sm ml-7">
                    Notre commission est fixée selon un barème transparent et compétitif. Elle est calculée uniquement si la vente aboutit (pas de frais cachés). Contactez-nous pour un devis personnalisé gratuit.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="font-bold text-gray-800 mb-2 flex items-start">
                    <i class="fas fa-question-circle text-blue-600 mr-2 mt-1"></i>
                    Combien de temps pour vendre mon bateau ?
                </h3>
                <p class="text-gray-600 text-sm ml-7">
                    Le délai moyen de vente est de 2 à 6 mois selon le marché et le type de bateau. Nos actions marketing ciblées et notre large réseau nous permettent d'accélérer significativement le processus.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="font-bold text-gray-800 mb-2 flex items-start">
                    <i class="fas fa-question-circle text-blue-600 mr-2 mt-1"></i>
                    Est-ce que je garde mon bateau pendant la vente ?
                </h3>
                <p class="text-gray-600 text-sm ml-7">
                    Oui, absolument ! Votre bateau reste en votre possession jusqu'à la signature de l'acte de vente. Vous pouvez continuer à l'utiliser pendant la période de commercialisation.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="font-bold text-gray-800 mb-2 flex items-start">
                    <i class="fas fa-question-circle text-blue-600 mr-2 mt-1"></i>
                    Dois-je être présent pour les visites ?
                </h3>
                <p class="text-gray-600 text-sm ml-7">
                    Non, pas nécessairement. Nous pouvons organiser et gérer les visites pour vous. Toutefois, certains vendeurs préfèrent être présents pour partager leur expérience avec les acheteurs potentiels.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="font-bold text-gray-800 mb-2 flex items-start">
                    <i class="fas fa-question-circle text-blue-600 mr-2 mt-1"></i>
                    Que se passe-t-il si mon bateau ne se vend pas ?
                </h3>
                <p class="text-gray-600 text-sm ml-7">
                    Vous ne payez rien tant que la vente n'aboutit pas. Nous ajustons ensemble la stratégie de vente (prix, présentation, diffusion) pour maximiser vos chances de succès.
                </p>
            </div>
        </div>
    </div>

    <!-- CTA Final -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl shadow-2xl p-12 text-white text-center">
        <h2 class="text-3xl font-bold mb-4">Prêt à Vendre Votre Bateau ?</h2>
        <p class="text-xl text-blue-100 mb-8">Obtenez une estimation gratuite en moins de 24h</p>
        <a href="#formulaire" class="inline-block bg-white text-blue-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-blue-50 transition shadow-lg">
            <i class="fas fa-arrow-up mr-2"></i>
            Remplir le Formulaire
        </a>
    </div>

</div>

@endsection
