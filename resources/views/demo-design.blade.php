<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Myboat-oi - Design Demo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        /* Animations personnalisées */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .glass-morphism {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Hover effects */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom gradient backgrounds */
        .bg-ocean-gradient {
            background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 50%, #3b82f6 100%);
        }

        .bg-sunset-gradient {
            background: linear-gradient(135deg, #f59e0b 0%, #ef4444 50%, #ec4899 100%);
        }
    </style>
</head>
<body class="antialiased bg-gray-50">

    <!-- ========================================
         HEADER / NAVBAR - Version Améliorée
    ======================================== -->
    <header class="fixed w-full top-0 z-50 transition-all duration-300" id="navbar">
        <div class="absolute inset-0 bg-white/80 backdrop-blur-md border-b border-gray-200/50"></div>

        <div class="relative container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo avec animation -->
                <a href="/" class="flex items-center group">
                    <img src="{{ asset('images/logo-myboat.svg') }}" alt="Myboat-oi Logo" class="h-14 w-auto transition-transform group-hover:scale-105">
                </a>

                <!-- Navigation Desktop -->
                <nav class="hidden lg:flex items-center space-x-1">
                    <a href="/" class="group relative px-5 py-2.5 text-gray-700 hover:text-blue-600 font-medium transition-colors rounded-xl hover:bg-blue-50">
                        <span class="relative z-10">Accueil</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    </a>
                    <a href="/bateaux" class="group relative px-5 py-2.5 text-gray-700 hover:text-blue-600 font-medium transition-colors rounded-xl hover:bg-blue-50">
                        <span class="relative z-10">Annonces</span>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </a>
                    <a href="/categories" class="group relative px-5 py-2.5 text-gray-700 hover:text-blue-600 font-medium transition-colors rounded-xl hover:bg-blue-50">
                        <span class="relative z-10">Catégories</span>
                    </a>
                    <a href="/a-propos" class="group relative px-5 py-2.5 text-gray-700 hover:text-blue-600 font-medium transition-colors rounded-xl hover:bg-blue-50">
                        <span class="relative z-10">À propos</span>
                    </a>
                    <a href="/contact" class="group relative px-5 py-2.5 text-gray-700 hover:text-blue-600 font-medium transition-colors rounded-xl hover:bg-blue-50">
                        <span class="relative z-10">Contact</span>
                    </a>
                </nav>

                <!-- CTA Button avec animation -->
                <div class="flex items-center space-x-3">
                    <a href="/vendre" class="group relative hidden sm:flex items-center px-6 py-3 rounded-xl font-semibold text-white overflow-hidden transition-all hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-blue-500 to-cyan-500 transition-all group-hover:from-blue-500 group-hover:to-cyan-600"></div>
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-20 bg-gradient-to-r from-white to-transparent transition-opacity"></div>
                        <i class="fas fa-plus-circle mr-2 relative z-10"></i>
                        <span class="relative z-10">Vendre mon bateau</span>
                    </a>

                    <!-- Hamburger -->
                    <button class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <i class="fas fa-bars text-xl text-gray-700"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Espaceur pour le header fixe -->
    <div class="h-20"></div>

    <!-- ========================================
         HERO SECTION - Version Premium
    ======================================== -->
    <section class="relative min-h-screen flex items-center overflow-hidden">
        <!-- Background avec image -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1542397284385-6010376c5337?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/30 to-black/50"></div>
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-20 left-10 w-72 h-72 bg-blue-500 rounded-full filter blur-3xl animate-float"></div>
                <div class="absolute bottom-20 right-10 w-96 h-96 bg-cyan-500 rounded-full filter blur-3xl animate-float" style="animation-delay: 2s;"></div>
            </div>
            <!-- Pattern overlay -->
            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="relative container mx-auto px-4 py-20">
            <div class="max-w-5xl mx-auto">
                <!-- Badge -->
                <div class="inline-flex items-center space-x-2 px-4 py-2 rounded-full glass-morphism text-white mb-6 animate-fadeInUp">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    <span class="text-sm font-medium">{{ $stats['total_bateaux'] }} bateaux disponibles</span>
                </div>

                <!-- Titre principal -->
                <h1 class="text-5xl md:text-7xl font-black text-white mb-6 animate-fadeInUp leading-tight" style="animation-delay: 0.1s;">
                    Trouvez le bateau<br>
                    de <span class="relative inline-block">
                        <span class="relative z-10">vos rêves</span>
                        <div class="absolute bottom-2 left-0 w-full h-4 bg-cyan-400 opacity-30 transform -rotate-1"></div>
                    </span>
                </h1>

                <p class="text-xl md:text-2xl text-blue-100 mb-10 max-w-2xl animate-fadeInUp" style="animation-delay: 0.2s;">
                    La première marketplace nautique de l'océan Indien. Achetez, vendez et vivez votre passion.
                </p>

                <!-- Barre de recherche moderne -->
                <div class="animate-fadeInUp" style="animation-delay: 0.3s;">
                    <div class="bg-white rounded-2xl shadow-2xl p-2">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                            <!-- Type -->
                            <div class="relative">
                                <select name="type_id" class="w-full px-4 py-4 rounded-xl bg-gray-50 border-0 focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium appearance-none cursor-pointer">
                                    <option value="">Type de bateau</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->libelle }}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                            </div>

                            <!-- Localisation -->
                            <div class="relative">
                                <select name="zone_id" class="w-full px-4 py-4 rounded-xl bg-gray-50 border-0 focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium appearance-none cursor-pointer">
                                    <option value="">Localisation</option>
                                    @foreach($zones as $zone)
                                        <option value="{{ $zone->id }}">{{ $zone->libelle }}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                            </div>

                            <!-- Prix -->
                            <div class="relative">
                                <select class="w-full px-4 py-4 rounded-xl bg-gray-50 border-0 focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium appearance-none cursor-pointer">
                                    <option>Budget max</option>
                                    <option>10 000 €</option>
                                    <option>50 000 €</option>
                                    <option>100 000 €</option>
                                    <option>250 000 €+</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                            </div>

                            <!-- Bouton recherche -->
                            <button class="group relative bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-8 py-4 rounded-xl font-bold overflow-hidden transition-all hover:scale-105 hover:shadow-lg">
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-cyan-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                <span class="relative z-10 flex items-center justify-center">
                                    <i class="fas fa-search mr-2"></i>
                                    Rechercher
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- Quick stats sous la recherche -->
                    <div class="grid grid-cols-3 gap-6 mt-8 text-white">
                        <div class="text-center">
                            <div class="text-4xl font-black mb-1">{{ $stats['total_bateaux'] }}+</div>
                            <div class="text-blue-200 text-sm">Bateaux disponibles</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-black mb-1">{{ $stats['total_zones'] }}</div>
                            <div class="text-blue-200 text-sm">Îles couvertes</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-black mb-1">48h</div>
                            <div class="text-blue-200 text-sm">Temps de réponse</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-8 h-12 border-2 border-white/50 rounded-full p-2">
                <div class="w-1.5 h-3 bg-white rounded-full mx-auto animate-pulse"></div>
            </div>
        </div>
    </section>

    <!-- Wave separator -->
    <div class="relative h-24 bg-white">
        <svg class="absolute bottom-0 w-full h-24" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 0L60 10C120 20 240 40 360 46.7C480 53 600 47 720 43.3C840 40 960 40 1080 46.7C1200 53 1320 67 1380 73.3L1440 80V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0V0Z" fill="#F9FAFB"/>
        </svg>
    </div>

    <!-- ========================================
         CATEGORIES - Version Cards Modernes
    ======================================== -->
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-4">
            <!-- En-tête de section -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-block px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold mb-4">
                    CATÉGORIES
                </span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">
                    Explorez notre sélection
                </h2>
                <p class="text-xl text-gray-600">
                    Trouvez le type de bateau parfait pour votre aventure maritime
                </p>
            </div>

            <!-- Grid de catégories avec animations -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($types->take(4) as $index => $type)
                    @php
                        $typeIcon = $type->icone ?? 'fa-ship';

                        // Définir les styles directement pour chaque index
                        if($index == 0) {
                            $gradientBg = 'from-blue-500/10';
                            $gradientIcon = 'from-blue-500 to-blue-600';
                            $textColor = 'text-blue-600';
                        } elseif($index == 1) {
                            $gradientBg = 'from-cyan-500/10';
                            $gradientIcon = 'from-cyan-500 to-cyan-600';
                            $textColor = 'text-cyan-600';
                        } elseif($index == 2) {
                            $gradientBg = 'from-purple-500/10';
                            $gradientIcon = 'from-purple-500 to-purple-600';
                            $textColor = 'text-purple-600';
                        } else {
                            $gradientBg = 'from-orange-500/10';
                            $gradientIcon = 'from-orange-500 to-orange-600';
                            $textColor = 'text-orange-600';
                        }
                    @endphp
                    <a href="{{ route('bateaux.index', ['type_id' => $type->id]) }}" class="group relative card-hover bg-white rounded-2xl p-8 shadow-lg cursor-pointer overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br {{ $gradientBg }} to-transparent rounded-bl-full"></div>

                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-gradient-to-br {{ $gradientIcon }} rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <i class="fas {{ $typeIcon }} text-2xl text-white"></i>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $type->libelle }}</h3>
                            <p class="text-gray-600 mb-4">Découvrez notre sélection</p>

                            <div class="flex items-center justify-between">
                                <span class="text-sm font-semibold {{ $textColor }}">{{ $type->bateaux_count }} annonce{{ $type->bateaux_count > 1 ? 's' : '' }}</span>
                                <i class="fas fa-arrow-right {{ $textColor }} group-hover:translate-x-2 transition-transform"></i>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ========================================
         BATEAUX EN VEDETTE - Cards Premium
    ======================================== -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <!-- En-tête de section -->
            <div class="flex justify-between items-center mb-12">
                <div>
                    <span class="inline-block px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold mb-4">
                        SÉLECTION
                    </span>
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">
                        Bateaux en vedette
                    </h2>
                    <p class="text-xl text-gray-600">
                        Découvrez notre sélection exclusive du moment
                    </p>
                </div>
                <a href="{{ route('bateaux.index') }}" class="hidden md:flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition-all hover:scale-105 shadow-lg">
                    Voir tout
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Grid de bateaux -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 - Catamaran Lagoon 42 -->
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden card-hover">
                    <a href="#" class="relative block overflow-hidden bg-gray-100 h-56">
                        <img src="https://images.unsplash.com/photo-1567899378494-47b22a2ae96a?q=80&w=800&auto=format&fit=crop"
                             alt="Catamaran Lagoon 42"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg">
                            Nouveauté
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </a>
                    <div class="p-5">
                        <a href="#" class="block mb-3">
                            <h3 class="font-bold text-lg text-gray-900 group-hover:text-blue-600 transition-colors">
                                Catamaran Lagoon 42
                            </h3>
                        </a>
                        <p class="text-gray-600 text-sm mb-3 flex items-center">
                            <i class="fas fa-map-marker-alt text-blue-600 mr-2"></i>
                            La Réunion
                        </p>
                        <div class="flex items-center text-sm text-gray-500 mb-4 space-x-3">
                            <span class="flex items-center">
                                <i class="fas fa-ruler-horizontal mr-1 text-gray-400"></i>
                                12.8m
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-calendar-alt mr-1 text-gray-400"></i>
                                2022
                            </span>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Prix</div>
                                <div class="text-2xl font-black text-blue-600">
                                    485 000 €
                                </div>
                            </div>
                            <a href="#" class="group/btn relative px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition-all overflow-hidden">
                                <span class="relative z-10">Voir</span>
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-cyan-500 opacity-0 group-hover/btn:opacity-100 transition-opacity"></div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 - Voilier Beneteau Oceanis 51 -->
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden card-hover">
                    <a href="#" class="relative block overflow-hidden bg-gray-100 h-56">
                        <img src="https://images.unsplash.com/photo-1569263979104-865ab7cd8d13?q=80&w=800&auto=format&fit=crop"
                             alt="Voilier Beneteau"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg">
                            Prix réduit
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </a>
                    <div class="p-5">
                        <a href="#" class="block mb-3">
                            <h3 class="font-bold text-lg text-gray-900 group-hover:text-blue-600 transition-colors">
                                Beneteau Oceanis 51
                            </h3>
                        </a>
                        <p class="text-gray-600 text-sm mb-3 flex items-center">
                            <i class="fas fa-map-marker-alt text-blue-600 mr-2"></i>
                            Maurice
                        </p>
                        <div class="flex items-center text-sm text-gray-500 mb-4 space-x-3">
                            <span class="flex items-center">
                                <i class="fas fa-ruler-horizontal mr-1 text-gray-400"></i>
                                15.5m
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-calendar-alt mr-1 text-gray-400"></i>
                                2020
                            </span>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Prix</div>
                                <div class="text-2xl font-black text-blue-600">
                                    325 000 €
                                </div>
                            </div>
                            <a href="#" class="group/btn relative px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition-all overflow-hidden">
                                <span class="relative z-10">Voir</span>
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-cyan-500 opacity-0 group-hover/btn:opacity-100 transition-opacity"></div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 3 - Semi-rigide Zodiac Pro -->
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden card-hover">
                    <a href="#" class="relative block overflow-hidden bg-gray-100 h-56">
                        <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?q=80&w=800&auto=format&fit=crop"
                             alt="Semi-rigide Zodiac"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 right-4 bg-blue-500 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg">
                            Coup de cœur
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </a>
                    <div class="p-5">
                        <a href="#" class="block mb-3">
                            <h3 class="font-bold text-lg text-gray-900 group-hover:text-blue-600 transition-colors">
                                Zodiac Pro 850
                            </h3>
                        </a>
                        <p class="text-gray-600 text-sm mb-3 flex items-center">
                            <i class="fas fa-map-marker-alt text-blue-600 mr-2"></i>
                            Madagascar
                        </p>
                        <div class="flex items-center text-sm text-gray-500 mb-4 space-x-3">
                            <span class="flex items-center">
                                <i class="fas fa-ruler-horizontal mr-1 text-gray-400"></i>
                                8.5m
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-calendar-alt mr-1 text-gray-400"></i>
                                2023
                            </span>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Prix</div>
                                <div class="text-2xl font-black text-blue-600">
                                    95 000 €
                                </div>
                            </div>
                            <a href="#" class="group/btn relative px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition-all overflow-hidden">
                                <span class="relative z-10">Voir</span>
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-cyan-500 opacity-0 group-hover/btn:opacity-100 transition-opacity"></div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 4 - Yacht Princess -->
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden card-hover">
                    <a href="#" class="relative block overflow-hidden bg-gray-100 h-56">
                        <img src="https://images.unsplash.com/photo-1605281317010-fe5ffe798166?q=80&w=800&auto=format&fit=crop"
                             alt="Yacht Princess"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 right-4 bg-yellow-500 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg">
                            Exclusivité
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </a>
                    <div class="p-5">
                        <a href="#" class="block mb-3">
                            <h3 class="font-bold text-lg text-gray-900 group-hover:text-blue-600 transition-colors">
                                Princess V58
                            </h3>
                        </a>
                        <p class="text-gray-600 text-sm mb-3 flex items-center">
                            <i class="fas fa-map-marker-alt text-blue-600 mr-2"></i>
                            La Réunion
                        </p>
                        <div class="flex items-center text-sm text-gray-500 mb-4 space-x-3">
                            <span class="flex items-center">
                                <i class="fas fa-ruler-horizontal mr-1 text-gray-400"></i>
                                17.7m
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-calendar-alt mr-1 text-gray-400"></i>
                                2021
                            </span>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Prix</div>
                                <div class="text-2xl font-black text-blue-600">
                                    1 250 000 €
                                </div>
                            </div>
                            <a href="#" class="group/btn relative px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition-all overflow-hidden">
                                <span class="relative z-10">Voir</span>
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-cyan-500 opacity-0 group-hover/btn:opacity-100 transition-opacity"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Mobile -->
            <div class="mt-8 text-center md:hidden">
                <a href="{{ route('bateaux.index') }}" class="inline-flex items-center px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-lg transition-all shadow-lg">
                    Voir tous les bateaux
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- ========================================
         POURQUOI NOUS - Version Modern Features
    ======================================== -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-block px-4 py-2 bg-purple-100 text-purple-600 rounded-full text-sm font-semibold mb-4">
                    AVANTAGES
                </span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">
                    Pourquoi choisir Myboat-oi ?
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Feature 1 -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-3xl opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative bg-white border-2 border-gray-100 rounded-3xl p-8 group-hover:border-blue-200 transition-all">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-shield-check text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">100% Sécurisé</h3>
                        <p class="text-gray-600">Transactions protégées et vendeurs vérifiés pour votre tranquillité d'esprit.</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-pink-500 rounded-3xl opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative bg-white border-2 border-gray-100 rounded-3xl p-8 group-hover:border-purple-200 transition-all">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-bolt text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Réponse Rapide</h3>
                        <p class="text-gray-600">Estimation et réponse à vos demandes sous 48h maximum, 7j/7.</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-500 to-red-500 rounded-3xl opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative bg-white border-2 border-gray-100 rounded-3xl p-8 group-hover:border-orange-200 transition-all">
                        <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-users text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Experts Locaux</h3>
                        <p class="text-gray-600">Une équipe passionnée qui connaît parfaitement l'océan Indien.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================
         CTA SECTION - Version Premium Légère
    ======================================== -->
    <section class="relative py-24 overflow-hidden">
        <!-- Background léger et aéré -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-cyan-50 to-blue-100"></div>
        <!-- Accents subtils -->
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-200 rounded-full filter blur-3xl animate-float"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-cyan-200 rounded-full filter blur-3xl animate-float" style="animation-delay: 2s;"></div>
        </div>
        <!-- Pattern overlay -->
        <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%230ea5e9\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

        <div class="relative container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center text-gray-900">
                <h2 class="text-4xl md:text-5xl font-black mb-6 text-gray-900">
                    Prêt à vendre votre bateau ?
                </h2>
                <p class="text-xl md:text-2xl text-gray-700 mb-10">
                    Confiez-nous votre bateau et bénéficiez de notre expertise pour une vente rapide et au meilleur prix.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
                    <a href="/vendre" class="group relative px-8 py-4 bg-blue-600 text-white rounded-xl font-bold text-lg overflow-hidden transition-all hover:scale-105 hover:shadow-2xl hover:bg-blue-700">
                        <span class="relative z-10 flex items-center">
                            <i class="fas fa-rocket mr-2"></i>
                            Estimer mon bateau
                        </span>
                    </a>
                    <a href="/contact" class="group px-8 py-4 border-2 border-blue-600 text-blue-600 rounded-xl font-bold text-lg hover:bg-blue-600 hover:text-white transition-all">
                        <i class="fas fa-phone mr-2"></i>
                        Nous contacter
                    </a>
                </div>

                <!-- Trust indicators -->
                <div class="grid grid-cols-3 gap-8 max-w-2xl mx-auto">
                    <div>
                        <div class="text-3xl font-black mb-2 text-blue-600">100%</div>
                        <div class="text-gray-600 text-sm">Gratuit</div>
                    </div>
                    <div>
                        <div class="text-3xl font-black mb-2 text-blue-600">48h</div>
                        <div class="text-gray-600 text-sm">Réponse</div>
                    </div>
                    <div>
                        <div class="text-3xl font-black mb-2 text-blue-600">0€</div>
                        <div class="text-gray-600 text-sm">Frais cachés</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================
         FOOTER - Version Premium
    ======================================== -->
    <footer class="relative bg-gray-900 text-gray-300 pt-20 pb-10">
        <div class="container mx-auto px-4">
            <!-- Main footer content -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Brand -->
                <div>
                    <div class="mb-6">
                        <img src="{{ asset('images/logo-myboat.svg') }}" alt="Myboat-oi Logo" class="h-12 w-auto">
                    </div>
                    <p class="text-gray-400 mb-6">
                        Votre courtier maritime de confiance dans l'océan Indien. Excellence et passion depuis 2024.
                    </p>
                    <!-- Social -->
                    <div class="flex space-x-3">
                        <a href="#" class="group w-10 h-10 bg-gray-800 hover:bg-gradient-to-br hover:from-blue-500 hover:to-cyan-500 rounded-lg flex items-center justify-center transition-all">
                            <i class="fab fa-facebook-f text-gray-400 group-hover:text-white transition-colors"></i>
                        </a>
                        <a href="#" class="group w-10 h-10 bg-gray-800 hover:bg-gradient-to-br hover:from-pink-500 hover:to-purple-500 rounded-lg flex items-center justify-center transition-all">
                            <i class="fab fa-instagram text-gray-400 group-hover:text-white transition-colors"></i>
                        </a>
                        <a href="#" class="group w-10 h-10 bg-gray-800 hover:bg-gradient-to-br hover:from-red-500 hover:to-red-600 rounded-lg flex items-center justify-center transition-all">
                            <i class="fab fa-youtube text-gray-400 group-hover:text-white transition-colors"></i>
                        </a>
                    </div>
                </div>

                <!-- Navigation -->
                <div>
                    <h4 class="text-white font-bold text-lg mb-6">Navigation</h4>
                    <ul class="space-y-3">
                        <li><a href="/" class="hover:text-blue-400 transition-colors flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-gray-600 group-hover:text-blue-400 group-hover:translate-x-1 transition-all"></i>
                            Accueil
                        </a></li>
                        <li><a href="/bateaux" class="hover:text-blue-400 transition-colors flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-gray-600 group-hover:text-blue-400 group-hover:translate-x-1 transition-all"></i>
                            Annonces
                        </a></li>
                        <li><a href="/vendre" class="hover:text-blue-400 transition-colors flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-gray-600 group-hover:text-blue-400 group-hover:translate-x-1 transition-all"></i>
                            Vendre
                        </a></li>
                        <li><a href="/a-propos" class="hover:text-blue-400 transition-colors flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-gray-600 group-hover:text-blue-400 group-hover:translate-x-1 transition-all"></i>
                            À propos
                        </a></li>
                    </ul>
                </div>

                <!-- Catégories -->
                <div>
                    <h4 class="text-white font-bold text-lg mb-6">Catégories</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-gray-600 group-hover:text-blue-400 group-hover:translate-x-1 transition-all"></i>
                            Voiliers
                        </a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-gray-600 group-hover:text-blue-400 group-hover:translate-x-1 transition-all"></i>
                            Catamarans
                        </a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-gray-600 group-hover:text-blue-400 group-hover:translate-x-1 transition-all"></i>
                            Yachts
                        </a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-gray-600 group-hover:text-blue-400 group-hover:translate-x-1 transition-all"></i>
                            Semi-rigides
                        </a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-white font-bold text-lg mb-6">Contact</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-blue-400 mt-1 mr-3"></i>
                            <span class="text-sm">Port de Saint-Gilles<br>97434 La Réunion</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone text-blue-400 mr-3"></i>
                            <span class="text-sm">+262 692 XX XX XX</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-blue-400 mr-3"></i>
                            <span class="text-sm">contact@myboat-oi.re</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom bar -->
            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <p class="text-gray-500 text-sm">
                        © 2025 Myboat-oi. Tous droits réservés.
                    </p>
                    <div class="flex flex-wrap justify-center gap-6 text-sm">
                        <a href="#" class="text-gray-500 hover:text-blue-400 transition-colors">Mentions légales</a>
                        <a href="#" class="text-gray-500 hover:text-blue-400 transition-colors">CGV</a>
                        <a href="#" class="text-gray-500 hover:text-blue-400 transition-colors">Confidentialité</a>
                        <a href="#" class="text-gray-500 hover:text-blue-400 transition-colors">Cookies</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.style.transform = 'translateY(0)';
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeInUp');
                }
            });
        }, observerOptions);

        document.querySelectorAll('section > div').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>
