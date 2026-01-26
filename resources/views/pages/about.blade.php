@extends('layouts.app')

@section('title', __('À propos - Myboat-oi | Courtage Maritime Océan Indien'))
@section('description', __('Découvrez Myboat-oi, votre courtier maritime de confiance dans l\'océan Indien. Expertise, passion et service de qualité pour l\'achat et la vente de bateaux.'))

@section('content')

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-ocean-600 via-ocean-700 to-luxe-navy dark:from-luxe-navy dark:via-ocean-950 dark:to-black text-white py-24 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-20 w-96 h-96 bg-luxe-cyan rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-ocean-400 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-5xl md:text-7xl font-black mb-6">{{ __('À propos de Myboat-oi') }}</h1>
            <p class="text-xl md:text-2xl text-ocean-100 dark:text-ocean-200">{{ __('Votre partenaire de confiance pour l\'achat et la vente de bateaux dans l\'océan Indien') }}</p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-16">

    <!-- Notre Histoire -->
    <div class="max-w-4xl mx-auto mb-20">
        <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl p-10 md:p-12 border border-gray-100 dark:border-white/10">
            <h2 class="text-4xl font-black text-gray-900 dark:text-white mb-8 text-center flex items-center justify-center">
                <i class="fas fa-anchor text-ocean-600 dark:text-ocean-400 mr-4"></i>
                {{ __('Notre Histoire') }}
            </h2>
            <div class="prose prose-lg max-w-none space-y-5">
                <p class="text-lg leading-relaxed text-gray-700 dark:text-gray-300">
                    Fondée par des passionnés de mer et de navigation, <strong class="text-ocean-600 dark:text-ocean-400">Myboat-oi</strong> est née d'une vision simple : créer la première marketplace dédiée à la vente de bateaux dans l'océan Indien, regroupant La Réunion, Maurice, Madagascar, Seychelles et Zanzibar.
                </p>
                <p class="leading-relaxed text-gray-700 dark:text-gray-300">
                    Fort de plusieurs années d'expérience dans le courtage maritime, notre équipe connaît parfaitement les spécificités du marché local et les besoins des plaisanciers de la région. Nous comprenons que l'achat ou la vente d'un bateau est bien plus qu'une simple transaction : c'est la concrétisation d'un rêve, d'une passion, d'un projet de vie.
                </p>
                <p class="leading-relaxed text-gray-700 dark:text-gray-300">
                    C'est pourquoi nous mettons tout en œuvre pour vous accompagner à chaque étape de votre projet, avec professionnalisme, transparence et bienveillance.
                </p>
            </div>
        </div>
    </div>

    <!-- Notre Mission -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
        <div class="bg-gradient-to-br from-ocean-500 via-ocean-600 to-ocean-700 dark:from-ocean-700 dark:via-ocean-800 dark:to-luxe-navy rounded-3xl shadow-2xl p-8 text-white transform hover:scale-105 transition-all">
            <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6">
                <i class="fas fa-heart text-4xl"></i>
            </div>
            <h3 class="text-2xl font-black mb-4">{{ __('Notre Mission') }}</h3>
            <p class="text-ocean-50 dark:text-ocean-100">
                Faciliter l'achat et la vente de bateaux en offrant une plateforme moderne, transparente et accessible à tous les passionnés de navigation de l'océan Indien.
            </p>
        </div>

        <div class="bg-gradient-to-br from-cyan-500 via-cyan-600 to-luxe-cyan dark:from-cyan-700 dark:via-cyan-800 dark:to-ocean-900 rounded-3xl shadow-2xl p-8 text-white transform hover:scale-105 transition-all">
            <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6">
                <i class="fas fa-eye text-4xl"></i>
            </div>
            <h3 class="text-2xl font-black mb-4">{{ __('Notre Vision') }}</h3>
            <p class="text-cyan-50 dark:text-cyan-100">
                Devenir la référence incontournable du courtage maritime dans l'océan Indien, reconnue pour son expertise, son intégrité et la qualité de son service.
            </p>
        </div>

        <div class="bg-gradient-to-br from-teal-500 via-teal-600 to-teal-700 dark:from-teal-700 dark:via-teal-800 dark:to-ocean-900 rounded-3xl shadow-2xl p-8 text-white transform hover:scale-105 transition-all">
            <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6">
                <i class="fas fa-star text-4xl"></i>
            </div>
            <h3 class="text-2xl font-black mb-4">{{ __('Nos Valeurs') }}</h3>
            <p class="text-teal-50 dark:text-teal-100">
                Intégrité, expertise, passion, transparence et accompagnement personnalisé. Chaque client mérite le meilleur service pour réaliser son projet maritime.
            </p>
        </div>
    </div>

    <!-- Nos Services -->
    <div class="mb-20">
        <h2 class="text-4xl font-black text-gray-900 dark:text-white mb-12 text-center flex items-center justify-center">
            <i class="fas fa-cogs text-ocean-600 dark:text-ocean-400 mr-4"></i>
            {{ __('Nos Services') }}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-7 hover:shadow-2xl transition-all transform hover:-translate-y-2 border border-gray-100 dark:border-white/10">
                <div class="w-16 h-16 bg-gradient-to-br from-ocean-100 to-ocean-200 dark:from-ocean-950/30 dark:to-ocean-900/30 rounded-2xl flex items-center justify-center mb-5">
                    <i class="fas fa-handshake text-ocean-600 dark:text-ocean-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 dark:text-white mb-3">{{ __('Courtage') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Accompagnement complet pour la vente ou l'achat de votre bateau, de A à Z.
                </p>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-7 hover:shadow-2xl transition-all transform hover:-translate-y-2 border border-gray-100 dark:border-white/10">
                <div class="w-16 h-16 bg-gradient-to-br from-ocean-100 to-ocean-200 dark:from-ocean-950/30 dark:to-ocean-900/30 rounded-2xl flex items-center justify-center mb-5">
                    <i class="fas fa-search text-ocean-600 dark:text-ocean-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 dark:text-white mb-3">{{ __('Expertise') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Évaluation précise et professionnelle de la valeur de votre bateau par des experts certifiés.
                </p>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-7 hover:shadow-2xl transition-all transform hover:-translate-y-2 border border-gray-100 dark:border-white/10">
                <div class="w-16 h-16 bg-gradient-to-br from-ocean-100 to-ocean-200 dark:from-ocean-950/30 dark:to-ocean-900/30 rounded-2xl flex items-center justify-center mb-5">
                    <i class="fas fa-camera text-ocean-600 dark:text-ocean-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 dark:text-white mb-3">{{ __('Mise en Valeur') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Photos et vidéos professionnelles pour maximiser l'attractivité de votre annonce.
                </p>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-7 hover:shadow-2xl transition-all transform hover:-translate-y-2 border border-gray-100 dark:border-white/10">
                <div class="w-16 h-16 bg-gradient-to-br from-ocean-100 to-ocean-200 dark:from-ocean-950/30 dark:to-ocean-900/30 rounded-2xl flex items-center justify-center mb-5">
                    <i class="fas fa-file-contract text-ocean-600 dark:text-ocean-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 dark:text-white mb-3">{{ __('Juridique') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Assistance administrative et juridique pour sécuriser votre transaction.
                </p>
            </div>
        </div>
    </div>

    <!-- Chiffres Clés -->
    <div class="bg-gradient-to-br from-ocean-600 via-ocean-700 to-luxe-navy dark:from-luxe-navy dark:via-ocean-900 dark:to-black rounded-3xl shadow-2xl p-8 md:p-16 mb-20 text-white border border-ocean-500/30">
        <h2 class="text-3xl md:text-4xl font-black mb-10 md:mb-14 text-center">{{ __('Nos Résultats en Chiffres') }}</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-10">
            <div class="text-center transform hover:scale-110 transition-all">
                <div class="text-3xl sm:text-4xl md:text-6xl font-black mb-2 md:mb-3 bg-gradient-to-r from-white to-ocean-100 bg-clip-text text-transparent">150+</div>
                <div class="text-ocean-200 dark:text-ocean-300 text-xs sm:text-sm md:text-base">{{ __('Bateaux Vendus') }}</div>
            </div>
            <div class="text-center transform hover:scale-110 transition-all">
                <div class="text-3xl sm:text-4xl md:text-6xl font-black mb-2 md:mb-3 bg-gradient-to-r from-white to-ocean-100 bg-clip-text text-transparent">98%</div>
                <div class="text-ocean-200 dark:text-ocean-300 text-xs sm:text-sm md:text-base">{{ __('Clients Satisfaits') }}</div>
            </div>
            <div class="text-center transform hover:scale-110 transition-all">
                <div class="text-3xl sm:text-4xl md:text-6xl font-black mb-2 md:mb-3 bg-gradient-to-r from-white to-ocean-100 bg-clip-text text-transparent">10+</div>
                <div class="text-ocean-200 dark:text-ocean-300 text-xs sm:text-sm md:text-base">{{ __('Années d\'Expérience') }}</div>
            </div>
            <div class="text-center transform hover:scale-110 transition-all">
                <div class="text-3xl sm:text-4xl md:text-6xl font-black mb-2 md:mb-3 bg-gradient-to-r from-white to-ocean-100 bg-clip-text text-transparent">5</div>
                <div class="text-ocean-200 dark:text-ocean-300 text-xs sm:text-sm md:text-base">{{ __('Îles Couvertes') }}</div>
            </div>
            <div class="text-center transform hover:scale-110 transition-all col-span-2 md:col-span-4">
                <div class="text-2xl sm:text-3xl md:text-4xl font-black mb-2 md:mb-3 bg-gradient-to-r from-white to-ocean-100 bg-clip-text text-transparent">Europe / DOM-TOM</div>
                <div class="text-ocean-200 dark:text-ocean-300 text-xs sm:text-sm md:text-base">{{ __('Couverture Étendue') }}</div>
            </div>
        </div>
    </div>

    <!-- Pourquoi nous choisir -->
    <div class="mb-20">
        <h2 class="text-4xl font-black text-gray-900 dark:text-white mb-12 text-center flex items-center justify-center">
            <i class="fas fa-trophy text-ocean-600 dark:text-ocean-400 mr-4"></i>
            {{ __('Pourquoi Choisir Myboat-oi ?') }}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-8 border border-gray-100 dark:border-white/10 hover:shadow-2xl transition-all">
                <div class="flex items-start">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-emerald-200 dark:from-green-950/30 dark:to-emerald-900/30 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check text-green-600 dark:text-green-400 text-2xl"></i>
                    </div>
                    <div class="ml-5">
                        <h3 class="text-xl font-black text-gray-900 dark:text-white mb-2">{{ __('Expertise Locale') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            {{ __('Une équipe de passionnés, avec un collaborateur sur chaque île.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-8 border border-gray-100 dark:border-white/10 hover:shadow-2xl transition-all">
                <div class="flex items-start">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-emerald-200 dark:from-green-950/30 dark:to-emerald-900/30 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check text-green-600 dark:text-green-400 text-2xl"></i>
                    </div>
                    <div class="ml-5">
                        <h3 class="text-xl font-black text-gray-900 dark:text-white mb-2">{{ __('Transparence Totale') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            {{ __('Pas de frais cachés, des prix clairs et une communication honnête.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-8 border border-gray-100 dark:border-white/10 hover:shadow-2xl transition-all">
                <div class="flex items-start">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-emerald-200 dark:from-green-950/30 dark:to-emerald-900/30 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check text-green-600 dark:text-green-400 text-2xl"></i>
                    </div>
                    <div class="ml-5">
                        <h3 class="text-xl font-black text-gray-900 dark:text-white mb-2">{{ __('Accompagnement') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            {{ __('Un conseiller dédié du début à la fin de votre projet.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-8 border border-gray-100 dark:border-white/10 hover:shadow-2xl transition-all">
                <div class="flex items-start">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-emerald-200 dark:from-green-950/30 dark:to-emerald-900/30 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check text-green-600 dark:text-green-400 text-2xl"></i>
                    </div>
                    <div class="ml-5">
                        <h3 class="text-xl font-black text-gray-900 dark:text-white mb-2">{{ __('Réseau Étendu') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            {{ __('Présence sur 5 îles de l\'océan Indien pour maximiser la visibilité.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-8 border border-gray-100 dark:border-white/10 hover:shadow-2xl transition-all">
                <div class="flex items-start">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-emerald-200 dark:from-green-950/30 dark:to-emerald-900/30 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check text-green-600 dark:text-green-400 text-2xl"></i>
                    </div>
                    <div class="ml-5">
                        <h3 class="text-xl font-black text-gray-900 dark:text-white mb-2">{{ __('Plateforme Moderne') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            {{ __('Site web optimisé, recherche avancée et alertes email.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-8 border border-gray-100 dark:border-white/10 hover:shadow-2xl transition-all">
                <div class="flex items-start">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-emerald-200 dark:from-green-950/30 dark:to-emerald-900/30 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check text-green-600 dark:text-green-400 text-2xl"></i>
                    </div>
                    <div class="ml-5">
                        <h3 class="text-xl font-black text-gray-900 dark:text-white mb-2">{{ __('Après-Vente') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            {{ __('Notre relation ne s\'arrête pas à la transaction.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Témoignages -->
    <div class="mb-20">
        <h2 class="text-4xl font-black text-gray-900 dark:text-white mb-12 text-center flex items-center justify-center">
            <i class="fas fa-quote-left text-ocean-600 dark:text-ocean-400 mr-4"></i>
            {{ __('Ils Nous Font Confiance') }}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-7 border border-gray-100 dark:border-white/10 hover:shadow-2xl transition-all">
                <div class="flex items-center mb-5">
                    <div class="w-14 h-14 bg-gradient-to-br from-ocean-100 to-ocean-200 dark:from-ocean-950/30 dark:to-ocean-900/30 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-user text-ocean-600 dark:text-ocean-400 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-gray-900 dark:text-white">Jean-Marc L.</h4>
                        <div class="text-yellow-500 text-sm">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600 dark:text-gray-400 italic text-sm">
                    "Service impeccable ! Mon catamaran a été vendu en moins de 3 mois. L'équipe est professionnelle, réactive et de très bon conseil."
                </p>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-7 border border-gray-100 dark:border-white/10 hover:shadow-2xl transition-all">
                <div class="flex items-center mb-5">
                    <div class="w-14 h-14 bg-gradient-to-br from-ocean-100 to-ocean-200 dark:from-ocean-950/30 dark:to-ocean-900/30 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-user text-ocean-600 dark:text-ocean-400 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-gray-900 dark:text-white">Sophie R.</h4>
                        <div class="text-yellow-500 text-sm">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600 dark:text-gray-400 italic text-sm">
                    "J'ai trouvé le voilier de mes rêves grâce à Myboat-oi. Accompagnement parfait de A à Z, je recommande les yeux fermés !"
                </p>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-7 border border-gray-100 dark:border-white/10 hover:shadow-2xl transition-all">
                <div class="flex items-center mb-5">
                    <div class="w-14 h-14 bg-gradient-to-br from-ocean-100 to-ocean-200 dark:from-ocean-950/30 dark:to-ocean-900/30 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-user text-ocean-600 dark:text-ocean-400 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-gray-900 dark:text-white">Patrick M.</h4>
                        <div class="text-yellow-500 text-sm">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600 dark:text-gray-400 italic text-sm">
                    "Une expertise locale inégalée. Ils connaissent parfaitement le marché de La Réunion et des îles voisines."
                </p>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="bg-gradient-to-br from-ocean-600 via-ocean-700 to-luxe-navy dark:from-luxe-navy dark:via-ocean-900 dark:to-black rounded-3xl shadow-2xl p-12 md:p-16 text-white text-center border border-ocean-500/30">
        <h2 class="text-4xl font-black mb-5">{{ __('Prêt à Réaliser Votre Projet Maritime ?') }}</h2>
        <p class="text-xl text-ocean-100 dark:text-ocean-200 mb-10">{{ __('Contactez-nous dès aujourd\'hui pour un accompagnement personnalisé') }}</p>
        <div class="flex flex-col sm:flex-row gap-5 justify-center">
            <a href="{{ route('contact') }}" class="bg-white hover:bg-ocean-50 text-ocean-900 px-10 py-4 rounded-2xl font-black text-lg transition-all shadow-xl hover:shadow-2xl transform hover:scale-105">
                <i class="fas fa-envelope mr-2"></i>
                {{ __('Nous contacter') }}
            </a>
            <a href="{{ route('bateaux.index') }}" class="bg-ocean-500/20 hover:bg-ocean-500/30 backdrop-blur-sm text-white px-10 py-4 rounded-2xl font-black text-lg transition-all shadow-xl border-2 border-white/50">
                <i class="fas fa-search mr-2"></i>
                {{ __('Voir les Annonces') }}
            </a>
        </div>
    </div>

</div>

@endsection
