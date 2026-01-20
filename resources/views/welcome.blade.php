@extends('layouts.app')

@section('title', 'Myboat-oi - Marketplace de Bateaux | Océan Indien')
@section('description', 'La première marketplace de vente de bateaux dans l\'océan Indien. Trouvez votre bateau idéal à La Réunion, Maurice et Madagascar.')

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
        alt="Marketplace de vente de bateaux dans l’océan Indien"
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
                    <div class="inline-flex items-center space-x-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md text-white mb-6 animate-fadeInUp border border-white/20">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse shadow-lg shadow-green-400/50"></span>
                        <span class="text-sm font-medium">{{ $stats['total_bateaux'] }} bateaux disponibles</span>
                    </div>

                    <!-- Main Title - Fixed minimum size for readability -->
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-black text-white mb-6 animate-fadeInUp leading-tight drop-shadow-[0_4px_8px_rgba(0,0,0,0.5)]" style="animation-delay: 0.1s;">
                        Trouvez ou vendez<br class="hidden sm:block"> le bateau de <span class="relative inline-block">
                            <span class="relative z-10 bg-gradient-to-r from-ocean-400 to-luxe-cyan bg-clip-text text-transparent drop-shadow-lg">vos rêves</span>
                            <div class="absolute bottom-1 sm:bottom-2 left-0 w-full h-3 sm:h-4 bg-gradient-to-r from-ocean-400/30 to-luxe-cyan/30 transform -rotate-1 rounded-lg blur-sm"></div>
                        </span>
                    </h1>

                    <p class="text-lg sm:text-xl lg:text-2xl text-white mb-8 animate-fadeInUp drop-shadow-[0_2px_4px_rgba(0,0,0,0.5)]" style="animation-delay: 0.2s;">
                        Votre courtier maritime de confiance dans l'océan Indien
                    </p>
                </div>

                <!-- Centered Search Bar and Stats -->
                <div class="max-w-4xl mx-auto animate-fadeInUp" style="animation-delay: 0.3s;">
                    <form action="{{ route('bateaux.index') }}" method="GET" class="bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl rounded-3xl shadow-2xl p-3 md:p-4 border border-white/20">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                            <!-- Type -->
                            <div class="relative group">
                                <select name="type_id" class="w-full px-5 py-4 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 dark:focus:ring-ocean-400 text-gray-700 dark:text-gray-300 font-medium appearance-none cursor-pointer transition-all duration-300 group-hover:bg-gray-100 dark:group-hover:bg-slate-700">
                                    <option value="">Type de bateau</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->libelle }}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500 pointer-events-none group-hover:text-ocean-500 transition-colors"></i>
                            </div>

                            <!-- Location -->
                            <div class="relative group">
                                <select name="zone_id" class="w-full px-5 py-4 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 dark:focus:ring-ocean-400 text-gray-700 dark:text-gray-300 font-medium appearance-none cursor-pointer transition-all duration-300 group-hover:bg-gray-100 dark:group-hover:bg-slate-700">
                                    <option value="">Localisation</option>
                                    @foreach($zones as $zone)
                                        <option value="{{ $zone->id }}">{{ $zone->libelle }}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500 pointer-events-none group-hover:text-ocean-500 transition-colors"></i>
                            </div>

                            <!-- Price -->
                            <div class="relative group">
                                <select name="prix_max" class="w-full px-5 py-4 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 dark:focus:ring-ocean-400 text-gray-700 dark:text-gray-300 font-medium appearance-none cursor-pointer transition-all duration-300 group-hover:bg-gray-100 dark:group-hover:bg-slate-700">
                                    <option value="">Budget max</option>
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
                                    <span class="hidden md:inline">Rechercher</span>
                                </span>
                            </button>
                        </div>
                    </form>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-3 gap-4 sm:gap-6 mt-8 p-4 max-w-2xl mx-auto">
                        <div class="text-center group">
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-black mb-1 text-ocean-900 dark:text-ocean-200 group-hover:scale-110 transition-transform drop-shadow-lg">54+</div>
                            <div class="text-white/90 text-xs sm:text-sm drop-shadow-md">Bateaux disponibles</div>
                        </div>
                        <div class="text-center group">
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-black mb-1 text-ocean-900 dark:text-ocean-200 group-hover:scale-110 transition-transform drop-shadow-lg">5</div>
                            <div class="text-white/90 text-xs sm:text-sm drop-shadow-md">Îles couvertes</div>
                        </div>
                        <div class="text-center group">
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-black mb-1 text-ocean-900 dark:text-ocean-200 group-hover:scale-110 transition-transform drop-shadow-lg">48h</div>
                            <div class="text-white/90 text-xs sm:text-sm drop-shadow-md">Temps de réponse</div>
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

    <!-- Categories Section -->
    <section class="py-20 md:py-28 bg-gradient-to-b from-white via-gray-50 to-white dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-block px-4 py-2 bg-ocean-100 dark:bg-ocean-950/30 text-ocean-600 dark:text-ocean-400 rounded-full text-sm font-bold mb-4 border border-ocean-200 dark:border-ocean-800">
                    CATÉGORIES
                </span>
                <h2 class="text-4xl md:text-6xl font-black text-gray-900 dark:text-white mb-6">
                    Explorez notre sélection
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400">
                    Trouvez le type de bateau parfait pour votre aventure maritime
                </p>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($types->take(6) as $index => $type)
                    @php
                        $typeIcon = $type->icone ?? 'fa-ship';
                        $colors = [
                            ['bg' => 'from-ocean-500/10', 'gradient' => 'from-ocean-500 to-ocean-600', 'text' => 'text-ocean-600 dark:text-ocean-400'],
                            ['bg' => 'from-luxe-cyan/10', 'gradient' => 'from-luxe-cyan to-ocean-500', 'text' => 'text-luxe-cyan dark:text-luxe-cyan'],
                            ['bg' => 'from-purple-500/10', 'gradient' => 'from-purple-500 to-violet-600', 'text' => 'text-purple-600 dark:text-purple-400'],
                            ['bg' => 'from-amber-500/10', 'gradient' => 'from-amber-500 to-orange-600', 'text' => 'text-amber-600 dark:text-amber-400'],
                            ['bg' => 'from-emerald-500/10', 'gradient' => 'from-emerald-500 to-green-600', 'text' => 'text-emerald-600 dark:text-emerald-400'],
                            ['bg' => 'from-rose-500/10', 'gradient' => 'from-rose-500 to-pink-600', 'text' => 'text-rose-600 dark:text-rose-400'],
                        ];
                        $color = $colors[$index % count($colors)];
                    @endphp
                    <a href="{{ route('bateaux.index', ['type_id' => $type->id]) }}" class="group bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-lg hover:shadow-2xl dark:shadow-slate-950/50 transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 dark:border-white/10">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br {{ $color['gradient'] }} rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                            <i class="fas {{ $typeIcon }} text-2xl text-white"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 dark:text-white group-hover:{{ $color['text'] }} transition-colors text-center mb-2">{{ $type->libelle }}</h4>
                        <p class="text-sm {{ $color['text'] }} text-center font-semibold">{{ $type->bateaux_count }} annonce{{ $type->bateaux_count > 1 ? 's' : '' }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Boats Section -->
    <section class="py-20 md:py-28 bg-white dark:bg-slate-900">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12">
                <div class="mb-6 md:mb-0">
                    <span class="inline-block px-4 py-2 bg-ocean-100 dark:bg-ocean-950/30 text-ocean-600 dark:text-ocean-400 rounded-full text-sm font-bold mb-4 border border-ocean-200 dark:border-ocean-800">
                        SÉLECTION
                    </span>
                    <h2 class="text-4xl md:text-6xl font-black text-gray-900 dark:text-white mb-4">
                        Bateaux en vedette
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-400">
                        Découvrez notre sélection exclusive du moment
                    </p>
                </div>
                <a href="{{ route('bateaux.index') }}" class="hidden md:flex items-center px-6 py-3 bg-gradient-to-r from-ocean-600 to-luxe-cyan hover:from-ocean-700 hover:to-ocean-600 text-white rounded-xl font-bold transition-all shadow-lg hover:shadow-2xl transform hover:scale-105">
                    Voir tout
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
                        :published-at="$bateau->published_at ? $bateau->published_at->format('d/m/Y') : null"
                        :badge="$bateau->badge['label'] ?? null"
                        :badge-color="$bateau->badge['color'] ?? 'green'"
                    />
                @empty
                    <div class="col-span-4 text-center py-20">
                        <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-ocean-100 to-ocean-200 dark:from-ocean-950 dark:to-ocean-900 rounded-full flex items-center justify-center">
                            <i class="fas fa-anchor text-4xl text-ocean-400 dark:text-ocean-600"></i>
                        </div>
                        <p class="text-xl text-gray-500 dark:text-gray-400">Aucune annonce disponible pour le moment</p>
                    </div>
                @endforelse
            </div>

            <!-- Mobile CTA -->
            <div class="mt-10 text-center md:hidden">
                <a href="{{ route('bateaux.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-ocean-600 to-luxe-cyan text-white rounded-xl font-bold text-lg transition-all shadow-lg hover:shadow-2xl">
                    Voir tous les bateaux
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-20 md:py-28 bg-gradient-to-br from-ocean-50 via-cyan-50 to-ocean-100 dark:from-slate-950 dark:via-ocean-950 dark:to-slate-900">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-block px-4 py-2 bg-white dark:bg-slate-900 text-ocean-600 dark:text-ocean-400 rounded-full text-sm font-bold mb-4 border border-ocean-200 dark:border-ocean-800">
                    AVANTAGES
                </span>
                <h2 class="text-4xl md:text-6xl font-black text-gray-900 dark:text-white mb-6">
                    Pourquoi Myboat-oi ?
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                $advantages = [
                    ['icon' => 'fa-shield-check', 'title' => '100% Sécurisé', 'desc' => 'Transactions protégées et vendeurs vérifiés pour votre tranquillité d\'esprit', 'gradient' => 'from-ocean-500 to-ocean-600'],
                    ['icon' => 'fa-bolt', 'title' => 'Réponse Rapide', 'desc' => 'Estimation et réponse à vos demandes sous 48h maximum, 7j/7', 'gradient' => 'from-luxe-cyan to-ocean-500'],
                    ['icon' => 'fa-users', 'title' => 'Experts Locaux', 'desc' => 'Une équipe passionnée qui connaît parfaitement l\'océan Indien', 'gradient' => 'from-purple-500 to-purple-600'],
                    ['icon' => 'fa-chart-line', 'title' => 'Prix Justes', 'desc' => 'Estimation gratuite et transparence sur les prix du marché', 'gradient' => 'from-amber-500 to-amber-600'],
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
                <h2 class="text-4xl md:text-6xl font-black mb-6 text-gray-900 dark:text-white">
                    Prêt à vendre votre bateau ?
                </h2>
                <p class="text-xl md:text-2xl text-gray-700 dark:text-gray-300 mb-12 max-w-3xl mx-auto">
                    Confiez-nous votre bateau et bénéficiez de notre expertise pour une vente rapide et au meilleur prix.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                    <a href="{{ route('sell') }}" class="group relative px-10 py-5 bg-gradient-to-r from-ocean-600 to-luxe-cyan text-white rounded-2xl font-black text-lg overflow-hidden transition-all hover:shadow-2xl transform hover:scale-105">
                        <span class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></span>
                        <span class="relative z-10 flex items-center">
                            <i class="fas fa-rocket mr-3"></i>
                            Estimer mon bateau
                        </span>
                    </a>
                    <a href="{{ route('contact') }}" class="group px-10 py-5 border-2 border-ocean-600 dark:border-ocean-400 text-ocean-600 dark:text-ocean-400 rounded-2xl font-black text-lg hover:bg-ocean-600 hover:dark:bg-ocean-500 hover:text-white transition-all transform hover:scale-105">
                        <i class="fas fa-phone mr-3"></i>
                        Nous contacter
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="grid grid-cols-3 gap-8 max-w-3xl mx-auto">
                    <div class="group">
                        <div class="text-4xl md:text-5xl font-black mb-2 bg-gradient-to-r from-ocean-600 to-luxe-cyan bg-clip-text text-transparent group-hover:scale-110 transition-transform">100%</div>
                        <div class="text-gray-600 dark:text-gray-400 text-sm md:text-base">Gratuit</div>
                    </div>
                    <div class="group">
                        <div class="text-4xl md:text-5xl font-black mb-2 bg-gradient-to-r from-ocean-600 to-luxe-cyan bg-clip-text text-transparent group-hover:scale-110 transition-transform">48h</div>
                        <div class="text-gray-600 dark:text-gray-400 text-sm md:text-base">Réponse</div>
                    </div>
                    <div class="group">
                        <div class="text-4xl md:text-5xl font-black mb-2 bg-gradient-to-r from-ocean-600 to-luxe-cyan bg-clip-text text-transparent group-hover:scale-110 transition-transform">0€</div>
                        <div class="text-gray-600 dark:text-gray-400 text-sm md:text-base">Frais cachés</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
