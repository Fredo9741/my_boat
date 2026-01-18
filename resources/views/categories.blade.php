@extends('layouts.app')

@section('title', 'Catégories de Bateaux - Myboat-oi')
@section('description', 'Explorez notre sélection de bateaux par catégorie : voiliers, catamarans, yachts, bateaux à moteur et plus encore.')

@section('content')

@php
    // Configuration des descriptions par type
    $descriptionMap = [
        'voilier'     => 'Naviguez à la force du vent avec nos voiliers de croisière et de course.',
        'catamaran'    => 'Stabilité et espace pour vos croisières en famille ou charters.',
        'yacht'        => 'Luxe et prestige pour des moments d\'exception sur l\'eau.',
        'moteur'       => 'Rapidité et confort pour vos sorties en mer et pêche sportive.',
        'semi-rigide'  => 'Polyvalence et sécurité pour toutes vos activités nautiques.',
        'pêche'        => 'Équipements spécialisés pour la pêche au gros et sportive.',
        'default'      => 'Découvrez nos bateaux de qualité pour tous vos besoins nautiques.'
    ];
@endphp

<div class="relative bg-gradient-to-br from-ocean-600 via-ocean-700 to-luxe-navy dark:from-luxe-navy dark:via-ocean-950 dark:to-black text-white py-24 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-20 w-96 h-96 bg-luxe-cyan rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-ocean-400 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-5xl md:text-7xl font-black mb-6">Explorer par Catégorie</h1>
            <p class="text-xl md:text-2xl text-ocean-100 dark:text-ocean-200">Trouvez le type de bateau qui correspond parfaitement à vos besoins</p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach($types as $type)
            @php
                $libelleLower = strtolower($type->libelle);
                
                // Détermination de la description (Logique inline sécurisée)
                $description = $descriptionMap['default'];
                foreach ($descriptionMap as $key => $text) {
                    if ($key !== 'default' && str_contains($libelleLower, $key)) {
                        $description = $text;
                        break;
                    }
                }

                $typeImage = $type->photo ?? 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80';
                $typeIcon = $type->icone ?? 'fa-ship';
            @endphp

            <a href="{{ route('bateaux.index', ['type_id' => $type->id]) }}" class="group block">
                <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2 border border-gray-100 dark:border-white/10 h-full flex flex-col">
                    
                    <div class="relative h-64 overflow-hidden bg-gray-200 dark:bg-slate-800">
                        <img src="{{ $typeImage }}"
                             class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500"
                             alt="{{ $type->libelle }}"
                             loading="lazy"
                             onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80';">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>

                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <div class="flex items-center">
                                <div class="w-14 h-14 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mr-4 shadow-lg border border-white/30">
                                    <i class="fas {{ $typeIcon }} text-2xl text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-black mb-1">{{ $type->libelle }}</h3>
                                    <p class="text-ocean-200 text-sm font-semibold">
                                        <i class="fas fa-anchor mr-1"></i>
                                        {{ $type->bateaux_count }} annonce{{ $type->bateaux_count > 1 ? 's' : '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                            {{ $description }}
                        </p>
                        
                        <div class="flex items-center text-ocean-600 dark:text-ocean-400 font-bold group-hover:translate-x-2 transition-transform">
                            Voir les annonces
                            <i class="fas fa-arrow-right ml-2"></i>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach

    </div>
</div>

<div class="container mx-auto px-4 pb-16">
    <div class="bg-gradient-to-br from-ocean-600 via-ocean-700 to-luxe-navy dark:from-luxe-navy dark:via-ocean-900 dark:to-black rounded-3xl shadow-2xl p-12 md:p-16 text-white text-center border border-ocean-500/30">
        <h2 class="text-4xl font-black mb-5">Vous ne trouvez pas ce que vous cherchez ?</h2>
        <p class="text-xl text-ocean-100 dark:text-ocean-200 mb-10">Contactez-nous pour une recherche personnalisée adaptée à vos besoins</p>
        <div class="flex flex-col sm:flex-row justify-center gap-5">
            <a href="{{ route('bateaux.index') }}" class="inline-flex items-center justify-center bg-white hover:bg-ocean-50 text-ocean-900 px-10 py-5 rounded-2xl font-black text-lg transition-all shadow-xl hover:shadow-2xl transform hover:scale-105">
                <i class="fas fa-search mr-2"></i>
                Toutes les annonces
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center bg-ocean-500/20 hover:bg-ocean-500/30 backdrop-blur-sm border-2 border-white/50 text-white px-10 py-5 rounded-2xl font-black text-lg transition-all shadow-xl">
                <i class="fas fa-envelope mr-2"></i>
                Nous contacter
            </a>
        </div>
    </div>
</div>

@endsection