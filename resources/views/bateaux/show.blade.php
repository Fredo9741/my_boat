@extends('layouts.app')

@section('title', $bateau->modele . ' - My Boat')

@section('content')

    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['label' => 'Annonces', 'url' => route('bateaux.index')],
        ['label' => $bateau->type->libelle ?? 'Bateaux', 'url' => route('bateaux.index', ['type_id' => $bateau->type_id])],
        ['label' => $bateau->modele, 'url' => '#']
    ]" />

    <!-- Publication Date -->
    @if($bateau->published_at)
    <div class="bg-white border-b">
        <div class="container mx-auto px-4 py-2">
            <div class="flex items-center text-sm text-gray-600">
                <i class="fas fa-clock mr-2 text-blue-600"></i>
                <span>Publiée le {{ $bateau->published_at->format('d/m/Y') }}</span>
            </div>
        </div>
    </div>
    @endif

    <!-- Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Colonne principale -->
            <div class="lg:col-span-2">

                <!-- Galerie Photos -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
                    <!-- Photo principale -->
                    <div class="relative group bg-gray-900">
                        <div class="w-full h-64 md:h-96 relative overflow-hidden">
                            <img id="mainImage" src="{{ $bateau->main_image }}"
                                 class="absolute inset-0 w-full h-full object-contain"
                                 alt="{{ $bateau->modele }}"
                                 loading="eager">
                        </div>

                        <!-- Badges -->
                        <div class="absolute top-4 left-4 flex flex-col md:flex-row gap-2">
                            @if($bateau->badge)
                                @php
                                    $badgeClasses = [
                                        'green' => 'bg-green-500',
                                        'yellow' => 'bg-yellow-500',
                                        'red' => 'bg-red-500',
                                        'blue' => 'bg-blue-500',
                                        'purple' => 'bg-purple-500',
                                        'pink' => 'bg-pink-500',
                                        'orange' => 'bg-orange-500',
                                        'gray' => 'bg-gray-500',
                                    ];
                                    $badgeClass = $badgeClasses[$bateau->badge['color']] ?? 'bg-gray-500';
                                @endphp
                                <span class="{{ $badgeClass }} text-white px-3 md:px-4 py-1 md:py-2 rounded-full text-xs md:text-sm font-semibold">
                                    <i class="fas fa-star mr-1"></i> {{ $bateau->badge['label'] }}
                                </span>
                            @endif
                            <span class="hidden md:inline-flex bg-white text-gray-800 px-3 md:px-4 py-1 md:py-2 rounded-full text-xs md:text-sm font-semibold">
                                {{ $bateau->occasion ? 'Occasion' : 'Neuf' }}
                            </span>
                        </div>

                        <!-- Boutons actions -->
                        <div class="absolute top-4 right-4 flex gap-2">
                            <button id="favoriteBtn" onclick="toggleFavorite('{{ $bateau->slug }}')" class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-gray-600 hover:text-red-500 transition shadow-lg">
                                <i id="favoriteIcon" class="far fa-heart text-xl"></i>
                            </button>
                            <div class="relative">
                                <button id="shareBtn" onclick="toggleShareMenu()" class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-gray-600 hover:text-blue-600 transition shadow-lg">
                                    <i class="fas fa-share-alt text-xl"></i>
                                </button>
                                <!-- Menu de partage -->
                                <div id="shareMenu" class="hidden absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-2xl border border-gray-200 z-50">
                                    <div class="p-4">
                                        <h4 class="font-bold text-gray-800 mb-3">Partager cette annonce</h4>
                                        <div class="space-y-2">
                                            @php
                                                $shareUrl = urlencode(url()->current());
                                                $shareTitle = urlencode($bateau->modele . ' - ' . $bateau->formatted_price);
                                                $shareText = urlencode($bateau->modele . ' - ' . $bateau->type->libelle . ' - ' . $bateau->formatted_price);
                                            @endphp

                                            <!-- Facebook -->
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}"
                                               target="_blank" rel="noopener noreferrer"
                                               class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-50 transition">
                                                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white">
                                                    <i class="fab fa-facebook-f"></i>
                                                </div>
                                                <span class="text-gray-700 font-medium">Facebook</span>
                                            </a>

                                            <!-- WhatsApp -->
                                            <a href="https://wa.me/?text={{ $shareText }}%20{{ $shareUrl }}"
                                               target="_blank" rel="noopener noreferrer"
                                               class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-50 transition">
                                                <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white">
                                                    <i class="fab fa-whatsapp"></i>
                                                </div>
                                                <span class="text-gray-700 font-medium">WhatsApp</span>
                                            </a>

                                            <!-- Email -->
                                            <a href="mailto:?subject={{ $shareTitle }}&body={{ $shareText }}%20{{ $shareUrl }}"
                                               class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-50 transition">
                                                <div class="w-10 h-10 bg-gray-600 rounded-full flex items-center justify-center text-white">
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                                <span class="text-gray-700 font-medium">Email</span>
                                            </a>

                                            <!-- Copier le lien -->
                                            <button onclick="copyShareLink('{{ url()->current() }}')"
                                                    class="w-full flex items-center gap-3 p-2 rounded-lg hover:bg-gray-50 transition">
                                                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white">
                                                    <i class="fas fa-link"></i>
                                                </div>
                                                <span class="text-gray-700 font-medium">Copier le lien</span>
                                            </button>
                                        </div>
                                        <p id="shareMessage" class="hidden text-xs text-green-600 mt-2 text-center">
                                            <i class="fas fa-check"></i> Lien copié !
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation photos -->
                        <button id="prevBtn" class="absolute left-4 top-1/2 transform -translate-y-1/2 w-12 h-12 bg-white bg-opacity-80 hover:bg-opacity-100 rounded-full flex items-center justify-center transition">
                            <i class="fas fa-chevron-left text-gray-800"></i>
                        </button>
                        <button id="nextBtn" class="absolute right-4 top-1/2 transform -translate-y-1/2 w-12 h-12 bg-white bg-opacity-80 hover:bg-opacity-100 rounded-full flex items-center justify-center transition">
                            <i class="fas fa-chevron-right text-gray-800"></i>
                        </button>

                        <!-- Compteur photos -->
                        <div class="absolute bottom-4 right-4 bg-black bg-opacity-70 text-white px-3 py-1 rounded-full text-sm">
                            <i class="fas fa-camera mr-1"></i> <span id="imageCounter">1</span> / {{ $bateau->images->count() }}
                        </div>
                    </div>

                    <!-- Miniatures -->
                    <div id="thumbnailsContainer" class="p-4 grid grid-cols-4 md:grid-cols-6 gap-2">
                        @foreach($bateau->images as $index => $media)
                            <div class="relative h-16 md:h-20 bg-gray-100 rounded-lg overflow-hidden {{ $index == 0 ? 'ring-2 ring-blue-600' : '' }}">
                                <img src="{{ $media->url }}"
                                     class="thumbnail absolute inset-0 w-full h-full object-cover object-center cursor-pointer hover:opacity-75 transition"
                                     data-index="{{ $index }}"
                                     alt="{{ $media->description ?? 'Image ' . ($index + 1) }}"
                                     loading="lazy">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Titre et infos principales -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">{{ $bateau->modele }}</h1>
                            <p class="text-gray-600 text-sm md:text-base">
                                <i class="fas fa-map-marker-alt text-blue-600 mr-1"></i>
                                {{ $bateau->location }}
                            </p>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl md:text-4xl font-bold text-blue-600 mb-1">{{ $bateau->formatted_price }}</div>
                            @if($bateau->afficher_prix && $bateau->prix)
                                <p class="text-xs md:text-sm text-gray-500">Négociable</p>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4 border-t">
                        <div class="text-center">
                            <div class="text-gray-500 text-xs md:text-sm mb-1">Longueur</div>
                            <div class="text-base md:text-xl font-bold text-gray-800">{{ $bateau->length }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-gray-500 text-xs md:text-sm mb-1">Année</div>
                            <div class="text-base md:text-xl font-bold text-gray-800">{{ $bateau->annee ?? 'N/A' }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-gray-500 text-xs md:text-sm mb-1">Type</div>
                            <div class="text-base md:text-xl font-bold text-gray-800">{{ $bateau->type->libelle ?? 'N/A' }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-gray-500 text-xs md:text-sm mb-1">État</div>
                            <div class="text-base md:text-xl font-bold {{ $bateau->occasion ? 'text-gray-600' : 'text-green-600' }}">{{ $bateau->occasion ? 'Occasion' : 'Neuf' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Vidéos YouTube -->
                @php
                    $youtubeVideos = $bateau->medias->where('type', 'video')->where('is_youtube', true);
                @endphp
                @if($youtubeVideos->count() > 0)
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fab fa-youtube text-red-600 mr-2"></i> Vidéos
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($youtubeVideos as $video)
                            @php
                                // Extraire l'ID YouTube depuis différents formats d'URL
                                $videoId = null;
                                $url = $video->url;

                                // Format: https://www.youtube.com/watch?v=VIDEO_ID
                                if (preg_match('/[?&]v=([^&]+)/', $url, $matches)) {
                                    $videoId = $matches[1];
                                }
                                // Format: https://youtu.be/VIDEO_ID
                                elseif (preg_match('/youtu\.be\/([^?]+)/', $url, $matches)) {
                                    $videoId = $matches[1];
                                }
                                // Format: https://www.youtube.com/embed/VIDEO_ID
                                elseif (preg_match('/youtube\.com\/embed\/([^?]+)/', $url, $matches)) {
                                    $videoId = $matches[1];
                                }
                            @endphp

                            @if($videoId)
                            <div class="relative pb-[56.25%] h-0 overflow-hidden rounded-lg shadow-md hover:shadow-xl transition">
                                <iframe
                                    class="absolute top-0 left-0 w-full h-full"
                                    src="https://www.youtube.com/embed/{{ $videoId }}"
                                    title="Vidéo YouTube"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Description -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-align-left text-blue-600 mr-2"></i> Description
                    </h2>
                    <div class="text-gray-700 text-sm md:text-base leading-relaxed space-y-4">
                        @if($bateau->description)
                            {!! nl2br(e($bateau->description)) !!}
                        @else
                            <p class="text-gray-500 italic">Aucune description disponible pour ce bateau.</p>
                        @endif
                    </div>
                </div>

                <!-- Caractéristiques techniques -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-cogs text-blue-600 mr-2"></i> Caractéristiques techniques
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informations générales -->
                        <div>
                            <h3 class="font-bold text-gray-800 mb-3 text-base md:text-lg">Informations générales</h3>
                            <div class="space-y-2 text-gray-700 text-sm md:text-base">
                                @if($bateau->chantier)
                                    <div class="flex justify-between py-2 border-b">
                                        <span>Chantier</span>
                                        <span class="font-semibold">{{ $bateau->chantier }}</span>
                                    </div>
                                @endif
                                @if($bateau->architecte)
                                    <div class="flex justify-between py-2 border-b">
                                        <span>Architecte</span>
                                        <span class="font-semibold">{{ $bateau->architecte }}</span>
                                    </div>
                                @endif
                                @if($bateau->pavillon)
                                    <div class="flex justify-between py-2 border-b">
                                        <span>Pavillon</span>
                                        <span class="font-semibold">{{ $bateau->pavillon }}</span>
                                    </div>
                                @endif
                                @if($bateau->materiaux)
                                    <div class="flex justify-between py-2 border-b">
                                        <span>Matériaux</span>
                                        <span class="font-semibold">{{ $bateau->materiaux }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Dimensions -->
                        <div>
                            <h3 class="font-bold text-gray-800 mb-3 text-base md:text-lg">Dimensions</h3>
                            <div class="space-y-2 text-gray-700 text-sm md:text-base">
                                @if($bateau->longueurht)
                                    <div class="flex justify-between py-2 border-b">
                                        <span>Longueur hors tout</span>
                                        <span class="font-semibold">{{ $bateau->longueurht }} m</span>
                                    </div>
                                @endif
                                @if($bateau->largeur)
                                    <div class="flex justify-between py-2 border-b">
                                        <span>Largeur</span>
                                        <span class="font-semibold">{{ $bateau->largeur }} m</span>
                                    </div>
                                @endif
                                @if($bateau->tirantdeau)
                                    <div class="flex justify-between py-2 border-b">
                                        <span>Tirant d'eau</span>
                                        <span class="font-semibold">{{ $bateau->tirantdeau }} m</span>
                                    </div>
                                @endif
                                @if($bateau->poidslegeencharges)
                                    <div class="flex justify-between py-2 border-b">
                                        <span>Poids lège en charges</span>
                                        <span class="font-semibold">{{ number_format($bateau->poidslegeencharges, 0, ',', ' ') }} kg</span>
                                    </div>
                                @endif
                                @if($bateau->surfaceaupres)
                                    <div class="flex justify-between py-2 border-b">
                                        <span>Surface au près</span>
                                        <span class="font-semibold">{{ $bateau->surfaceaupres }} m²</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Motorisation -->
                        <div>
                            <h3 class="font-bold text-gray-800 mb-3 text-base md:text-lg">Motorisation</h3>
                            <div class="space-y-2 text-gray-700 text-sm md:text-base">
                                @if($bateau->moteur)
                                    <div class="flex justify-between py-2 border-b">
                                        <span>Moteur</span>
                                        <span class="font-semibold">{{ $bateau->moteur }}</span>
                                    </div>
                                @endif
                                @if($bateau->puissance)
                                    <div class="flex justify-between py-2 border-b">
                                        <span>Puissance</span>
                                        <span class="font-semibold">{{ $bateau->puissance }} CV</span>
                                    </div>
                                @endif
                                @if($bateau->nombre_moteurs)
                                    <div class="flex justify-between py-2 border-b">
                                        <span>Nombre de moteurs</span>
                                        <span class="font-semibold">{{ $bateau->nombre_moteurs }}</span>
                                    </div>
                                @endif
                                @if($bateau->heuresmoteur)
                                    <div class="flex justify-between py-2 border-b">
                                        <span>Heures moteur</span>
                                        <span class="font-semibold">{{ number_format($bateau->heuresmoteur) }} h</span>
                                    </div>
                                @endif
                                @if($bateau->systemeantiderive)
                                    <div class="flex justify-between py-2 border-b">
                                        <span>Système anti-dérive</span>
                                        <span class="font-semibold">{{ $bateau->systemeantiderive }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Capacités -->
                        <div>
                            <h3 class="font-bold text-gray-800 mb-3 text-base md:text-lg">Capacités</h3>
                            <div class="space-y-2 text-gray-700 text-sm md:text-base">
                                @if($bateau->cabines)
                                    <div class="flex justify-between py-2 border-b">
                                        <span>Cabines</span>
                                        <span class="font-semibold">{{ $bateau->cabines }}</span>
                                    </div>
                                @endif
                                @if($bateau->passagers)
                                    <div class="flex justify-between py-2 border-b">
                                        <span>Passagers</span>
                                        <span class="font-semibold">{{ $bateau->passagers }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Équipements -->
                @if($bateau->equipements && $bateau->equipements->count() > 0)
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-list-check text-blue-600 mr-2"></i> Équipements
                        <span class="ml-2 text-sm text-gray-500">({{ $bateau->equipements->count() }})</span>
                    </h2>

                    @php
                        $categories = [
                            'navigation' => 'Navigation',
                            'confort' => 'Confort',
                            'securite' => 'Sécurité',
                            'electronique' => 'Électronique',
                            'manoeuvre' => 'Manœuvre',
                            'loisirs' => 'Loisirs'
                        ];
                        $equipementsGrouped = $bateau->equipements->groupBy('categorie');
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($categories as $categorieKey => $categorieLabel)
                            @if(isset($equipementsGrouped[$categorieKey]) && $equipementsGrouped[$categorieKey]->count() > 0)
                                <div>
                                    <h3 class="font-bold text-gray-800 mb-3 text-base md:text-lg">{{ $categorieLabel }}</h3>
                                    <ul class="space-y-2 text-gray-700 text-sm md:text-base">
                                        @foreach($equipementsGrouped[$categorieKey] as $equipement)
                                            <li class="flex items-center">
                                                <i class="fas fa-check text-green-600 mr-2"></i>
                                                @if($equipement->icone)
                                                    <i class="fas {{ $equipement->icone }} text-gray-600 mr-2"></i>
                                                @endif
                                                {{ $equipement->libelle }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-1">

                <!-- Contact courtier -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6 sticky top-24">
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-4">Contactez votre courtier</h3>

                    <!-- Profil courtier -->
                    <div class="flex items-center mb-6 pb-6 border-b">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-800 rounded-full flex items-center justify-center text-white text-2xl mr-4">
                            <i class="fas fa-ship"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">My Boat</h4>
                            <p class="text-sm text-blue-600 font-medium">Courtier maritime agréé</p>
                            <div class="flex items-center text-yellow-500 text-sm mt-1">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span class="text-gray-600 ml-2">(142 avis)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Messages de succès/erreur -->
                    @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <p class="text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                            <p class="text-red-800">{{ session('error') }}</p>
                        </div>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                            <h3 class="text-red-800 font-semibold">Erreurs de validation</h3>
                        </div>
                        <ul class="list-disc list-inside text-red-700 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Formulaire contact -->
                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="bateau_id" value="{{ $bateau->id }}">
                        <input type="hidden" name="bateau_titre" value="{{ $bateau->modele }}">

                        <div>
                            <input type="text" name="nom" value="{{ old('nom') }}" placeholder="Votre nom" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nom') border-red-500 @enderror" required>
                        </div>
                        <div>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Votre email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror" required>
                        </div>
                        <div>
                            <input type="tel" name="telephone" value="{{ old('telephone') }}" placeholder="Votre téléphone (optionnel)" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('telephone') border-red-500 @enderror">
                        </div>
                        <div>
                            <textarea name="message" rows="4" placeholder="Bonjour, je souhaite obtenir plus d'informations sur ce bateau..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('message') border-red-500 @enderror" required>{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                            <i class="fas fa-paper-plane mr-2"></i> Demander des informations
                        </button>
                    </form>

                    @php
                        $phoneNumber = \App\Models\Setting::get('phone_number', '+262 692 XX XX XX');
                        $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '262692000000');
                    @endphp

                    <div class="mt-6 space-y-3">
                        <a href="tel:{{ $phoneNumber }}" class="flex items-center justify-center border border-blue-600 text-blue-600 hover:bg-blue-50 px-4 py-3 rounded-lg font-medium transition">
                            <i class="fas fa-phone mr-2"></i> {{ $phoneNumber }}
                        </a>
                        <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" class="flex items-center justify-center border border-green-600 text-green-600 hover:bg-green-50 px-4 py-3 rounded-lg font-medium transition">
                            <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                        </a>
                        <div class="text-center pt-4 text-sm text-gray-600">
                            <i class="fas fa-clock mr-1"></i> Ouvert du lundi au samedi<br>9h - 18h
                        </div>
                    </div>
                </div>

                <!-- Informations annonce -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-4">Informations</h3>
                    <div class="space-y-3 text-sm">
                        @if($bateau->published_at)
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-calendar text-blue-600 mr-3 w-5"></i>
                            <span>Publiée le {{ $bateau->published_at->format('d/m/Y') }}</span>
                        </div>
                        @endif
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-hashtag text-blue-600 mr-3 w-5"></i>
                            <span>Réf: {{ strtoupper(substr($bateau->slug, 0, 15)) }}</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-shield-alt text-blue-600 mr-3 w-5"></i>
                            <span>Annonce vérifiée</span>
                        </div>
                    </div>
                </div>

                <!-- Partager -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-4">Partager</h3>
                    <div class="flex gap-2">
                        @php
                            $shareUrl = urlencode(url()->current());
                            $shareTitle = urlencode($bateau->modele . ' - ' . $bateau->formatted_price);
                            $shareText = urlencode($bateau->modele . ' - ' . $bateau->type->libelle . ' - ' . $bateau->formatted_price);
                        @endphp

                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition text-center"
                           title="Partager sur Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>

                        <!-- Twitter / X -->
                        <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareText }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="flex-1 bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg transition text-center"
                           title="Partager sur Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>

                        <!-- WhatsApp -->
                        <a href="https://wa.me/?text={{ $shareText }}%20{{ $shareUrl }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="flex-1 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition text-center"
                           title="Partager sur WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>

                        <!-- Copier le lien -->
                        <button onclick="copyToClipboard('{{ url()->current() }}')"
                                class="flex-1 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition"
                                title="Copier le lien">
                            <i class="fas fa-link"></i>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 text-center mt-3" id="copyMessage" style="display: none;">
                        <i class="fas fa-check text-green-600"></i> Lien copié !
                    </p>
                </div>

            </aside>

        </div>

        <!-- Annonces similaires -->
        <div class="mt-16">
            <div class="mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Annonces similaires</h2>
                <p class="text-gray-600 text-sm md:text-base">Autres bateaux qui pourraient vous intéresser</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($similaires as $similaire)
                    <x-boat-card
                        :slug="$similaire->slug"
                        :title="$similaire->modele"
                        :image="$similaire->main_image"
                        :price="$similaire->prix"
                        :location="$similaire->location"
                        :length="$similaire->length"
                        :year="$similaire->annee"
                        :published-at="$similaire->published_at ? $similaire->published_at->format('d/m/Y') : null"
                        :badge="$similaire->badge['label'] ?? null"
                        :badge-color="$similaire->badge['color'] ?? 'green'"
                    />
                @empty
                    <div class="col-span-4 text-center py-8 text-gray-500">
                        <p>Aucune annonce similaire disponible pour le moment.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image gallery carousel
    const images = @json($bateau->images->pluck('url')->toArray());
    const mainImage = document.getElementById('mainImage');
    const imageCounter = document.getElementById('imageCounter');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const thumbnails = document.querySelectorAll('.thumbnail');

    let currentIndex = 0;

    function updateImage(index) {
        currentIndex = index;
        mainImage.src = images[currentIndex];
        imageCounter.textContent = currentIndex + 1;

        // Update thumbnail borders
        thumbnails.forEach((thumb, idx) => {
            const container = thumb.parentElement;
            if (idx === currentIndex) {
                container.classList.add('ring-2', 'ring-blue-600');
                container.classList.remove('ring-0');
            } else {
                container.classList.remove('ring-2', 'ring-blue-600');
                container.classList.add('ring-0');
            }
        });
    }

    // Previous button
    prevBtn.addEventListener('click', function() {
        const newIndex = currentIndex > 0 ? currentIndex - 1 : images.length - 1;
        updateImage(newIndex);
    });

    // Next button
    nextBtn.addEventListener('click', function() {
        const newIndex = currentIndex < images.length - 1 ? currentIndex + 1 : 0;
        updateImage(newIndex);
    });

    // Thumbnail clicks
    thumbnails.forEach((thumbnail) => {
        thumbnail.addEventListener('click', function() {
            const index = parseInt(this.getAttribute('data-index'));
            updateImage(index);
        });
    });

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
            prevBtn.click();
        } else if (e.key === 'ArrowRight') {
            nextBtn.click();
        }
    });

    // Copy to clipboard function
    window.copyToClipboard = function(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Show success message
            const message = document.getElementById('copyMessage');
            message.style.display = 'block';
            setTimeout(function() {
                message.style.display = 'none';
            }, 3000);
        }, function(err) {
            console.error('Erreur lors de la copie: ', err);
        });
    };

    // Favorites system using localStorage
    window.toggleFavorite = function(slug) {
        let favorites = JSON.parse(localStorage.getItem('myboat_favorites') || '[]');
        const favoriteIcon = document.getElementById('favoriteIcon');
        const favoriteBtn = document.getElementById('favoriteBtn');

        if (favorites.includes(slug)) {
            // Remove from favorites
            favorites = favorites.filter(item => item !== slug);
            favoriteIcon.classList.remove('fas', 'text-red-500');
            favoriteIcon.classList.add('far', 'text-gray-600');
        } else {
            // Add to favorites
            favorites.push(slug);
            favoriteIcon.classList.remove('far', 'text-gray-600');
            favoriteIcon.classList.add('fas', 'text-red-500');
        }

        localStorage.setItem('myboat_favorites', JSON.stringify(favorites));
    };

    // Check if current boat is in favorites on page load
    const bateauSlug = '{{ $bateau->slug }}';
    const favorites = JSON.parse(localStorage.getItem('myboat_favorites') || '[]');
    if (favorites.includes(bateauSlug)) {
        const favoriteIcon = document.getElementById('favoriteIcon');
        favoriteIcon.classList.remove('far', 'text-gray-600');
        favoriteIcon.classList.add('fas', 'text-red-500');
    }

    // Share menu toggle
    window.toggleShareMenu = function() {
        const shareMenu = document.getElementById('shareMenu');
        shareMenu.classList.toggle('hidden');
    };

    // Close share menu when clicking outside
    document.addEventListener('click', function(event) {
        const shareBtn = document.getElementById('shareBtn');
        const shareMenu = document.getElementById('shareMenu');

        if (!shareBtn.contains(event.target) && !shareMenu.contains(event.target)) {
            shareMenu.classList.add('hidden');
        }
    });

    // Copy share link function
    window.copyShareLink = function(url) {
        navigator.clipboard.writeText(url).then(function() {
            const shareMessage = document.getElementById('shareMessage');
            shareMessage.classList.remove('hidden');
            setTimeout(function() {
                shareMessage.classList.add('hidden');
            }, 2000);
        }, function(err) {
            console.error('Erreur lors de la copie: ', err);
        });
    };
});
</script>
@endpush
