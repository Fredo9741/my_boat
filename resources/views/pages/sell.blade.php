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
                                Île / Pays
                            </label>
                            <select name="localisation"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionnez</option>
                                <option value="La Réunion">La Réunion</option>
                                <option value="Maurice">Maurice</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Autre">Autre</option>
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
