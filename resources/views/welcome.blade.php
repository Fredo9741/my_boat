@extends('layouts.app')

@section('title', __('Acheter un Bateau Océan Indien | Réunion, Maurice, Madagascar - My Boat'))
@section('description', __('Vente de bateaux neufs et d\'occasion dans l\'Océan Indien : monocoques, catamarans, multicoques à La Réunion, Maurice, Madagascar, Seychelles et Mayotte. Estimation gratuite.'))

@section('og_title', __('Acheter un Bateau dans l\'Océan Indien | My Boat'))
@section('og_description', __('Votre courtier maritime de confiance. Voiliers, catamarans et bateaux à moteur à La Réunion, Maurice, Madagascar.'))

@section('content')


    <!-- Hero Section Premium -->
    <section class="relative min-h-screen flex items-end lg:items-center overflow-hidden">
<!-- Background Image -->
<div class="absolute inset-0">
<picture>
    <source
        media="(max-width: 768px)"
        srcset="https://files.fredlabs.org/hero/herosmart.webp"
    >

    <img
        src="https://files.fredlabs.org/hero/herodesk.webp"
        alt="{{ __('Marketplace de vente de bateaux dans l\'océan Indien') }}"
        loading="eager"
        fetchpriority="high"
        class="
            w-full h-full object-cover
            object-[35%_50%]
            md:object-[60%_45%]
            lg:object-[72%_43%]
            xl:object-[78%_43%]
        "
    >
</picture>

    <div class="absolute inset-0 bg-gradient-to-r from-black/10 via-black/2 to-transparent"></div>
</div>


        <!-- Content Container - Left aligned -->
        <div class="relative w-full pb-8 pt-24 lg:py-0">
            <div class="container mx-auto px-4">
                <div class="lg:max-w-2xl xl:max-w-3xl">
                    <!-- Badge -->
                    <a href="{{ route('bateaux.index') }}" class="inline-flex items-center space-x-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md text-white mb-6 animate-fadeInUp border border-white/20 hover:bg-white/20 transition-all cursor-pointer">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse shadow-lg shadow-green-400/50"></span>
                        <span class="text-sm font-medium">{{ $stats['total_bateaux'] }} {{ __('bateaux disponibles') }}</span>
                    </a>

                    <!-- Main Title - SEO optimized with geographic keywords -->
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-black mb-6 animate-fadeInUp leading-tight" style="animation-delay: 0.1s; text-shadow: 0 2px 4px rgba(0,0,0,0.3), -1px -1px 0 rgba(0,0,0,0.2), 1px -1px 0 rgba(0,0,0,0.2), -1px 1px 0 rgba(0,0,0,0.2), 1px 1px 0 rgba(0,0,0,0.2);">
                        <span class="text-white">{{ __('Acheter ou vendre un bateau') }}</span><br class="hidden sm:block">
                        <span class="text-white">{{ __('dans l\'') }}</span><span class="relative inline-block">
                            <span class="relative z-10 text-[#fdbb27] italic">{{ __('Océan Indien') }}</span>
                            <div class="absolute bottom-1 sm:bottom-2 left-0 w-full h-3 sm:h-4 bg-white/20 transform -rotate-1 rounded-lg blur-sm"></div>
                        </span>
                    </h1>

                    <p class="text-lg sm:text-xl lg:text-2xl font-semibold mb-8 animate-fadeInUp" style="animation-delay: 0.2s; text-shadow: 0 1px 3px rgba(0,0,0,0.4), -1px -1px 0 rgba(0,0,0,0.15), 1px -1px 0 rgba(0,0,0,0.15), -1px 1px 0 rgba(0,0,0,0.15), 1px 1px 0 rgba(0,0,0,0.15);">
                        <span class="text-white">{{ __('Votre courtier maritime à') }}</span>
                        <span class="text-[#fdbb27] italic">{{ __('La Réunion, Maurice, Madagascar, Seychelles et Mayotte') }}</span>
                    </p>
                </div>

                <!-- Centered Search Bar and Stats -->
                <div class="max-w-4xl mx-auto animate-fadeInUp" style="animation-delay: 0.3s;">
                    <form action="{{ route('bateaux.index') }}" method="GET" class="bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl rounded-3xl shadow-2xl p-3 md:p-4 border border-white/20">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                            <!-- Type -->
                            <div class="relative group">
                                <select name="type_id" class="w-full px-5 py-4 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 dark:focus:ring-ocean-400 text-gray-700 dark:text-gray-300 font-medium appearance-none cursor-pointer transition-all duration-300 group-hover:bg-gray-100 dark:group-hover:bg-slate-700">
                                    <option value="">{{ __('Type de bateau') }}</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->libelle }}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500 pointer-events-none group-hover:text-ocean-500 transition-colors"></i>
                            </div>

                            <!-- Location -->
                            <div class="relative group">
                                <select name="zone_id" class="w-full px-5 py-4 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 dark:focus:ring-ocean-400 text-gray-700 dark:text-gray-300 font-medium appearance-none cursor-pointer transition-all duration-300 group-hover:bg-gray-100 dark:group-hover:bg-slate-700">
                                    <option value="">{{ __('Localisation') }}</option>
                                    @foreach($zones as $zone)
                                        <option value="{{ $zone->id }}">{{ $zone->libelle }}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500 pointer-events-none group-hover:text-ocean-500 transition-colors"></i>
                            </div>

                            <!-- Price -->
                            <div class="relative group">
                                <select name="prix_max" class="w-full px-5 py-4 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 dark:focus:ring-ocean-400 text-gray-700 dark:text-gray-300 font-medium appearance-none cursor-pointer transition-all duration-300 group-hover:bg-gray-100 dark:group-hover:bg-slate-700">
                                    <option value="">{{ __('Budget max') }}</option>
                                    <option value="10000">10 000 €</option>
                                    <option value="25000">25 000 €</option>
                                    <option value="50000">50 000 €</option>
                                    <option value="100000">100 000 €</option>
                                    <option value="250000">250 000 €</option>
                                    <option value="500000">500 000 €+</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500 pointer-events-none group-hover:text-ocean-500 transition-colors"></i>
                            </div>

                            <!-- Search Button -->
                            <button type="submit" class="group relative px-8 py-4 bg-gradient-to-r from-ocean-600 to-luxe-cyan hover:from-ocean-700 hover:to-ocean-600 text-white rounded-2xl font-bold text-lg transition-all shadow-lg hover:shadow-2xl transform hover:scale-105 overflow-hidden">
                                <span class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></span>
                                <span class="relative z-10 flex items-center justify-center">
                                    <i class="fas fa-search mr-2"></i>
                                    <span class="hidden md:inline">{{ __('Rechercher') }}</span>
                                </span>
                            </button>
                        </div>
                    </form>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-3 gap-4 sm:gap-6 mt-8 p-4 max-w-2xl mx-auto">
                        <div class="text-center group">
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-black mb-1 text-[#fdbb27] group-hover:scale-110 transition-transform" style="text-shadow: 0 2px 4px rgba(0,0,0,0.3), -1px -1px 0 rgba(0,0,0,0.2), 1px -1px 0 rgba(0,0,0,0.2), -1px 1px 0 rgba(0,0,0,0.2), 1px 1px 0 rgba(0,0,0,0.2);">54+</div>
                            <div class="text-white text-sm sm:text-base font-semibold" style="text-shadow: 0 1px 3px rgba(0,0,0,0.5), -1px -1px 0 rgba(0,0,0,0.2), 1px -1px 0 rgba(0,0,0,0.2), -1px 1px 0 rgba(0,0,0,0.2), 1px 1px 0 rgba(0,0,0,0.2);">{{ __('Bateaux disponibles') }}</div>
                        </div>
                        <div class="text-center group">
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-black mb-1 text-[#fdbb27] group-hover:scale-110 transition-transform" style="text-shadow: 0 2px 4px rgba(0,0,0,0.3), -1px -1px 0 rgba(0,0,0,0.2), 1px -1px 0 rgba(0,0,0,0.2), -1px 1px 0 rgba(0,0,0,0.2), 1px 1px 0 rgba(0,0,0,0.2);">5</div>
                            <div class="text-white text-sm sm:text-base font-semibold" style="text-shadow: 0 1px 3px rgba(0,0,0,0.5), -1px -1px 0 rgba(0,0,0,0.2), 1px -1px 0 rgba(0,0,0,0.2), -1px 1px 0 rgba(0,0,0,0.2), 1px 1px 0 rgba(0,0,0,0.2);">{{ __('Îles couvertes') }}</div>
                        </div>
                        <div class="text-center group">
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-black mb-1 text-[#fdbb27] group-hover:scale-110 transition-transform" style="text-shadow: 0 2px 4px rgba(0,0,0,0.3), -1px -1px 0 rgba(0,0,0,0.2), 1px -1px 0 rgba(0,0,0,0.2), -1px 1px 0 rgba(0,0,0,0.2), 1px 1px 0 rgba(0,0,0,0.2);">48h</div>
                            <div class="text-white text-sm sm:text-base font-semibold" style="text-shadow: 0 1px 3px rgba(0,0,0,0.5), -1px -1px 0 rgba(0,0,0,0.2), 1px -1px 0 rgba(0,0,0,0.2), -1px 1px 0 rgba(0,0,0,0.2), 1px 1px 0 rgba(0,0,0,0.2);">{{ __('Temps de réponse') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 animate-bounce hidden lg:block">
            <div class="w-8 h-12 border-2 border-white/50 rounded-full p-2">
                <div class="w-1.5 h-3 bg-white rounded-full mx-auto animate-pulse"></div>
            </div>
        </div>
    </section>

    <!-- Section 1: Nos dernières opportunités (Featured Boats) -->
    <section class="py-20 md:py-28 bg-white dark:bg-slate-900">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12">
                <div class="mb-6 md:mb-0">
                    <h2 class="text-3xl md:text-5xl font-black text-gray-900 dark:text-white mb-4">
                        {{ __('Nos dernières opportunités') }}
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-400">
                        {{ __('Découvrez notre sélection exclusive du moment') }}
                    </p>
                </div>
                <a href="{{ route('bateaux.index') }}" class="hidden md:flex items-center px-6 py-3 bg-gradient-to-r from-ocean-600 to-luxe-cyan hover:from-ocean-700 hover:to-ocean-600 text-white rounded-xl font-bold transition-all shadow-lg hover:shadow-2xl transform hover:scale-105">
                    {{ __('Voir tout') }}
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Boats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($featuredBateaux->take(4) as $bateau)
                    <x-boat-card
                        :slug="$bateau->slug"
                        :title="$bateau->modele"
                        :image="$bateau->main_image"
                        :price="$bateau->prix"
                        :location="$bateau->location"
                        :length="$bateau->length"
                        :year="$bateau->annee"
                        :badge="$bateau->badge['label'] ?? null"
                        :badge-color="$bateau->badge['color'] ?? 'green'"
                    />
                @empty
                    <div class="col-span-4 text-center py-20">
                        <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-ocean-100 to-ocean-200 dark:from-ocean-950 dark:to-ocean-900 rounded-full flex items-center justify-center">
                            <i class="fas fa-anchor text-4xl text-ocean-400 dark:text-ocean-600"></i>
                        </div>
                        <p class="text-xl text-gray-500 dark:text-gray-400">{{ __('Aucune annonce disponible pour le moment') }}</p>
                    </div>
                @endforelse
            </div>

            <!-- Mobile CTA -->
            <div class="mt-10 text-center md:hidden">
                <a href="{{ route('bateaux.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-ocean-600 to-luxe-cyan text-white rounded-xl font-bold text-lg transition-all shadow-lg hover:shadow-2xl">
                    {{ __('Voir tous les bateaux') }}
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Section 2: Trouvez votre style de navigation (Types de bateaux en dur) -->
    <section class="py-20 md:py-28 bg-gradient-to-b from-gray-50 to-white dark:from-slate-950 dark:to-slate-900">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-5xl font-black text-gray-900 dark:text-white mb-6">
                    {{ __('Trouvez votre style de navigation') }}
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400">
                    {{ __('Explorez nos catégories pour trouver le bateau idéal') }}
                </p>
            </div>

            <!-- Categories Grid - 4 cartes en dur -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Catamarans (voile + moteur) -->
                <a href="{{ route('bateaux.index', ['type' => ['catamaran-a-voile', 'catamaran-a-moteur']]) }}"
                   title="{{ __('Découvrir tous nos catamarans à vendre dans l\'Océan Indien') }}"
                   class="group relative bg-white dark:bg-slate-900 rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100 dark:border-white/10">
                    <div class="aspect-[4/3] bg-gradient-to-br from-ocean-500 to-luxe-cyan p-8 flex items-center justify-center">
                        <i class="fas fa-dharmachakra text-7xl text-white/90 group-hover:scale-110 transition-transform duration-500"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-ocean-600 dark:group-hover:text-ocean-400 transition-colors">
                            {{ __('Catamarans') }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            {{ __('Stabilité et espace pour vos croisières en famille ou charters.') }}
                        </p>
                        <div class="mt-4 flex items-center text-ocean-600 dark:text-ocean-400 font-semibold text-sm">
                            {{ __('Voir les annonces') }}
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </div>
                </a>

                <!-- Voiliers Monocoques -->
                <a href="{{ route('bateaux.index', ['type' => 'voilier-monocoque']) }}"
                   title="{{ __('Découvrir tous nos voiliers monocoques à vendre') }}"
                   class="group relative bg-white dark:bg-slate-900 rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100 dark:border-white/10">
                    <div class="aspect-[4/3] bg-gradient-to-br from-purple-500 to-violet-600 p-8 flex items-center justify-center">
                        <i class="fas fa-sailboat text-7xl text-white/90 group-hover:scale-110 transition-transform duration-500"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                            {{ __('Voiliers Monocoques') }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            {{ __('Naviguez à la force du vent avec nos voiliers de croisière et de course.') }}
                        </p>
                        <div class="mt-4 flex items-center text-purple-600 dark:text-purple-400 font-semibold text-sm">
                            {{ __('Voir les annonces') }}
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </div>
                </a>

                <!-- Bateaux à moteur -->
                <a href="{{ route('bateaux.index', ['type' => 'bateau-moteur']) }}"
                   title="{{ __('Découvrir tous nos bateaux à moteur à vendre') }}"
                   class="group relative bg-white dark:bg-slate-900 rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100 dark:border-white/10">
                    <div class="aspect-[4/3] bg-gradient-to-br from-amber-500 to-orange-600 p-8 flex items-center justify-center">
                        <i class="fas fa-ship text-7xl text-white/90 group-hover:scale-110 transition-transform duration-500"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                            {{ __('Bateaux à moteur') }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            {{ __('Rapidité et confort pour vos sorties en mer et pêche sportive.') }}
                        </p>
                        <div class="mt-4 flex items-center text-amber-600 dark:text-amber-400 font-semibold text-sm">
                            {{ __('Voir les annonces') }}
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </div>
                </a>

                <!-- Trimarans -->
                <a href="{{ route('bateaux.index', ['type' => 'trimaran']) }}"
                   title="{{ __('Découvrir tous nos trimarans à vendre') }}"
                   class="group relative bg-white dark:bg-slate-900 rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100 dark:border-white/10">
                    <div class="aspect-[4/3] bg-gradient-to-br from-emerald-500 to-green-600 p-8 flex items-center justify-center">
                        <i class="fas fa-wind text-7xl text-white/90 group-hover:scale-110 transition-transform duration-500"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                            {{ __('Trimarans') }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            {{ __('Performance et légèreté pour les passionnés de vitesse.') }}
                        </p>
                        <div class="mt-4 flex items-center text-emerald-600 dark:text-emerald-400 font-semibold text-sm">
                            {{ __('Voir les annonces') }}
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Section 3: Votre projet dans l'Océan Indien (Implantations en dur) -->
    <section class="py-20 md:py-28 bg-white dark:bg-slate-900">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-5xl font-black text-gray-900 dark:text-white mb-6">
                    {{ __('Votre projet dans l\'Océan Indien') }}
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400">
                    {{ __('Un réseau de confiance sur 5 îles pour vous accompagner') }}
                </p>
            </div>

            <!-- Locations Grid - 5 cartes en dur -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
                <!-- La Réunion -->
                <a href="{{ route('bateaux.index', ['zone' => 'reunion']) }}"
                   title="{{ __('Voir tous les bateaux à vendre à La Réunion') }}"
                   class="group relative bg-gradient-to-br from-gray-50 to-white dark:from-slate-800 dark:to-slate-900 rounded-2xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 dark:border-white/10">
                   <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-ocean-500 to-ocean-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
    <svg class="w-12 h-12 text-white" viewBox="0 0 100 100" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M38.9336 80.5667C39.3706 81.2342 41.0105 82.8644 44.0734 84.0449H46.4336L47.535 84.5192L50.3671 85.5732L52.5175 86.4691L53.7238 87.5758L54.4056 87.3123L57.1853 87.5758L58.8636 87.3123L59.7552 88.1555L60.7518 88.7879L62.9545 89.7365L64.9476 88.7879L66.3112 89.2095L67.6224 90L69.6678 89.2095H71.2413L72.8671 87.5758L77.3252 88.0501L80.1573 86.5745C80.7517 86.6799 81.993 86.8907 82.2028 86.8907C82.4126 86.8907 83.6189 86.3988 84.1958 86.1529H85.7692C86.486 85.9597 87.951 85.4678 88.0769 85.0462C88.2343 84.5192 89.493 83.7287 89.493 83.4652C89.493 83.2017 91.1713 82.622 91.1713 81.9896C91.1713 81.3572 91.3287 80.7248 91.1713 80.3032C91.014 79.8816 90.6469 78.406 90.6469 77.879V75.1913L90.2797 72.3455V70.1848L90.6469 67.4444L91.958 62.9122L93.6888 60.7515V58.1692L95 57.2206V54.2167L94.3706 53.4789L93.6888 51.2128L91.5385 50.2642L89.5455 48.525H87.5L86.8182 47.3656L85.1923 44.9941L83.9336 43.3077L81.7832 41.1997L79.8951 37.8796L80.4196 36.7202L79.4755 36.2459L78.5315 34.0852L76.5385 33.1893L75.4895 30.0273V24.5992L73.7063 21.1737L70.6643 17.4847L66.6783 15.4294L63.7937 14.9551L59.8601 12.5309H58.2867L55.1399 11.8985L53.4091 12.5309L51.5734 11.8985L49.7902 11.0553L46.8531 10.5283L44.8601 11.0553L41.6084 10.5283L39.2483 9L36.6783 9.3689L33.5315 9.6324L30.8042 10.5283L29.9126 11.5823L27.8147 12.7944L26.1888 14.4281L24.8776 15.0078L24.0385 16.2199L21.7832 17.6428L20.472 17.2739L21.1538 19.013H19.8427V18.2225L19.3182 17.9063H17.1678L15.0175 17.2739L14.7552 18.6441V19.4346L14.3357 20.8575L13.8636 21.9115V22.8074L14.3357 24.81V27.9193L12.9196 30.1327L9.93007 31.661L7.30769 31.9245L6.04895 33.8744L5 34.9811L6.04895 37.3526H5.68182V41.147L7.30769 43.4131L10.7168 46.1535L10.2972 46.8386L12.9196 49.948L13.1818 52.4249L15.1224 53.4789L16.1713 57.1679L14.021 60.4353L16.1713 64.8094L18.5315 66.6539L22.2028 69.3943V72.7144L30.7517 74.3481L34.2133 79.3019L38.9336 80.5667Z" />
    </svg>
</div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-ocean-600 dark:group-hover:text-ocean-400 transition-colors">
                        {{ __('La Réunion') }}
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ __('Notre base principale') }}</p>
                </a>

                <!-- Maurice -->
                <a href="{{ route('bateaux.index', ['zone' => 'maurice']) }}"
   title="{{ __('Voir tous les bateaux à vendre à Maurice') }}"
   class="group relative bg-gradient-to-br from-gray-50 to-white dark:from-slate-800 dark:to-slate-900 rounded-2xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 dark:border-white/10">
    
    <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-luxe-cyan to-ocean-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
        <svg class="w-10 h-10 text-white" viewBox="0 0 100 100" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M25.5875 41.3083L27.6469 38.6537L29.363 38.2255L30.0495 36.5985L34.769 35.3996H37.1716L38.0297 33.5157V32.1456L40.0891 30.6898H41.1188L40.4323 28.2921L41.462 26.6651L43.6073 25.6375L42.4059 23.4967L42.6634 22.3834L43.1782 21.6128V20.0714L44.2079 17.8449V16.2179L45.3234 15.1903L47.2112 14.334L48.0693 12.1075L49.5281 10.9943L49.8713 9.88107L48.8416 8.51094L49.099 7.56898L52.1023 8.08278L52.6172 9.88107L53.132 8.08278L55.0198 6.79829L55.5347 5.68506L58.0231 5L60.2541 5.2569L61.5413 5.77069L62.2277 5.2569L61.8845 6.37012L62.3993 7.22645L63.6865 7.65461H64.9736V7.05519C65.231 7.28354 65.763 7.75737 65.8317 7.82588C65.9003 7.89439 66.5468 8.42531 66.8614 8.68221L68.3201 8.85347L69.3498 9.196L69.264 11.5937L69.6931 12.5357L70.2937 13.392H71.4092C71.6381 13.2207 72.1129 12.8953 72.1815 12.9638C72.2502 13.0324 72.7822 13.4491 73.0396 13.6489L73.5545 14.334L71.5809 14.5052C71.0946 14.6194 70.1564 14.8306 70.2937 14.7621C70.4653 14.6765 70.0363 15.961 69.9505 16.0466C69.8818 16.1151 69.5215 16.8173 69.3498 17.1598L70.1221 18.4443L70.7228 19.6432L71.5809 20.5852C71.8383 20.7564 72.3703 21.1332 72.4389 21.2702C72.5076 21.4072 73.0396 22.0695 73.297 22.3834L74.0693 22.2978L73.7261 23.8392C74.1551 23.7821 75.0132 23.7022 75.0132 23.8392C75.0132 23.9762 75.0704 24.4101 75.099 24.6099L77.0726 25.1237L79.132 24.9524L80.2475 25.3806C80.2475 25.7802 80.2475 26.6308 80.2475 26.8363C80.2475 27.0419 80.648 27.4358 80.8482 27.607L81.2772 28.7203C81.2486 28.9772 81.1743 29.5081 81.1056 29.5766C81.0198 29.6622 80.505 29.6622 80.505 29.8335C80.505 29.9705 80.6194 30.5186 80.6766 30.7755L79.6469 31.2036L78.4455 31.5461L77.2442 32.2312L78.7888 32.6594C78.9032 32.9163 79.1492 33.4472 79.2178 33.5157C79.2865 33.5842 79.9901 34.5147 80.3333 34.9715L81.5347 34.4577L82.736 35.4853L83.3366 36.941L83.9373 38.3968V39.3387L85.1386 41.2226L86.1683 41.9933L86.5116 42.9353L87.0264 43.7916L87.6271 44.2198L88.2277 45.1618L89 46.0181L88.6568 46.8744C88.3135 46.9315 87.5927 47.0628 87.4554 47.1313C87.3182 47.1998 86.769 47.4453 86.5116 47.5595L85.8251 48.5014L86.0825 49.3578L87.7129 49.2721L88.1419 50.5566C88.1705 50.7564 88.2277 51.1903 88.2277 51.3273C88.2277 51.4643 87.7129 52.1265 87.4554 52.4405C87.5127 52.6974 87.6271 53.2284 87.6271 53.2969C87.6271 53.3654 86.8834 53.8963 86.5116 54.1532C86.5116 54.4957 86.5116 55.215 86.5116 55.352C86.5116 55.4891 86.2255 56.2084 86.0825 56.5509L84.538 55.7802L83.6799 57.1503L84.7096 58.2636L84.7954 59.8906L83.5941 60.8325L83.2508 61.6889L83.0792 62.5452L84.3663 63.5728L82.5644 63.9153V65.2854C82.3641 65.5423 81.9465 66.0904 81.8779 66.2274C81.7921 66.3987 80.2475 66.313 80.2475 66.3987C80.2475 66.4672 79.5039 67.1694 79.132 67.5119L78.3597 68.4539L77.5017 69.7383L76.2145 70.1665C75.8713 70.1951 75.1505 70.2521 75.0132 70.2521C74.8759 70.2521 74.4411 69.9096 74.2409 69.7383L73.3828 68.7108L72.6964 69.1389L72.5248 70.9372C72.5248 71.1941 72.5248 71.7593 72.5248 71.9648C72.5248 72.1703 72.1815 72.7926 72.0099 73.078L71.2376 73.3349L72.1815 74.4481C72.6106 74.648 73.4686 75.0647 73.4686 75.1332C73.4686 75.2188 74.2409 76.2464 74.2409 76.4177C74.2409 76.5547 74.527 77.274 74.67 77.6166C74.9274 77.7593 75.4766 78.079 75.6139 78.216C75.7512 78.353 76.2431 78.7869 76.4719 78.9867L76.3861 80.4424C76.0429 80.6422 75.3564 81.0932 75.3564 81.2988C75.3564 81.5557 74.0693 81.7269 73.9835 81.7269C73.9149 81.7269 73.0968 82.1265 72.6964 82.3264L72.0957 83.354L70.637 84.4672L69.9505 85.7517C69.5787 85.7802 68.8178 85.8716 68.7492 86.0086C68.6805 86.1456 68.3201 86.9791 68.1485 87.3787C67.5193 87.6356 66.2436 88.1665 66.1749 88.235C66.1063 88.3035 65.0022 88.8915 64.4587 89.177C63.8867 89.2626 62.7254 89.4339 62.6568 89.4339C62.571 89.4339 62.1419 89.9477 61.8845 90.0333C61.6785 90.1018 60.6546 90.0618 60.1683 90.0333L59.0528 90.804L58.0231 90.8896L56.9076 91.1465L54.4191 93.0305L52.1023 93.2017L51.33 93.8868L49.6997 93.5442L48.8416 94.2293H47.1254L46.0099 95L44.7228 94.5718L43.8647 94.058L43.0924 94.7431L41.1188 93.8011C40.747 93.8011 39.9347 93.8011 39.6601 93.8011C39.3168 93.8011 38.1155 93.9724 37.9439 93.9724C37.8066 93.9724 36.9142 93.6299 36.4851 93.4586L35.4554 92.3454L34.0825 91.5747H32.538C32.2233 91.803 31.5769 92.2769 31.5083 92.3454C31.4396 92.4139 30.6216 92.6594 30.2211 92.7736H29.363H28.3333L27.132 91.9172C26.5028 91.9743 25.2442 92.0542 25.2442 91.9172C25.2442 91.746 24.8152 90.8896 24.7294 90.8896C24.6607 90.8896 23.8999 90.7184 23.5281 90.6327L21.4686 89.177L20.4389 88.3207L19.1518 88.7488C18.8944 88.3777 18.3452 87.6185 18.2079 87.55C18.0706 87.4814 17.121 86.3796 16.6634 85.8373L15.2904 84.7241C14.89 84.5814 14.0548 84.2959 13.9175 84.2959C13.7802 84.2959 13.0594 84.6955 12.7162 84.8953L11.8581 85.5804L11 85.4091L11.0858 84.2103L12.1155 81.2988L13.231 79.7574C13.1738 80.1285 13.0937 80.8877 13.231 80.9562C13.3683 81.0247 14.604 81.2702 15.2046 81.3844H16.6634L18.5512 79.5861L19.2376 77.7878C18.923 77.4738 18.2422 76.863 18.0363 76.9315C17.7789 77.0171 16.7492 77.8735 16.6634 77.7878C16.5776 77.7022 16.6634 76.8459 17.0924 76.8459C17.4356 76.8459 18.4367 76.275 18.8944 75.9895C18.9802 75.5043 19.169 74.5167 19.2376 74.4481C19.3234 74.3625 21.4686 74.4481 21.4686 74.3625C21.4686 74.294 21.6975 73.1922 21.8119 72.6499C21.6689 72.3073 21.3485 71.6051 21.2112 71.5366C21.0396 71.451 20.0099 71.1085 19.6667 71.1085C19.3921 71.1085 19.0946 70.3092 18.9802 69.9096L19.8383 68.882L20.868 68.3682L19.9241 67.1694C19.6953 66.627 19.2376 65.5252 19.2376 65.4567C19.2376 65.3711 19.495 64.2579 19.6667 64.001C19.8383 63.7441 20.868 62.4596 21.0396 62.3739C21.1769 62.3054 22.0693 61.9458 22.4984 61.7745L21.8977 61.0038L21.0396 60.4044L20.0099 59.8906L19.5809 57.4072L19.9241 53.8963L21.0396 52.4405C21.44 51.784 22.2581 50.4367 22.3267 50.2997C22.3954 50.1627 22.7558 49.3863 22.9274 49.0152L22.4125 48.4158L22.7558 47.0457L23.3564 45.8468L23.6997 44.1342L24.3861 43.6204L25.5875 43.3635C25.7019 43.0209 25.9307 42.3187 25.9307 42.2502C25.9307 42.1817 25.7019 41.5937 25.5875 41.3083Z" />
        </svg>
    </div>

    <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-luxe-cyan transition-colors">
        {{ __('Maurice') }}
    </h3>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ __('Île Maurice') }}</p>
</a>

                <!-- Madagascar -->
                <a href="{{ route('bateaux.index', ['zone' => 'madagascar']) }}"
   title="{{ __('Voir tous les bateaux à vendre à Madagascar') }}"
   class="group relative bg-gradient-to-br from-gray-50 to-white dark:from-slate-800 dark:to-slate-900 rounded-2xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 dark:border-white/10">
    
    <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
        <svg class="w-10 h-10 text-white fill-current" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <path d="M27.228 71.0481L26.1688 72.738L26 72.6817L26.1688 75.0476C26.2988 75.348 26.559 76.0954 26.559 76.6812V77.9768L27.4509 79.5541L28.8446 80.7934L29.1791 82.934V84.1733L28.8446 85.4689V87.7785L29.1791 89.0741L30.6843 90.6514L30.9073 92.5103L31.855 93.9749L32.9699 94.8199L33.8061 95.8338H35.5901C36.1252 95.8338 36.8908 96.5849 37.2067 96.9604L38.7677 97.9744C39.0464 98.0307 39.7377 98.0307 40.2728 97.5801C40.808 97.1294 41.3135 97.3923 41.4993 97.5801C41.8709 97.4487 42.6923 97.1407 43.0045 96.9604C43.3947 96.7351 44.0079 96.2281 44.1752 96.0592C44.3424 95.8902 45.7918 95.6085 46.1263 95.4395C46.4608 95.2705 46.851 95.2705 47.9102 95.2142C48.7576 95.1691 49.3782 94.9325 49.5827 94.8199L51.0321 94.4819L52.0355 92.9046L52.593 91.2147C52.816 90.6326 53.2843 89.3895 53.3735 89.0741C53.485 88.6798 54.2654 87.1588 54.3769 86.9898C54.4884 86.8208 54.7672 84.7366 54.8229 84.4549C54.8675 84.2296 55.0273 83.5349 55.1016 83.2156C55.2875 82.934 55.7149 82.1904 55.9378 81.4694C56.2166 80.5681 56.4396 80.0048 56.4396 79.5541C56.4396 79.1035 56.7183 77.8078 57.0528 77.2445C57.3873 76.6812 57.0528 76.3432 57.0528 75.9489C57.0528 75.6335 57.4244 75.2166 57.6103 75.0476C57.6474 74.3716 57.811 72.9521 58.1677 72.6817C58.6137 72.3437 58.9482 71.3298 59.1155 70.8228C59.2827 70.3158 59.6172 69.0765 59.8959 68.7948C60.1747 68.5132 59.8959 67.1049 59.8959 66.9359C59.8959 66.8007 60.3419 65.8281 60.5649 65.3586L61.2339 63.3871V62.0351L61.6798 61.3028L62.0143 59.8945C62.2187 59.8194 62.6275 59.4889 62.6275 58.7679C62.6275 57.8666 63.185 57.1343 63.2965 56.7963C63.408 56.4583 63.5752 55.6697 63.854 54.9937C64.077 54.4529 64.2814 53.2662 64.3557 52.7405L65.5821 49.6986L66.3069 47.6706C66.5113 47.1073 66.9201 45.8568 66.9201 45.3611C66.9201 44.7414 67.4218 43.6148 67.4218 43.2768V41.5869C67.3289 41.3616 67.0985 40.8095 66.9201 40.4039C66.6971 39.8969 67.4218 40.1223 67.4218 39.8406V38.9393L67.812 38.4887L68.035 37.5874L69.5402 37.2494L69.2057 36.7424L69.5402 35.3341V33.9258C69.5402 33.5202 69.8747 32.9682 70.0419 32.7429L69.2057 31.9542L68.8155 31.2783L68.6937 30.4333L68.3695 28.7997L68.8155 27.4477H69.5402L70.0419 28.2364L70.4879 29.3067L71.1569 30.4333L72.0488 30.9403L72.7736 30.039C72.9036 29.8324 73.1638 29.2954 73.1638 28.7997C73.1638 28.304 73.7213 27.9923 74 27.8984V26.7154C73.7584 26.2648 73.253 25.3072 73.1638 25.0818C73.0746 24.8565 72.6806 24.0115 72.4948 23.6172C72.4577 23.2041 72.3164 22.2878 72.0488 21.9273C71.7813 21.5668 71.9373 20.688 72.0488 20.2937V18.7164C71.8259 18.078 71.3799 16.711 71.3799 16.3505C71.3799 15.8998 71.4356 15.6745 71.3799 14.9985C71.3241 14.3226 70.9339 13.9846 70.8781 13.5903C70.8224 13.1959 70.4879 12.0693 70.4879 11.7877C70.4879 11.506 70.0419 10.661 70.0419 10.1541C70.0419 9.74848 69.4845 9.15888 69.2057 8.91478L68.3695 8.46413L67.9793 7.56283V6.49253L67.1988 5.92922C67.013 5.74145 66.6413 5.30958 66.6413 5.08425C66.6413 4.8026 66.3069 3.95763 66.2511 3.95763C66.2065 3.95763 65.7866 3.31921 65.5821 3L65.2477 3.67597L64.3557 3.95763L64.9132 4.52094L64.1327 5.36591L63.408 6.15455L62.4603 6.49253C62.5532 6.77419 62.739 7.38257 62.739 7.56283C62.739 7.74309 63.185 8.53924 63.408 8.91478L63.185 10.1541L62.739 11.3933V12.4073L61.9586 13.1396H60.6764L60.3419 13.9846H59.7844V15.2239L59.1712 15.6745L58.558 14.6606L57.7775 13.9846L57.1085 14.3226L56.8298 15.6745L57.1085 16.8575L56.8298 17.9841V18.8854L56.1608 18.6037L55.7706 18.8854L55.1574 20.012L55.5476 20.9133V22.0399L54.3212 23.7862V22.9976L53.9309 22.0399L52.7045 22.9976L53.2062 23.5046C52.8717 23.6736 52.1805 24.0453 52.0913 24.1805C52.0021 24.3157 51.6825 24.9504 51.5338 25.2508L50.8648 25.7578H50.1959L49.3039 26.7718L47.6315 27.7857L47.074 28.2927L46.4608 29.025L46.851 29.87L46.4608 30.715L45.9591 29.6447L45.5688 29.025L44.8441 29.4193L44.2309 29.6447H43.3389H42.0568V30.2643L41.2205 30.715L40.1613 30.9966V31.5599L39.7711 31.2219L39.2694 30.715L38.6004 30.9966L37.7642 32.0669L37.3182 32.5176H36.482H34.8653H34.0849L33.5274 33.3062L34.0849 34.2075V34.9961V35.9538L33.5274 36.4607L33.2487 37.362L32.524 38.0943L31.9107 39.1646L31.2418 40.1223L30.517 42.0375L31.4648 43.3895V44.4034V45.4174V46.9383V47.896L32.1895 49.1916L32.524 50.2056V51.1068L32.8027 52.4025L33.5274 53.8107L34.0849 54.9937L34.3636 55.6697L33.5274 56.6836V57.3596L34.3636 58.5426L33.5274 60.1762L33.0814 61.1901L32.1895 62.4858L30.517 65.1333L29.9596 66.091V67.2176L28.7331 67.9499L28.1757 68.2315L27.8969 68.9638L27.6739 70.4285L27.228 71.0481Z" />
        </svg>
    </div>

    <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
        {{ __('Madagascar') }}
    </h3>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ __('Grande Île') }}</p>
</a>

                <!-- Seychelles -->
                <a href="{{ route('bateaux.index', ['zone' => 'seychelles']) }}"
   title="{{ __('Voir tous les bateaux à vendre aux Seychelles') }}"
   class="group relative bg-gradient-to-br from-gray-50 to-white dark:from-slate-800 dark:to-slate-900 rounded-2xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 dark:border-white/10">
    
    <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg overflow-hidden">
        <svg viewBox="0 0 100 100" class="w-16 h-16 text-white stroke-current fill-current" xmlns="http://www.w3.org/2000/svg">
            <path d="M47.1639 31.4808L47.605 31.7967L47.6996 31.8283M47.1639 31.4808L46.7227 31.1648L48.2353 30.7857V32.1758L47.6996 31.8283M47.1639 31.4808L47.6996 31.8283M5 43.4231V45.4451H7.39496L5 43.4231ZM16.5966 50.1209L14.7059 47.467V46.456L16.5966 47.467V50.1209ZM12.437 39.8846L9.28571 40.6429L6.13445 39.1264V37.8626L8.90756 38.8736L9.78992 38.6209L7.77311 36.0934L9.03361 34.7033L10.5462 34.4506L13.9496 32.1758L17.479 31.7967L20.7563 31.1648L22.2689 30.4066L23.6555 29.0165L24.5378 26.489V22.9505L25.042 18.6538V16L26.6807 16.6319H29.8319L31.2185 18.6538L32.7311 20.044L33.6134 22.4451L32.7311 22.9505L31.9748 24.5934C31.7227 24.7619 31.2185 25.1495 31.2185 25.3516C31.2185 25.5538 31.3866 26.2784 31.4706 26.6154L31.9748 27.7527V29.0165C31.8067 29.4799 31.4706 30.4824 31.4706 30.7857C31.4706 31.089 31.3025 31.8388 31.2185 32.1758C31.0504 32.3443 30.7143 32.8077 30.7143 33.3132C30.7143 33.8187 30.7143 34.2821 30.7143 34.4506L32.2269 34.7033L32.7311 34.4506L33.6134 35.2088L33.4874 35.8407L35 36.0934L35.6303 37.8626L38.0252 40.6429L37.521 41.1484L35 38.7473L34.6219 39.1264L38.4034 42.6648H39.2857L38.4034 41.1484H39.2857L40.4202 41.6538V42.6648H41.4286L43.4454 44.5604L41.4286 44.3077L42.6891 45.9506L43.8235 45.4451H44.5798L45.084 45.9506H45.9664V45.4451L46.7227 45.9506L50.8824 48.8571L52.395 48.2253L52.8992 49.7418C51.7647 51.0055 49.4706 53.5835 49.3698 53.7857C49.2437 54.0385 48.7395 55.3022 48.7395 55.6813C48.7395 56.0604 48.7395 57.3242 48.7395 58.0824C48.7395 58.689 49.1597 59.5147 49.3698 59.8517C49.6639 60.5678 50.2773 62.2275 50.3782 63.1374C50.479 64.0473 51.0084 64.696 51.2605 64.9066L49.3698 66.1703L47.9832 67.0549V70.8462L48.6134 71.478V73.3736H49.7479C49.958 73.8791 50.3782 74.9659 50.3782 75.2692C50.3782 75.5725 50.3782 77.9231 50.3782 79.0604L52.1429 80.5769L53.6555 81.3352L53.9076 82.7253C54.0756 82.8095 54.4118 83.0791 54.4118 83.4835C54.4118 83.8879 54.4118 84.1575 54.4118 84.2418H53.0252L51.0084 83.7363H49.7479C49.6219 83.7784 49.3698 83.9385 49.3698 84.2418C49.3698 84.5451 49.2017 84.8736 49.1176 85H47.9832V83.7363L46.0924 83.4835L45.7143 82.0934L44.2017 81.7143L43.3193 80.5769L43.5714 79.0604L42.9412 78.5549H41.4286V77.2912V75.9011L38.6555 73.6264L38.7815 71.7308L37.0168 70.8462L35.3782 72.1099L34.1176 73.6264L32.3529 70.8462H33.2353V69.3297V68.1923L33.7395 66.6758H40.2941V64.1484L37.0168 61.1154L36.6387 59.4725L38.6555 58.7143L36.6387 56.1868L35.3782 56.5659L34.6219 56.9451L30.9664 52.6484V51.7637V51.2582L30.084 50.7527L28.6975 48.6044C28.3613 48.3517 27.5882 47.922 27.1849 48.2253C26.6807 48.6044 25.042 49.1099 24.916 48.8571C24.8151 48.6549 23.6134 47.8462 23.0252 47.467L19.3697 44.9396L18.1092 43.9286V43.4231L15.3361 43.9286L13.9496 42.6648L14.958 41.9066L14.7059 41.1484L12.9412 39.8846H12.437ZM32.2269 25.8571V24.9725L32.9832 23.5824H33.4874L33.6134 25.3516L32.9832 25.8571H32.2269ZM32.605 26.8681L32.9832 27.7527L32.7311 29.0165L33.4874 29.6484L34.3697 29.7747V30.7857C34.5798 30.87 35 30.9121 35 30.4066C35 29.9011 35 29.2692 35 29.0165V28.1319L32.605 26.8681ZM32.2269 29.7747V31.4176L33.1092 32.4286L33.4874 31.7967L32.2269 29.7747ZM35 32.8077V34.7033L35.8824 35.3352L35.6303 33.3132L35 32.8077ZM36.1345 37.2308C36.2353 37.433 36.5966 38.2418 36.7647 38.6209L37.521 38.8736L38.4034 39.1264L37.7731 38.1154L36.7647 36.5989L36.1345 37.2308ZM41.4286 36.0934L41.6807 35.0824L43.4454 35.3352L44.5798 35.8407V38.6209L41.4286 36.5989V36.0934ZM45.4622 34.7033L47.605 35.8407V34.7033L45.9664 34.0714L45.4622 34.7033ZM42.563 30.7857C42.9664 30.7857 44.0756 30.533 44.5798 30.4066L46.2185 29.3956V28.1319L45.4622 26.7418C45.2101 26.5311 44.605 26.1857 44.2017 26.489C43.6975 26.8681 42.9412 27.3736 42.8151 27.6264C42.6891 27.8791 42.563 29.1429 42.563 29.3956C42.563 29.5978 42.563 30.4066 42.563 30.7857ZM64.874 22.9505L65.8824 25.8571L68.1513 26.6154H69.4118L70.5462 29.3956L73.0672 29.7747L73.9496 31.1648L74.8319 29.7747L76.0924 29.6484L74.8319 27.6264V26.7418C75.2521 26.6996 76.0924 26.6407 76.0924 26.7418C76.0924 26.8429 76.6807 27.4579 76.9748 27.7527L78.1092 26.8681L76.9748 25.3516L74.8319 24.9725L71.8067 23.5824L70.5462 24.9725L69.4118 24.5934L68.1513 22.4451H66.8908L64.874 22.9505ZM70.5462 21.8132L68.5294 20.2967H71.8067L70.5462 21.8132ZM83.2773 27.7527C83.0756 28.7637 82.605 29.9432 82.395 30.4066L83.7815 32.8077L85.7983 32.4286V31.1648L83.2773 27.7527ZM88.0672 25.8571L89.7059 28.1319V26.7418L88.0672 25.3516L87.437 25.8571H88.0672ZM94.7479 27.6264L94.3698 28.511L94.7479 29.1429L95 28.511L94.7479 27.6264ZM87.6891 21.5604C87.7899 21.5604 88.2353 22.2344 88.4454 22.5714L88.9496 22.4451L88.1933 21.0549L87.6891 21.5604ZM86.4286 20.8022L87.1849 21.8132L86.8067 22.0659L86.0504 21.0549L86.4286 20.8022Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>

    <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
        {{ __('Seychelles') }}
    </h3>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
        {{ __('Archipel paradisiaque') }}
    </p>
</a>

                <!-- Mayotte -->
                <a href="{{ route('bateaux.index', ['zone' => 'mayotte']) }}"
   title="{{ __('Voir tous les bateaux à vendre à Mayotte') }}"
   class="group relative bg-gradient-to-br from-gray-50 to-white dark:from-slate-800 dark:to-slate-900 rounded-2xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 dark:border-white/10 col-span-2 sm:col-span-1 lg:col-span-1">
    
    <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
    <svg class="w-12 h-12 text-white" viewBox="0 0 100 100" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M27.4525 72.3389V71.29V71.057H30.8448C31.1958 71.057 32.4825 70.5908 33.0674 70.7074C33.6523 70.8239 33.6523 70.4743 34.4712 70.4743C35.1262 70.4743 35.29 71.0181 35.29 71.29C35.407 71.562 35.6409 72.1524 35.6409 72.3389C35.6409 72.5719 36.1089 72.805 36.1089 73.0381C36.1089 73.2245 35.8749 73.6596 35.7579 73.8538V75.6019C35.7579 75.8816 36.2258 76.4953 36.4598 76.7672C36.5768 76.9615 36.8575 77.3499 37.0447 77.3499C37.2786 77.3499 38.2145 78.0491 38.3314 78.1657C38.4484 78.2822 39.3842 78.5153 40.0861 79.098C40.788 79.6806 40.671 78.9814 41.1389 79.098C41.6068 79.2145 41.4898 79.098 41.4898 79.4476C41.4898 79.7972 42.4257 80.3799 42.8936 80.4964C43.3615 80.6129 44.7652 80.4964 45.2331 80.4964C45.7011 80.4964 46.6369 80.1468 46.7539 80.0302C46.8708 79.9137 47.4557 78.9814 47.4557 78.7483C47.4557 78.5153 47.2218 78.1657 47.1048 78.0491C46.9878 77.9326 47.1048 77.4665 47.3387 76.5342C47.5259 75.7883 47.2608 75.7573 47.1048 75.8349C47.1048 75.6019 47.0814 75.0658 46.9878 74.7861C46.8708 74.4365 46.4029 73.8538 45.818 73.3877C45.3501 73.0148 45.5451 72.3777 45.7011 72.1058C45.3891 72.067 44.7184 71.9193 44.5313 71.6397C44.2973 71.29 44.8822 70.7074 44.5313 70.4743C44.1803 70.2412 44.5313 69.8916 44.0634 69.542C43.5954 69.1924 42.6596 68.1436 42.6596 67.6774C42.6596 67.3045 41.4898 67.289 40.905 67.3278C40.905 67.1724 40.8348 66.8384 40.554 66.7451C40.2031 66.6286 39.7352 65.8129 39.3842 65.3467C39.1035 64.9738 38.7214 64.4144 38.5654 64.1814C38.5264 63.7929 38.4484 62.9927 38.4484 62.8995C38.4484 62.8062 38.1365 62.3168 37.9805 62.0837L35.9919 62.3168C35.563 62.1226 34.6583 61.571 34.4712 60.9184C34.284 60.2658 34.0032 60.1026 33.8863 60.1026C33.6523 60.0638 33.1142 59.9394 32.8335 59.753C32.4825 59.5199 32.5995 59.1703 32.9504 58.9372C33.3014 58.7042 34.0032 58.7042 34.2372 58.7042C34.4712 58.7042 34.9391 58.3546 35.0561 58.238C35.1496 58.1448 35.095 57.5777 35.0561 57.3057C35.212 57.1115 35.5474 56.7231 35.6409 56.7231C35.7579 56.7231 36.1089 57.0727 36.3428 57.0727H37.3956C37.5126 57.0727 39.2673 56.7231 39.2673 56.49C39.2673 56.2569 38.6824 55.6742 38.5654 55.4412C38.4484 55.2081 37.8635 55.0916 37.5126 55.0916H36.3428C35.8749 54.975 34.9391 54.7186 34.9391 54.6254C34.9391 54.5089 35.173 53.6931 35.29 53.3435C35.407 52.9939 35.7579 52.1782 35.7579 51.9451C35.7579 51.712 35.7579 51.1293 35.8749 50.8963C35.9919 50.6632 36.3428 50.5467 36.3428 50.3136C36.3428 50.1271 35.9529 48.9928 35.7579 48.449L34.9391 47.1671V45.186C34.9391 45.0928 35.251 44.7587 35.407 44.6033C35.7579 44.681 36.5066 44.7898 36.6937 44.6033C36.8809 44.4169 36.9277 44.0595 36.9277 43.9041L36.2258 43.671L35.173 43.7876C34.7831 43.5933 34.0032 43.1816 34.0032 43.0884V42.0395L33.5353 41.4569L34.3542 40.8742C34.6271 40.5634 35.173 39.8487 35.173 39.4757V38.5435C35.173 38.4502 35.485 38.1938 35.6409 38.0773L35.173 37.6112V36.5623C35.173 36.2127 34.9391 36.3293 34.7051 36.4458C34.518 36.539 34.5491 37.2616 34.5881 37.6112C34.0812 37.7665 33.044 38.0773 32.9504 38.0773C32.8569 38.0773 31.6637 37.0673 31.0788 36.5623L29.6751 37.145L27.8034 35.9797L26.0487 34.5812C25.8538 34.3093 25.4405 33.6723 25.3469 33.2993C25.2533 32.9264 25.0739 33.144 24.9959 33.2993H23.7092C23.6156 33.2993 23.0463 34.0762 22.7734 34.4647L22.5394 33.0663H21.3696L20.4338 32.0174C20.3558 31.7455 20.1998 31.1551 20.1998 30.9686C20.1998 30.7355 20.4338 31.3182 20.7847 30.7355C21.0655 30.5491 21.2136 29.9586 21.2526 29.6867C21.4866 29.7644 22.0481 29.8732 22.4224 29.6867C22.8903 29.4537 23.3582 28.7544 23.3582 28.5214C23.3582 28.2883 23.8262 27.9387 23.8262 27.8222V26.4237C23.7482 26.3072 23.5688 26.0508 23.4752 25.9576C23.3816 25.8643 22.5784 25.841 22.1885 25.841C21.9545 25.7245 21.4398 25.4914 21.2526 25.4914C21.0655 25.4914 20.6288 25.9576 20.4338 26.1906L19.7319 25.841C19.6539 25.6857 19.498 25.3516 19.498 25.2584C19.498 25.1418 19.9659 25.1418 20.1998 25.0253C20.4338 24.9088 21.2526 23.8599 21.2526 23.5103C21.2526 23.2306 22.0325 22.6169 22.4224 22.345V21.4127L21.9545 20.3639L22.7734 19.315C23.0853 19.4316 23.7326 19.6646 23.8262 19.6646C23.9197 19.6646 24.723 19.82 25.1129 19.8977L26.5167 19.315C26.5556 18.9266 26.6102 18.1264 26.5167 18.0331C26.4231 17.9399 26.7116 18.072 26.8676 18.1497L27.8034 17.8001C27.7644 17.4116 27.7566 16.5881 28.0374 16.4016C28.3181 16.2152 27.6084 15.8578 27.2185 15.7024L26.3997 15.5859V14.7701H27.3355C27.5305 14.8867 28.1076 15.1197 28.8562 15.1197C29.792 15.1197 29.4411 15.1197 30.26 14.7701C31.0788 14.4205 30.3769 13.8378 30.3769 13.7213V12.3229C30.5719 11.9733 30.9618 11.2507 30.9618 11.1575C30.9618 11.0643 31.3517 10.8856 31.5467 10.8079C31.8587 10.6914 32.5527 10.4117 32.8335 10.2252C33.1844 9.99216 33.1844 9.87562 33.1844 9.52601C33.1844 9.1764 33.1844 8.94333 32.9504 8.59372C32.7633 8.31404 33.0284 8.32181 33.1844 8.36065L33.8863 8.59372C34.1202 8.51603 34.6817 8.29073 35.0561 8.01104C35.524 7.66144 35.6409 7.42836 35.6409 7.19529C35.6409 7.00884 36.2648 6.72915 36.5768 6.61261L37.0447 7.42836L36.2258 8.12758L35.9919 9.1764L36.6937 9.87562L34.9391 10.5748L32.3656 12.0898L34.1202 12.4394C34.5491 12.7502 35.3836 13.3717 35.29 13.3717H35.8749L36.6937 13.7213L35.9919 14.8867L37.3956 15.1197V15.9355L38.4484 16.052L38.5654 16.6347L38.0975 17.4505L39.0333 18.4993L40.554 18.9654L41.8408 19.8977L42.6596 19.315L43.2445 19.5481L43.4785 20.3639L43.3615 21.2961L42.6596 20.83H41.8408L41.4898 21.9954L41.8408 22.8111L42.5426 23.5103L43.0106 25.1418L43.7124 25.608L43.8294 26.4237L46.2859 26.6568L46.8708 25.9576L47.1048 26.4237L47.4557 26.7733L48.1576 27.356L47.9236 27.8222C48.0796 27.9775 48.4617 28.3349 48.7425 28.5214C49.0232 28.7078 49.7953 28.5991 50.1462 28.5214C50.0682 28.366 49.9825 27.9387 50.2632 27.4725C50.6141 26.8899 51.082 26.6568 51.199 26.4237C51.316 26.1906 51.55 25.9576 51.55 25.7245C51.55 25.4914 51.199 25.0253 51.199 24.9088C51.199 24.8155 51.0431 24.4038 50.9651 24.2095L51.7839 23.9765L54.3574 26.7733L55.1763 27.0064L56.2291 26.4237H56.931V26.7733H58.3347L58.8026 27.4725H60.6742C60.7678 27.4725 61.2591 27.1618 61.4931 27.0064L62.4289 27.4725L62.5459 28.2883H63.1308L63.4817 27.8222H64.4175L64.5345 28.2883L64.1836 29.2206C64.2226 29.4537 64.324 29.9431 64.4175 30.0363C64.5111 30.1296 65.0804 30.2306 65.3534 30.2694C65.5873 30.4636 66.102 30.8521 66.2892 30.8521C66.4764 30.8521 66.7571 30.619 66.8741 30.5025L67.459 30.8521V31.5513L68.0439 32.134L69.7985 32.8332L70.1495 33.4159L70.3834 34.6978L70.8513 35.7466L70.6174 36.2127L69.7985 37.145L69.6816 38.8931L68.9797 39.0096V39.5923L70.3834 40.5246L70.6174 41.923L70.0325 42.5057L69.2136 41.923L68.2778 42.1561L66.0552 43.438L65.7043 43.9041L65.3534 44.4868L64.8855 46.5844L64.0666 47.0506L63.5987 47.6333C63.2478 47.8275 62.5459 48.2392 62.5459 48.3325C62.5459 48.4257 62.156 48.9928 61.961 49.2648L61.844 50.6632C61.3761 50.9351 60.3467 51.5022 59.9724 51.5955C59.598 51.6887 59.3485 52.1782 59.2705 52.4112L59.5045 53.3435H60.2063C60.5807 53.3435 60.3623 53.6543 60.2063 53.8097L59.7384 54.3923L59.0366 55.4412C59.1145 56.0627 59.3641 57.3057 59.7384 57.3057C60.1128 57.3057 59.5825 57.6942 59.2705 57.8884L59.7384 58.5876C59.7384 58.9372 59.7852 59.6365 59.9724 59.6365C60.1595 59.6365 60.2843 59.4811 60.3233 59.4034H61.0252L61.1422 60.2191L61.3761 61.0349C61.5711 61.3456 62.078 61.9206 62.5459 61.7341C63.0138 61.5476 63.1308 61.4233 63.1308 61.3845L63.5987 61.6176V62.7829L63.3647 63.3656L63.8327 64.2979L64.3006 64.4144L64.7685 64.1814C64.9244 64.1037 65.33 63.925 65.7043 63.8317C66.0786 63.7385 66.1722 64.026 66.1722 64.1814V65.2302L65.0024 66.8617L65.2364 67.3278V67.794L65.0024 68.3766H64.3006L63.9496 68.9593L63.3647 69.542L61.7271 70.4743L60.3233 70.8239L60.0894 71.6397V72.5719L60.4403 73.3877L60.0894 74.4365L60.4403 75.0192L61.4931 76.1846L63.1308 77.1168L62.7799 77.583L62.078 77.2334H61.2591C60.7912 77.1168 59.8086 76.8605 59.6214 76.7672C59.4343 76.674 58.9976 76.3399 58.8026 76.1846H57.7498L56.931 76.3011L56.58 77.1168L56.931 77.583L57.1649 78.2822H55.7612L55.0593 78.9814C54.9423 79.2145 54.7084 79.7039 54.7084 79.7972C54.7084 79.8904 54.5524 80.3022 54.4744 80.4964L55.0593 81.1956L55.4102 81.6617C55.4102 81.9337 55.457 82.5008 55.6442 82.594C55.8314 82.6873 55.8781 82.866 55.8781 82.9436L55.7612 83.2932C55.5662 83.2932 55.1529 83.2699 55.0593 83.1767C54.9657 83.0835 54.2405 82.8271 53.8895 82.7106L53.1877 82.8271L52.8367 83.8759L53.0707 84.9248C53.4606 85.2744 54.2872 85.9736 54.4744 85.9736C54.7084 85.9736 54.4744 86.3232 54.7084 86.3232C54.8955 86.3232 54.7864 87.4885 54.7084 88.0712L55.4102 88.887C55.6052 88.9647 56.0185 89.12 56.1121 89.12C56.2057 89.12 56.853 89.5862 57.1649 89.8193L57.6328 89.4697L58.1007 89.5862L58.8026 90.8681H60.0894L61.0252 90.635L61.7271 90.9846C61.6101 91.14 61.3761 91.4974 61.3761 91.6838C61.3761 91.8703 60.9862 91.9946 60.7912 92.0334L61.0252 92.8492L60.4403 93.0823L59.6214 93.3153L59.2705 94.4807H58.4517C58.1397 94.3253 57.5158 93.9912 57.5158 93.898C57.5158 93.8048 56.892 93.7038 56.58 93.6649L55.4102 93.898V94.4807C55.3322 94.7138 55.1763 95.2032 55.1763 95.2964C55.1763 95.3897 55.4102 95.8791 55.5272 96.1122L54.7084 96.5783C54.4744 96.5006 54.0065 96.322 54.0065 96.2287C54.0065 96.1355 53.9285 95.5684 53.8895 95.2964V94.3642C53.8895 94.0145 53.6556 93.4319 53.6556 93.3153C53.6556 93.2221 53.4996 92.7327 53.4216 92.4996L52.3688 91.3342L51.55 91.4508C51.238 91.645 50.5907 92.0801 50.4972 92.2665C50.4036 92.453 49.9123 92.655 49.6783 92.7327L49.7953 93.6649L50.2632 94.4807L49.7953 95.1799C49.4054 95.6849 48.6021 96.7182 48.5085 96.8114C48.4149 96.9046 48.2356 97.3164 48.1576 97.5106C47.8846 97.6272 47.3154 97.8835 47.2218 97.9768C47.1282 98.07 47.1048 97.8602 47.1048 97.7437L46.4029 97.5106L46.052 97.7437H45.5841C45.5061 97.6272 45.3501 97.3708 45.3501 97.2776C45.3501 97.1843 45.0382 96.6172 44.8822 96.3453L44.2973 95.6461H43.8294L43.3615 96.1122L42.7766 96.3453H42.0747H41.7238L41.4898 95.6461C41.4119 95.4907 41.2559 95.1333 41.2559 94.9468V93.898C41.2559 93.4319 40.9439 93.4707 40.788 93.5484C40.593 93.4319 40.1797 93.1988 40.0861 93.1988H39.2673L38.6824 93.5484L38.0975 94.1311L37.8635 94.9468V95.6461C37.7465 95.8014 37.4658 96.1122 37.2786 96.1122C37.0447 96.1122 37.0447 95.6461 36.9277 95.6461C36.8341 95.6461 36.4208 95.1799 36.2258 94.9468V94.4807C36.2258 94.3642 36.4598 94.1311 36.5768 93.898C36.6703 93.7116 36.7717 93.6649 36.8107 93.6649V92.8492C36.8107 92.7327 36.6937 92.15 36.6937 92.0334C36.6937 91.9402 36.5378 91.6061 36.4598 91.4508C36.4598 91.2954 36.4832 90.938 36.5768 90.7515C36.6937 90.5185 36.9277 90.5185 37.0447 90.2854C37.1383 90.0989 37.1617 89.7416 37.1617 89.5862V88.5374V87.9547C37.0447 87.8382 36.7873 87.6051 36.6937 87.6051C36.6002 87.6051 36.4988 87.2943 36.4598 87.1389C36.2648 87.2555 35.8515 87.5118 35.7579 87.6051C35.6643 87.6983 35.407 87.877 35.29 87.9547C35.251 88.1101 35.1262 88.4441 34.9391 88.5374C34.7519 88.6306 34.6271 88.7316 34.5881 88.7704L34.2372 88.5374L33.6523 89.0035L33.0674 89.12C32.7555 88.9258 32.1082 88.5374 32.0146 88.5374C31.921 88.5374 31.7417 88.1489 31.6637 87.9547C31.4687 87.9158 31.032 87.8615 30.8448 87.9547C30.6577 88.0479 30.3769 88.1489 30.26 88.1878L29.4411 88.0712L29.5581 87.372L30.3769 86.6728L31.4297 86.5563L31.6637 85.9736L32.7165 85.7405C33.0674 85.6628 33.8161 85.4142 34.0032 85.0413C34.1904 84.6684 34.3932 84.109 34.4712 83.8759L34.9391 83.6429C35.0171 83.4875 35.1964 83.1068 35.29 82.8271C35.407 82.4775 35.29 82.1279 35.29 81.8948C35.29 81.7084 35.212 81.351 35.173 81.1956L35.6409 80.7295V79.4476L35.173 78.5153H34.0032C33.4963 78.826 32.4591 79.4709 32.3656 79.5641C32.272 79.6573 31.7027 79.5253 31.4297 79.4476V79.098L32.2486 78.2822L30.026 76.4176V75.3688L29.4411 74.7861L29.2071 73.7373V72.9215L28.7392 72.3389H27.4525Z" />
            <path d="M75.7644 40.5246L74.5946 40.2915L74.3607 40.5246L75.0625 41.6899L75.5305 42.5057H76.5833L78.8058 43.9041L79.2738 45.5356L80.2096 46.1183L80.7945 48.3325L81.0284 49.2648L83.0171 50.197V49.2648L82.1982 47.6333L83.0171 45.8852L83.7189 45.5356C84.1089 45.3025 84.9589 44.7665 85.2396 44.4868C85.5906 44.1372 84.8887 43.438 84.7717 43.3214C84.6547 43.2049 85.2396 42.5057 85.7076 42.1561C86.1755 41.8065 85.9415 41.6899 85.9415 40.2915C85.9415 39.8253 85.2396 39.6311 84.8887 39.5923V38.4269C84.8887 37.8442 84.3038 37.4946 84.0699 36.7954C83.8827 36.236 83.446 35.8631 83.251 35.7466L82.1982 34.6978C81.9253 35.2028 81.356 36.2127 81.2624 36.2127C81.1688 36.2127 80.2876 37.0673 79.8587 37.4946L78.221 39.0096L77.4021 39.5923C77.1292 39.4757 76.5833 39.3126 76.5833 39.5923C76.5833 39.872 76.0374 40.3303 75.7644 40.5246Z" />
            <path d="M15.0528 4.6315L16.5735 3L18.3282 4.16536L18.7961 4.39843L19.498 5.33072L20.5508 5.68033V6.61261L18.9131 7.19529L18.5621 8.01104L17.7433 8.47719L17.1584 8.12758L17.0414 8.8268L16.5735 9.1764L16.2226 8.24412L17.0414 7.42836C16.8855 7.1176 16.5735 6.47277 16.5735 6.37954C16.5735 6.28631 16.0276 6.02993 15.7547 5.9134L14.8188 6.26301L14 5.9134L14.3509 5.44725L14 4.98111L14.234 4.6315H15.0528Z" />
        </svg>
    </div>

    <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
        {{ __('Mayotte') }}
    </h3>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ __('Lagon préservé') }}</p>
</a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-20 md:py-28 bg-gradient-to-br from-ocean-50 via-cyan-50 to-ocean-100 dark:from-slate-950 dark:via-ocean-950 dark:to-slate-900">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-5xl font-black text-gray-900 dark:text-white mb-6">
                    {{ __('Pourquoi choisir My Boat ?') }}
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                $advantages = [
                    ['icon' => 'fa-shield-check', 'title' => __('100% Sécurisé'), 'desc' => __('Transactions protégées et vendeurs vérifiés pour votre tranquillité d\'esprit'), 'gradient' => 'from-ocean-500 to-ocean-600'],
                    ['icon' => 'fa-bolt', 'title' => __('Réponse Rapide'), 'desc' => __('Estimation et réponse à vos demandes sous 48h maximum, 7j/7'), 'gradient' => 'from-luxe-cyan to-ocean-500'],
                    ['icon' => 'fa-users', 'title' => __('Experts Locaux'), 'desc' => __('Une équipe passionnée qui connaît parfaitement l\'océan Indien'), 'gradient' => 'from-purple-500 to-purple-600'],
                    ['icon' => 'fa-chart-line', 'title' => __('Prix Justes'), 'desc' => __('Estimation gratuite et transparence sur les prix du marché'), 'gradient' => 'from-amber-500 to-amber-600'],
                ];
                @endphp

                @foreach($advantages as $advantage)
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-br {{ $advantage['gradient'] }} rounded-3xl opacity-0 group-hover:opacity-10 dark:group-hover:opacity-20 transition-opacity"></div>
                    <div class="relative bg-white dark:bg-slate-900 border-2 border-gray-100 dark:border-white/10 rounded-3xl p-8 group-hover:border-ocean-200 dark:group-hover:border-ocean-800 transition-all transform hover:-translate-y-2 shadow-lg hover:shadow-2xl">
                        <div class="w-16 h-16 bg-gradient-to-br {{ $advantage['gradient'] }} rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform">
                            <i class="fas {{ $advantage['icon'] }} text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-black text-gray-900 dark:text-white mb-3">{{ $advantage['title'] }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ $advantage['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-ocean-50 via-cyan-50 to-ocean-100 dark:from-slate-950 dark:via-ocean-950/50 dark:to-slate-900"></div>
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-ocean-300 dark:bg-ocean-600 rounded-full filter blur-3xl animate-float"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-luxe-cyan rounded-full filter blur-3xl animate-float" style="animation-delay: 2s;"></div>
        </div>

        <div class="relative container mx-auto px-4">
            <div class="max-w-5xl mx-auto text-center">
                <h2 class="text-3xl md:text-5xl font-black mb-6 text-gray-900 dark:text-white">
                    {{ __('Vendez votre bateau avec My Boat') }}
                </h2>
                <p class="text-xl md:text-2xl text-gray-700 dark:text-gray-300 mb-12 max-w-3xl mx-auto">
                    {{ __('Confiez-nous votre bateau et bénéficiez de notre expertise pour une vente rapide au meilleur prix dans l\'Océan Indien.') }}
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                    <a href="{{ route('sell') }}" class="group relative px-10 py-5 bg-gradient-to-r from-ocean-600 to-luxe-cyan text-white rounded-2xl font-black text-lg overflow-hidden transition-all hover:shadow-2xl transform hover:scale-105">
                        <span class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></span>
                        <span class="relative z-10 flex items-center">
                            <i class="fas fa-rocket mr-3"></i>
                            {{ __('Estimer mon bateau') }}
                        </span>
                    </a>
                    <a href="{{ route('contact') }}" class="group px-10 py-5 border-2 border-ocean-600 dark:border-ocean-400 text-ocean-600 dark:text-ocean-400 rounded-2xl font-black text-lg hover:bg-ocean-600 hover:dark:bg-ocean-500 hover:text-white transition-all transform hover:scale-105">
                        <i class="fas fa-phone mr-3"></i>
                        {{ __('Nous contacter') }}
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="grid grid-cols-3 gap-8 max-w-3xl mx-auto">
                    <div class="group">
                        <div class="text-4xl md:text-5xl font-black mb-2 bg-gradient-to-r from-ocean-600 to-luxe-cyan bg-clip-text text-transparent group-hover:scale-110 transition-transform">100%</div>
                        <div class="text-gray-600 dark:text-gray-400 text-sm md:text-base">{{ __('Gratuit') }}</div>
                    </div>
                    <div class="group">
                        <div class="text-4xl md:text-5xl font-black mb-2 bg-gradient-to-r from-ocean-600 to-luxe-cyan bg-clip-text text-transparent group-hover:scale-110 transition-transform">48h</div>
                        <div class="text-gray-600 dark:text-gray-400 text-sm md:text-base">{{ __('Réponse') }}</div>
                    </div>
                    <div class="group">
                        <div class="text-4xl md:text-5xl font-black mb-2 bg-gradient-to-r from-ocean-600 to-luxe-cyan bg-clip-text text-transparent group-hover:scale-110 transition-transform">0€</div>
                        <div class="text-gray-600 dark:text-gray-400 text-sm md:text-base">{{ __('Frais cachés') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SEO Content Section - Expertise Block (Discret, en bas de page) -->
    <section class="py-12 md:py-16 bg-gray-50 dark:bg-slate-950 border-t border-gray-100 dark:border-white/5">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6">
                    {{ __('My Boat, votre courtier maritime dans l\'Océan Indien') }}
                </h2>

                <div class="prose prose-gray dark:prose-invert max-w-none text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                    <p class="mb-4">
                        {{ __('Spécialiste de la') }} <strong class="text-gray-700 dark:text-gray-300">{{ __('vente de bateaux à La Réunion, Maurice, Madagascar, Seychelles et Mayotte') }}</strong>,
                        {{ __('My Boat vous accompagne dans l\'achat ou la vente de votre bateau d\'occasion ou neuf. Depuis notre base au Port de La Réunion, nous couvrons l\'ensemble de l\'Océan Indien.') }}
                    </p>

                    <p class="mb-4">
                        {{ __('Que vous recherchiez un') }} <strong class="text-gray-700 dark:text-gray-300">{{ __('voilier monocoque') }}</strong>,
                        {{ __('un') }} <strong class="text-gray-700 dark:text-gray-300">{{ __('catamaran à voile') }}</strong>,
                        {{ __('un') }} <strong class="text-gray-700 dark:text-gray-300">{{ __('catamaran à moteur') }}</strong>
                        {{ __('ou un') }} <strong class="text-gray-700 dark:text-gray-300">{{ __('bateau de pêche') }}</strong>,
                        {{ __('notre équipe d\'experts locaux vous propose une sélection rigoureuse aux prix du marché. Nous connaissons parfaitement les spécificités de la navigation dans l\'Océan Indien.') }}
                    </p>

                    <p>
                        <strong class="text-gray-700 dark:text-gray-300">{{ __('Estimation gratuite') }}</strong> {{ __('de votre bateau sous 48h.') }}
                        {{ __('Contactez-nous pour naviguer dans l\'Océan Indien sans plus attendre. Notre expertise et notre réseau local vous garantissent une transaction sécurisée et au meilleur prix.') }}
                    </p>
                </div>

                <!-- Local Trust Signals -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex items-center p-3 bg-white dark:bg-slate-900 rounded-xl border border-gray-100 dark:border-white/5">
                        <div class="w-10 h-10 bg-gradient-to-br from-ocean-500 to-ocean-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-white text-sm"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 dark:text-gray-200 text-sm">{{ __('Basé à La Réunion') }}</h3>
                            <p class="text-gray-500 dark:text-gray-500 text-xs">{{ __('La Darse du Port') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center p-3 bg-white dark:bg-slate-900 rounded-xl border border-gray-100 dark:border-white/5">
                        <div class="w-10 h-10 bg-gradient-to-br from-luxe-cyan to-ocean-500 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                            <i class="fas fa-globe-africa text-white text-sm"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 dark:text-gray-200 text-sm">{{ __('Réseau Océan Indien') }}</h3>
                            <p class="text-gray-500 dark:text-gray-500 text-xs">{{ __('5 îles couvertes') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center p-3 bg-white dark:bg-slate-900 rounded-xl border border-gray-100 dark:border-white/5">
                        <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                            <i class="fas fa-handshake text-white text-sm"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 dark:text-gray-200 text-sm">{{ __('Courtage professionnel') }}</h3>
                            <p class="text-gray-500 dark:text-gray-500 text-xs">{{ __('Expertise & confiance') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('structured-data')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "LocalBusiness",
    "name": "My Boat Océan Indien",
    "description": "Courtier maritime spécialisé dans la vente de bateaux dans l'Océan Indien. Voiliers, catamarans et bateaux à moteur à La Réunion, Maurice, Madagascar, Seychelles et Mayotte.",
    "url": "{{ config('app.url') }}",
    "logo": "{{ asset('images/logo-myboat.png') }}",
    "image": "{{ asset('images/og-myboat.jpg') }}",
    "telephone": "+262692706610",
    "email": "contact@myboat-oi.com",
    "address": {
        "@@type": "PostalAddress",
        "streetAddress": "La Darse du Port",
        "addressLocality": "Le Port",
        "postalCode": "97420",
        "addressRegion": "La Réunion",
        "addressCountry": "FR"
    },
    "geo": {
        "@@type": "GeoCoordinates",
        "latitude": -20.9408,
        "longitude": 55.2894
    },
    "areaServed": [
        {"@@type": "Place", "name": "La Réunion"},
        {"@@type": "Place", "name": "Maurice"},
        {"@@type": "Place", "name": "Madagascar"},
        {"@@type": "Place", "name": "Seychelles"},
        {"@@type": "Place", "name": "Mayotte"}
    ],
    "priceRange": "€€€",
    "openingHoursSpecification": {
        "@@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        "opens": "08:00",
        "closes": "18:00"
    },
    "sameAs": [
        "https://www.facebook.com/Myboat-oi-100247242056443",
        "https://www.instagram.com/myboat_oi"
    ]
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "WebSite",
    "name": "My Boat Océan Indien",
    "url": "{{ config('app.url') }}",
    "potentialAction": {
        "@@type": "SearchAction",
        "target": "{{ route('bateaux.index') }}?q={search_term_string}",
        "query-input": "required name=search_term_string"
    }
}
</script>
@endpush
