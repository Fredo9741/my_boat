@extends('layouts.app')

@section('title', 'À propos - Myboat-oi | Courtage Maritime Océan Indien')
@section('description', 'Découvrez Myboat-oi, votre courtier maritime de confiance dans l\'océan Indien. Expertise, passion et service de qualité pour l\'achat et la vente de bateaux.')

@section('content')

<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">À propos de Myboat-oi</h1>
            <p class="text-xl md:text-2xl text-blue-100">Votre partenaire de confiance pour l'achat et la vente de bateaux dans l'océan Indien</p>
        </div>
    </div>
</div>

<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'Accueil', 'url' => route('home')],
    ['label' => 'À propos', 'url' => '#']
]" />

<div class="container mx-auto px-4 py-12">

    <!-- Notre Histoire -->
    <div class="max-w-4xl mx-auto mb-16">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                <i class="fas fa-anchor text-blue-600 mr-2"></i>
                Notre Histoire
            </h2>
            <div class="prose prose-lg max-w-none text-gray-700 space-y-4">
                <p class="text-lg leading-relaxed">
                    Fondée par des passionnés de mer et de navigation, <strong>Myboat-oi</strong> est née d'une vision simple : créer la première marketplace dédiée à la vente de bateaux dans l'océan Indien, regroupant La Réunion, Maurice, Madagascar, Seychelles et Zanzibar.
                </p>
                <p class="leading-relaxed">
                    Fort de plusieurs années d'expérience dans le courtage maritime, notre équipe connaît parfaitement les spécificités du marché local et les besoins des plaisanciers de la région. Nous comprenons que l'achat ou la vente d'un bateau est bien plus qu'une simple transaction : c'est la concrétisation d'un rêve, d'une passion, d'un projet de vie.
                </p>
                <p class="leading-relaxed">
                    C'est pourquoi nous mettons tout en œuvre pour vous accompagner à chaque étape de votre projet, avec professionnalisme, transparence et bienveillance.
                </p>
            </div>
        </div>
    </div>

    <!-- Notre Mission -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl shadow-lg p-8 text-white">
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-heart text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold mb-4">Notre Mission</h3>
            <p class="text-blue-100">
                Faciliter l'achat et la vente de bateaux en offrant une plateforme moderne, transparente et accessible à tous les passionnés de navigation de l'océan Indien.
            </p>
        </div>

        <div class="bg-gradient-to-br from-cyan-500 to-cyan-700 rounded-xl shadow-lg p-8 text-white">
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-eye text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold mb-4">Notre Vision</h3>
            <p class="text-cyan-100">
                Devenir la référence incontournable du courtage maritime dans l'océan Indien, reconnue pour son expertise, son intégrité et la qualité de son service.
            </p>
        </div>

        <div class="bg-gradient-to-br from-teal-500 to-teal-700 rounded-xl shadow-lg p-8 text-white">
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-star text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold mb-4">Nos Valeurs</h3>
            <p class="text-teal-100">
                Intégrité, expertise, passion, transparence et accompagnement personnalisé. Chaque client mérite le meilleur service pour réaliser son projet maritime.
            </p>
        </div>
    </div>

    <!-- Nos Services -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
            <i class="fas fa-cogs text-blue-600 mr-2"></i>
            Nos Services
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-handshake text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Courtage</h3>
                <p class="text-gray-600 text-sm">
                    Accompagnement complet pour la vente ou l'achat de votre bateau, de A à Z.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-search text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Expertise</h3>
                <p class="text-gray-600 text-sm">
                    Évaluation précise et professionnelle de la valeur de votre bateau par des experts certifiés.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-camera text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Mise en Valeur</h3>
                <p class="text-gray-600 text-sm">
                    Photos et vidéos professionnelles pour maximiser l'attractivité de votre annonce.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-file-contract text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Accompagnement Juridique</h3>
                <p class="text-gray-600 text-sm">
                    Assistance administrative et juridique pour sécuriser votre transaction.
                </p>
            </div>
        </div>
    </div>

    <!-- Chiffres Clés -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl shadow-2xl p-12 mb-16 text-white">
        <h2 class="text-3xl font-bold mb-12 text-center">Nos Résultats en Chiffres</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-5xl font-bold mb-2">150+</div>
                <div class="text-blue-200">Bateaux Vendus</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-bold mb-2">98%</div>
                <div class="text-blue-200">Clients Satisfaits</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-bold mb-2">8+</div>
                <div class="text-blue-200">Années d'Expérience</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-bold mb-2">3</div>
                <div class="text-blue-200">Îles Couvertes</div>
            </div>
        </div>
    </div>

    <!-- Pourquoi nous choisir -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
            <i class="fas fa-trophy text-blue-600 mr-2"></i>
            Pourquoi Choisir Myboat-oi ?
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Expertise Locale</h3>
                        <p class="text-gray-600">
                            Une équipe de passionnés, avec un collaborateur sur chaque îles.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Transparence Totale</h3>
                        <p class="text-gray-600">
                            Pas de frais cachés, des prix clairs et une communication honnête à chaque étape.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Accompagnement Personnalisé</h3>
                        <p class="text-gray-600">
                            Un conseiller dédié vous accompagne tout au long de votre projet, du début à la fin.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Réseau Étendu</h3>
                        <p class="text-gray-600">
                            Présence sur 5 îles de l'océan Indien pour maximiser la visibilité de votre annonce.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Plateforme Moderne</h3>
                        <p class="text-gray-600">
                            Site web optimisé, recherche avancée et alertes email pour ne manquer aucune opportunité.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Service Après-Vente</h3>
                        <p class="text-gray-600">
                            Notre relation ne s'arrête pas à la transaction. Nous restons à vos côtés.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Témoignages -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
            <i class="fas fa-quote-left text-blue-600 mr-2"></i>
            Ils Nous Font Confiance
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-user text-blue-600"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Jean-Marc L.</h4>
                        <div class="text-yellow-500 text-sm">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600 italic text-sm">
                    "Service impeccable ! Mon catamaran a été vendu en moins de 3 mois. L'équipe est professionnelle, réactive et de très bon conseil."
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-user text-blue-600"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Sophie R.</h4>
                        <div class="text-yellow-500 text-sm">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600 italic text-sm">
                    "J'ai trouvé le voilier de mes rêves grâce à Myboat-oi. Accompagnement parfait de A à Z, je recommande les yeux fermés !"
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-user text-blue-600"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Patrick M.</h4>
                        <div class="text-yellow-500 text-sm">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600 italic text-sm">
                    "Une expertise locale inégalée. Ils connaissent parfaitement le marché de La Réunion et des îles voisines."
                </p>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl shadow-2xl p-12 text-white text-center">
        <h2 class="text-3xl font-bold mb-4">Prêt à Réaliser Votre Projet Maritime ?</h2>
        <p class="text-xl text-blue-100 mb-8">Contactez-nous dès aujourd'hui pour un accompagnement personnalisé</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-blue-50 transition shadow-lg">
                <i class="fas fa-envelope mr-2"></i>
                Nous Contacter
            </a>
            <a href="{{ route('bateaux.index') }}" class="bg-blue-700 text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-blue-800 transition shadow-lg border-2 border-white">
                <i class="fas fa-search mr-2"></i>
                Voir les Annonces
            </a>
        </div>
    </div>

</div>

@endsection
