@extends('layouts.app')

@section('title', 'Catégories de Bateaux - Myboat-oi')

@section('content')

    <!-- Hero -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-5xl font-bold mb-4">Explorer par catégorie</h1>
            <p class="text-lg md:text-xl text-blue-100">Trouvez le type de bateau qui correspond à vos besoins</p>
        </div>
    </div>

    <!-- Catégories principales -->
    <div class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @php
                // Default image and icon if none specified
                $defaultImage = 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80';
                $defaultIcon = 'fa-ship';

                $descriptionMap = [
                    'voilier' => 'Naviguez à la force du vent avec nos voiliers de croisière et de course.',
                    'catamaran' => 'Stabilité et espace pour vos croisières en famille ou charters.',
                    'yacht' => 'Luxe et prestige pour des moments d\'exception sur l\'eau.',
                    'moteur' => 'Rapidité et confort pour vos sorties en mer et pêche sportive.',
                    'semi-rigide' => 'Polyvalence et sécurité pour toutes vos activités nautiques.',
                    'pêche' => 'Équipements spécialisés pour la pêche au gros et sportive.',
                    'default' => 'Découvrez nos bateaux de qualité pour tous vos besoins nautiques.'
                ];

                function getDescriptionForType($libelle, $descriptionMap) {
                    $libelleLower = strtolower($libelle);
                    foreach ($descriptionMap as $key => $description) {
                        if (str_contains($libelleLower, $key)) {
                            return $description;
                        }
                    }
                    return $descriptionMap['default'];
                }
            @endphp

            @foreach($types as $type)
                @php
                    // Use type's photo if available, otherwise default
                    // Check if photo is a full URL (Cloudflare R2) or a path (local storage)
                    if ($type->photo) {
                        $typeImage = str_starts_with($type->photo, 'http')
                            ? $type->photo
                            : asset('storage/' . $type->photo);
                    } else {
                        $typeImage = $defaultImage;
                    }
                    // Use type's icon if available, otherwise default
                    $typeIcon = $type->icone ?? $defaultIcon;
                @endphp
                <a href="{{ route('bateaux.index', ['type_id' => $type->id]) }}" class="group">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ $typeImage }}"
                                 class="w-full h-full object-cover object-center group-hover:scale-110 transition duration-500" alt="{{ $type->libelle }}" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                <div class="flex items-center mb-2">
                                    <i class="fas {{ $typeIcon }} text-3xl md:text-4xl mr-4"></i>
                                    <div>
                                        <h3 class="text-xl md:text-2xl font-bold">{{ $type->libelle }}</h3>
                                        <p class="text-blue-200 text-sm md:text-base">{{ $type->bateaux_count }} annonce{{ $type->bateaux_count > 1 ? 's' : '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 text-sm md:text-base mb-4">{{ getDescriptionForType($type->libelle, $descriptionMap) }}</p>
                            <div class="flex items-center text-blue-600 font-semibold text-sm md:text-base group-hover:translate-x-2 transition">
                                Voir les annonces <i class="fas fa-arrow-right ml-2"></i>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </div>


    <!-- CTA -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-2xl md:text-4xl font-bold mb-4">Vous ne trouvez pas ce que vous cherchez ?</h2>
            <p class="text-lg md:text-xl mb-8 text-blue-100">Contactez-nous pour une recherche personnalisée</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('bateaux.index') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-8 py-4 rounded-lg font-bold text-lg transition transform hover:scale-105 inline-flex items-center justify-center">
                    <i class="fas fa-search mr-2"></i> Toutes les annonces
                </a>
                <a href="{{ route('home') }}#contact" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-4 rounded-lg font-bold text-lg transition transform hover:scale-105 inline-flex items-center justify-center">
                    <i class="fas fa-handshake mr-2"></i> Nous contacter
                </a>
            </div>
        </div>
    </div>

@endsection
