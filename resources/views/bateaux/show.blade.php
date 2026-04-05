@extends('layouts.app')

@php
    $nomBateau  = $bateau->nom ?: $bateau->modele ?: 'Bateau à vendre';
    $typeBateau = $bateau->type->libelle ?? 'Bateau';
    $firstMedia = $bateau->images->first();
    $ogImage    = $firstMedia ? strtok($firstMedia->url, '?') : asset('images/og-default.jpg');
@endphp

@section('title', $nomBateau . ($bateau->occasion ? ' d\'occasion' : ' neuf') . ' à vendre ' . $bateau->location . ' | MyBoat')
@section('description', 'Découvrez ce ' . $nomBateau . ($bateau->annee ? ' de ' . $bateau->annee : '') . ' situé à ' . $bateau->location . '. ' . ($bateau->afficher_prix && $bateau->prix ? 'Prix : ' . number_format($bateau->prix, 0, ',', ' ') . ' €. ' : '') . 'Prêt à naviguer dans l\'Océan Indien.')
@section('og_type', 'product')
@section('og_title', e($nomBateau . ($bateau->occasion ? ' d\'occasion' : ' neuf') . ' à vendre ' . $bateau->location . ' – MyBoat Océan Indien'))
@section('og_description', e(Str::limit(strip_tags($bateau->description), 200)))
@section('og_image', $ogImage)

@push('head')
@if($firstMedia)
<meta property="og:image:secure_url" content="{{ $ogImage }}">
@endif
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
@endpush

@push('structured-data')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Product",
    "name": "{{ e($bateau->modele) }}",
    "description": "{{ e(Str::limit(strip_tags($bateau->description), 300)) }}",
    "image": [
        @foreach($bateau->images->take(5) as $image)
        "{{ $image->url }}"@if(!$loop->last),@endif

        @endforeach
    ],
    "brand": {
        "@@type": "Brand",
        "name": "{{ e($bateau->chantier ?? 'Non spécifié') }}"
    },
    "model": "{{ e($bateau->modele) }}",
    "productionDate": "{{ $bateau->annee ?? '' }}",
    "category": "{{ e($bateau->type->libelle ?? 'Bateau') }}",
    "offers": {
        "@@type": "Offer",
        "url": "{{ url()->current() }}",
        "priceCurrency": "EUR",
        @if($bateau->afficher_prix && $bateau->prix)
        "price": "{{ number_format($bateau->prix, 2, '.', '') }}",
        "priceValidUntil": "{{ now()->addMonths(3)->format('Y-m-d') }}",
        @else
        "price": "0",
        @endif
        "availability": "https://schema.org/{{ $bateau->visible ? 'InStock' : 'SoldOut' }}",
        "itemCondition": "https://schema.org/{{ $bateau->occasion ? 'UsedCondition' : 'NewCondition' }}",
        "seller": {
            "@@type": "Organization",
            "name": "My Boat Océan Indien",
            "url": "{{ config('app.url') }}"
        }
    },
    "additionalProperty": [
        {
            "@@type": "PropertyValue",
            "name": "Longueur",
            "value": "{{ $bateau->longueurht ?? 'N/A' }}",
            "unitCode": "MTR"
        },
        {
            "@@type": "PropertyValue",
            "name": "Année",
            "value": "{{ $bateau->annee ?? 'N/A' }}"
        },
        {
            "@@type": "PropertyValue",
            "name": "Localisation",
            "value": "{{ e($bateau->location) }}"
        }
        @if($bateau->cabines)
        ,{
            "@@type": "PropertyValue",
            "name": "Cabines",
            "value": "{{ $bateau->cabines }}"
        }
        @endif
    ]
}
</script>
@endpush

@section('content')

<!-- Page Header with Breadcrumb -->
<div class="bg-gradient-to-br from-ocean-600 via-ocean-700 to-luxe-navy dark:from-luxe-navy dark:via-ocean-950 dark:to-black text-white py-12">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="text-sm mb-6">
            <ol class="flex items-center space-x-2 text-ocean-100 dark:text-ocean-200">
                <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Accueil</a></li>
                <li><i class="fas fa-chevron-right text-xs"></i></li>
                <li><a href="{{ route('bateaux.index') }}" class="hover:text-white transition-colors">Annonces</a></li>
                <li><i class="fas fa-chevron-right text-xs"></i></li>
                <li class="text-white font-medium">{{ $bateau->nom }}</li>
            </ol>
        </nav>

        <!-- Title & Quick Info -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-black mb-3">{{ $nomBateau }} {{ $bateau->occasion ? 'd\'occasion' : 'neuf' }} à vendre {{ $bateau->location }}</h1>
                <div class="flex flex-wrap items-center gap-4 text-ocean-100">
                    <span class="flex items-center"><i class="fas fa-map-marker-alt mr-2"></i> {{ $bateau->location }}</span>
                    <span class="flex items-center"><i class="fas fa-calendar-alt mr-2"></i> {{ $bateau->annee }}</span>
                    <span class="flex items-center"><i class="fas fa-tag mr-2"></i> {{ $bateau->type->libelle ?? 'Bateau' }}</span>
                </div>
            </div>
            <div class="text-right">
                <div class="text-4xl md:text-5xl font-black text-white mb-2">
                    {{ number_format($bateau->prix, 0, ',', ' ') }} €
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Left Column: Gallery & Details -->
        <div class="lg:col-span-2 space-y-8">

            <!-- Photo Gallery -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl overflow-hidden border border-gray-100 dark:border-white/10">
                @php
                    $photos = $bateau->images->pluck('url')->toArray();
                    if (empty($photos)) {
                        $photos[] = $bateau->main_image;
                    }
                    $photosLarge  = array_map(fn($u) => cf_img($u, ['width' => 900, 'quality' => 75]), $photos);
                    $photosThumbs = array_map(fn($u) => cf_img($u, ['width' => 192, 'height' => 192, 'fit' => 'cover', 'quality' => 70]), $photos);
                @endphp

                <!-- Main Image -->
                <div class="relative bg-gray-100 dark:bg-slate-800 aspect-video overflow-hidden">
                    <img id="mainImage"
                         src="{{ $photosLarge[0] }}"
                         alt="{{ $bateau->alt_text }}"
                         class="w-full h-full object-cover cursor-zoom-in"
                         loading="eager"
                         fetchpriority="high"
                         onclick="openLightbox(currentImageIndex)"
                         onerror="this.style.objectFit='contain'; this.parentElement.classList.add('bg-gray-200', 'dark:bg-slate-700');">

                    <!-- Image Counter Badge -->
                    <div class="absolute top-6 right-6 bg-black/60 backdrop-blur-md text-white px-4 py-2 rounded-xl font-semibold shadow-lg">
                        <i class="fas fa-images mr-2"></i>
                        <span id="imageCounter">1</span> / {{ count($photos) }}
                    </div>

                    <!-- Expand hint -->
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-black/50 backdrop-blur-sm text-white text-xs px-3 py-1.5 rounded-full pointer-events-none opacity-80">
                        <i class="fas fa-expand-alt mr-1"></i> Cliquez pour agrandir
                    </div>

                    <!-- Navigation Arrows -->
                    @if(count($photos) > 1)
                    <button onclick="previousImage()" class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/90 dark:bg-slate-800/90 backdrop-blur-md text-gray-900 dark:text-white w-12 h-12 rounded-xl shadow-xl hover:scale-110 transition-all flex items-center justify-center">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button onclick="nextImage()" class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/90 dark:bg-slate-800/90 backdrop-blur-md text-gray-900 dark:text-white w-12 h-12 rounded-xl shadow-xl hover:scale-110 transition-all flex items-center justify-center">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    @endif
                </div>

                <!-- Thumbnails -->
                @if(count($photos) > 1)
                <div class="p-4 bg-gray-50 dark:bg-slate-800/50">
                    <div class="flex gap-3 overflow-x-auto pb-2 hide-scrollbar">
                        @foreach($photosThumbs as $index => $thumb)
                        <button onclick="changeImage({{ $index }})"
                                class="thumbnail-btn flex-shrink-0 w-24 h-24 rounded-xl overflow-hidden border-3 transition-all hover:scale-105 {{ $index === 0 ? 'border-ocean-600 ring-2 ring-ocean-500' : 'border-gray-300 dark:border-slate-600' }}">
                            <img src="{{ $thumb }}" alt="{{ $bateau->alt_text }} - photo {{ $index + 1 }}" class="w-full h-full object-cover" loading="lazy" width="96" height="96">
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Videos Section -->
            @if($bateau->videos->count() > 0)
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl p-6 md:p-8 border border-gray-100 dark:border-white/10">
                <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-6 flex items-center">
                    <i class="fas fa-video text-ocean-600 dark:text-ocean-400 mr-3"></i>
                    Vidéos
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($bateau->videos as $video)
                    @php
                        $embedUrl = $video->url;
                        if (preg_match('/(?:youtu\.be\/|(?:m\.)?youtube\.com\/(?:watch\?.*v=|shorts\/))([a-zA-Z0-9_-]{11})/', $video->url, $ym)) {
                            $embedUrl = 'https://www.youtube.com/embed/' . $ym[1];
                        }
                    @endphp
                    <div class="relative rounded-2xl overflow-hidden shadow-lg aspect-video bg-gray-900">
                        <iframe
                            class="w-full h-full"
                            src="{{ $embedUrl }}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Description -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl p-6 md:p-8 border border-gray-100 dark:border-white/10">
                <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-6 flex items-center">
                    <i class="fas fa-align-left text-ocean-600 dark:text-ocean-400 mr-3"></i>
                    Description
                </h2>
                <div class="prose prose-ocean dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 leading-relaxed" style="line-height:1.8;">
                    {!! nl2br(e($bateau->description)) !!}
                </div>
            </div>

            <!-- Technical Specifications -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl p-6 md:p-8 border border-gray-100 dark:border-white/10">
                <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-6 flex items-center">
                    <i class="fas fa-cog text-ocean-600 dark:text-ocean-400 mr-3"></i>
                    Caractéristiques techniques
                </h2>
                @php
                    $specs = [
                        ['label' => 'Type de bateau',    'value' => $bateau->type->libelle ?? null],
                        ['label' => 'Chantier',          'value' => $bateau->chantier],
                        ['label' => 'Architecte',        'value' => $bateau->architecte],
                        ['label' => 'Année',             'value' => $bateau->annee],
                        ['label' => 'Pavillon',          'value' => $bateau->pavillon],
                        ['label' => 'Matériaux',         'value' => $bateau->materiaux],
                        ['label' => 'Longueur HT',       'value' => $bateau->longueurht ? $bateau->longueurht . ' m' : null],
                        ['label' => 'Largeur',           'value' => $bateau->largeur ? $bateau->largeur . ' m' : null],
                        ['label' => 'Tirant d\'eau',     'value' => $bateau->tirantdeau ? $bateau->tirantdeau . ' m' : null],
                        ['label' => 'Poids (lège/chargé)', 'value' => $bateau->poidslegeencharges],
                        ['label' => 'Surface au près',   'value' => $bateau->surfaceaupres ? $bateau->surfaceaupres . ' m²' : null],
                        ['label' => 'Moteur',            'value' => $bateau->moteur],
                        ['label' => 'Nombre de moteurs', 'value' => $bateau->nombre_moteurs],
                        ['label' => 'Puissance',         'value' => $bateau->puissance ? $bateau->puissance . ' CV' : null],
                        ['label' => 'Heures moteur',     'value' => $bateau->heuresmoteur ? number_format($bateau->heuresmoteur, 0, ',', ' ') . ' h' : null],
                        ['label' => 'Système anti-dérive', 'value' => $bateau->systemeantiderive],
                        ['label' => 'Cabines',           'value' => $bateau->cabines],
                        ['label' => 'Passagers',         'value' => $bateau->passagers],
                        ['label' => 'État',              'value' => $bateau->occasion ? 'Occasion' : 'Neuf'],
                        ['label' => 'Localisation',      'value' => $bateau->location],
                    ];
                    $specs = array_filter($specs, fn($s) => !is_null($s['value']) && $s['value'] !== '');
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($specs as $spec)
                    <div class="bg-ocean-50 dark:bg-slate-800/50 rounded-2xl p-5 border border-ocean-100 dark:border-ocean-900/30">
                        <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">{{ $spec['label'] }}</div>
                        <div class="text-lg font-bold text-gray-900 dark:text-white">{{ $spec['value'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Localisation -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl p-6 md:p-8 border border-gray-100 dark:border-white/10">
                <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-5 flex items-center">
                    <i class="fas fa-map-marker-alt text-ocean-600 dark:text-ocean-400 mr-3"></i>
                    Localisation
                </h2>
                <div class="flex items-center gap-4 bg-ocean-50 dark:bg-slate-800/50 rounded-2xl p-5 border border-ocean-100 dark:border-ocean-900/30">
                    <i class="fas fa-anchor text-ocean-500 dark:text-ocean-400 text-3xl flex-shrink-0"></i>
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-0.5">Zone géographique</div>
                        <div class="text-xl font-bold text-gray-900 dark:text-white">{{ $bateau->location }}</div>
                        @if($bateau->zone && $bateau->zone->libelle)
                        <div class="text-sm text-ocean-600 dark:text-ocean-400 mt-1">
                            <i class="fas fa-compass mr-1 text-xs"></i>{{ $bateau->zone->libelle }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Equipment & Options -->
            @if($bateau->equipements->count() > 0)
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl p-6 md:p-8 border border-gray-100 dark:border-white/10">
                <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-6 flex items-center">
                    <i class="fas fa-list-check text-ocean-600 dark:text-ocean-400 mr-3"></i>
                    Équipements
                </h3>
                <div class="flex flex-wrap gap-3">
                    @foreach($bateau->equipements as $equipement)
                    <span class="inline-flex items-center bg-gradient-to-r from-ocean-50 to-cyan-50 dark:from-ocean-950/30 dark:to-cyan-950/30 border border-ocean-200 dark:border-ocean-800 text-ocean-900 dark:text-ocean-200 px-4 py-2.5 rounded-xl font-medium shadow-sm hover:shadow-md transition-all hover:scale-105">
                        <i class="fas fa-check-circle text-ocean-600 dark:text-ocean-400 mr-2"></i>
                        {{ $equipement->libelle }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        <!-- Right Column: Contact Sidebar -->
        <div class="lg:col-span-1">
            <div class="sticky top-28 space-y-6">

                <!-- Price Card -->
                <div class="bg-gradient-to-br from-ocean-600 via-ocean-700 to-luxe-navy dark:from-luxe-navy dark:via-ocean-900 dark:to-black text-white rounded-3xl shadow-2xl p-8 border border-ocean-500/30">
                    <div class="text-center mb-6">
                        <div class="text-sm text-ocean-100 mb-2">Prix</div>
                        <div class="text-5xl font-black mb-3">
                            {{ number_format($bateau->prix, 0, ',', ' ') }} €
                        </div>
                        <div class="inline-flex items-center gap-1.5 bg-white/15 text-white text-sm font-semibold px-3 py-1.5 rounded-full">
                            <i class="fas fa-map-marker-alt text-xs"></i>
                            {{ $bateau->location }}
                        </div>
                    </div>

                    <div class="space-y-3">
                        <a href="#contact-form" class="block w-full bg-white hover:bg-gray-100 text-ocean-900 px-6 py-4 rounded-2xl font-bold text-center transition-all transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <i class="fas fa-envelope mr-2"></i>
                            Contacter le vendeur
                        </a>
                        <a href="tel:+33629926538" class="block w-full bg-ocean-500/20 hover:bg-ocean-500/30 backdrop-blur-sm border-2 border-white/50 text-white px-6 py-4 rounded-2xl font-bold text-center transition-all">
                            <i class="fas fa-phone mr-2"></i>
                            Appeler
                        </a>
                    </div>
                </div>

                <!-- Share & Favorite -->
                <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl p-6 border border-gray-100 dark:border-white/10">
                    <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Partager cette annonce</h4>
                    <div class="flex flex-wrap gap-2">
                        <button onclick="shareOnFacebook()" class="flex-1 min-w-[60px] bg-blue-600 hover:bg-blue-700 text-white px-3 py-3 rounded-xl font-medium transition-all hover:scale-105 shadow-md" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                        <button onclick="shareOnMessenger()" class="flex-1 min-w-[60px] bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-3 py-3 rounded-xl font-medium transition-all hover:scale-105 shadow-md" title="Messenger">
                            <i class="fab fa-facebook-messenger"></i>
                        </button>
                        <button onclick="shareOnWhatsApp()" class="flex-1 min-w-[60px] bg-green-600 hover:bg-green-700 text-white px-3 py-3 rounded-xl font-medium transition-all hover:scale-105 shadow-md" title="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </button>
                        <button onclick="shareByEmail()" class="flex-1 min-w-[60px] bg-red-500 hover:bg-red-600 text-white px-3 py-3 rounded-xl font-medium transition-all hover:scale-105 shadow-md" title="Email">
                            <i class="fas fa-envelope"></i>
                        </button>
                        <button onclick="copyLink()" class="flex-1 min-w-[60px] bg-gray-600 hover:bg-gray-700 dark:bg-slate-700 dark:hover:bg-slate-600 text-white px-3 py-3 rounded-xl font-medium transition-all hover:scale-105 shadow-md" title="Copier le lien">
                            <i class="fas fa-link"></i>
                        </button>
                    </div>
                    <button onclick="toggleFavorite('{{ $bateau->slug }}')" class="mt-4 w-full bg-gray-100 dark:bg-slate-800 hover:bg-red-50 dark:hover:bg-red-950/30 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 px-4 py-3 rounded-xl font-medium transition-all border border-gray-200 dark:border-slate-700">
                        <i class="favorite-icon-{{ $bateau->slug }} far fa-heart mr-2"></i>
                        Ajouter aux favoris
                    </button>
                </div>

                <!-- Security Notice -->
                <div class="bg-amber-50 dark:bg-amber-950/20 border border-amber-200 dark:border-amber-900/30 rounded-2xl p-5">
                    <div class="flex items-start">
                        <i class="fas fa-shield-alt text-amber-600 dark:text-amber-500 mt-1 mr-3"></i>
                        <div>
                            <h5 class="font-bold text-amber-900 dark:text-amber-200 mb-1">Conseils de sécurité</h5>
                            <p class="text-sm text-amber-800 dark:text-amber-300">Ne versez jamais d'argent avant d'avoir vu le bateau. Méfiez-vous des prix trop attractifs.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Contact Form Section -->
    <div id="contact-form" class="mt-16">
        <div class="max-w-3xl mx-auto bg-white dark:bg-slate-900 rounded-3xl shadow-2xl p-8 md:p-12 border border-gray-100 dark:border-white/10">
            <h3 class="text-3xl font-black text-gray-900 dark:text-white mb-3 text-center">
                Contactez le vendeur
            </h3>
            <p class="text-gray-600 dark:text-gray-400 text-center mb-8">
                Posez vos questions sur ce {{ strtolower($bateau->type->libelle ?? 'bateau') }}
            </p>

            <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                @csrf
                <x-honeypot />
                <input type="hidden" name="bateau_id" value="{{ $bateau->id }}">
                <input type="hidden" name="bateau_titre" value="{{ $bateau->modele }}">
                <input type="hidden" name="bateau_slug" value="{{ $bateau->slug }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Nom complet <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nom" required
                               class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all"
                               placeholder="Votre nom">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" required
                               class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all"
                               placeholder="votre@email.com">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Téléphone <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" name="telephone" required
                           class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all"
                           placeholder="+262 692 XX XX XX">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Votre message <span class="text-red-500">*</span>
                    </label>
                    <textarea name="message" rows="5" required
                              class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all resize-none"
                              placeholder="Je suis intéressé par ce bateau..."></textarea>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-ocean-600 to-luxe-cyan hover:from-ocean-700 hover:to-ocean-600 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all shadow-xl hover:shadow-2xl transform hover:scale-105 relative overflow-hidden group">
                    <span class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></span>
                    <span class="relative z-10">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Envoyer le message
                    </span>
                </button>
            </form>
        </div>
    </div>
</div>

@if($similaires->count() > 0)
<!-- Similar Boats -->
<div class="container mx-auto px-4 pb-16">
    <h2 class="text-2xl md:text-3xl font-black text-gray-900 dark:text-white mb-8 flex items-center gap-3">
        <i class="fas fa-ship text-ocean-600 dark:text-ocean-400"></i>
        Bateaux similaires dans la région
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($similaires->take(3) as $similaire)
        @php
            $simFirstMedia = $similaire->images->first();
            $simImgUrl = $simFirstMedia
                ? cf_img($simFirstMedia->url, ['width' => 480, 'height' => 320, 'fit' => 'cover', 'quality' => 70])
                : asset('images/og-default.jpg');
            $simNom = $similaire->nom ?: $similaire->modele ?: 'Bateau à vendre';
        @endphp
        <a href="{{ route('bateaux.show', $similaire->slug) }}"
           class="group bg-white dark:bg-slate-900 rounded-2xl shadow-lg overflow-hidden border border-gray-100 dark:border-white/10 hover:shadow-xl transition-all hover:-translate-y-1">
            <div class="aspect-video overflow-hidden bg-gray-100 dark:bg-slate-800">
                <img src="{{ $simImgUrl }}"
                     alt="{{ $simNom }} {{ $similaire->occasion ? 'd\'occasion' : 'neuf' }} à vendre {{ $similaire->location }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                     loading="lazy"
                     width="480" height="320">
            </div>
            <div class="p-5">
                <h3 class="font-bold text-gray-900 dark:text-white text-lg mb-1 line-clamp-1">
                    {{ $simNom }}
                </h3>
                <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-3">
                    <i class="fas fa-map-marker-alt text-ocean-500 text-xs"></i>
                    {{ $similaire->location }}
                    @if($similaire->annee)
                    <span class="text-gray-300 dark:text-gray-600">·</span>
                    {{ $similaire->annee }}
                    @endif
                </div>
                <div class="flex items-center justify-between">
                    @if($similaire->afficher_prix && $similaire->prix)
                    <span class="text-xl font-black text-ocean-600 dark:text-ocean-400">
                        {{ number_format($similaire->prix, 0, ',', ' ') }} €
                    </span>
                    @else
                    <span class="text-sm font-semibold text-gray-500 dark:text-gray-400">Prix sur demande</span>
                    @endif
                    <span class="text-xs bg-ocean-100 dark:bg-ocean-900/40 text-ocean-700 dark:text-ocean-300 px-2.5 py-1 rounded-lg font-medium">
                        {{ $similaire->type->libelle ?? 'Bateau' }}
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif

<!-- Lightbox -->
<div id="lightbox" class="fixed inset-0 z-[100] bg-black/95 hidden flex-col" role="dialog" aria-modal="true" aria-label="Galerie photos">

    <!-- Top bar -->
    <div class="flex items-center justify-between px-4 py-3 flex-shrink-0">
        <span id="lb-counter" class="text-white/70 text-sm font-medium"></span>
        <div class="flex items-center gap-2">
            <button onclick="lbZoomIn()" title="Zoom +" class="text-white/80 hover:text-white w-10 h-10 flex items-center justify-center rounded-xl hover:bg-white/10 transition-all text-lg">
                <i class="fas fa-search-plus"></i>
            </button>
            <button onclick="lbZoomOut()" title="Zoom -" class="text-white/80 hover:text-white w-10 h-10 flex items-center justify-center rounded-xl hover:bg-white/10 transition-all text-lg">
                <i class="fas fa-search-minus"></i>
            </button>
            <button onclick="lbResetZoom()" title="Réinitialiser" class="text-white/80 hover:text-white w-10 h-10 flex items-center justify-center rounded-xl hover:bg-white/10 transition-all text-lg">
                <i class="fas fa-compress-arrows-alt"></i>
            </button>
            <button onclick="closeLightbox()" title="Fermer" class="text-white/80 hover:text-white w-10 h-10 flex items-center justify-center rounded-xl hover:bg-white/10 transition-all text-xl ml-2">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- Image area -->
    <div id="lb-img-wrapper" class="flex-1 flex items-center justify-center overflow-hidden relative select-none"
         style="touch-action: none;">
        <img id="lb-img" src="" alt="" class="transition-transform duration-150 will-change-transform"
             style="transform-origin: center center; max-width: 100%; max-height: 100%; object-fit: contain;">
    </div>

    <!-- Prev / Next -->
    @if(count($photos) > 1)
    <button onclick="lbPrev()" class="absolute left-2 top-1/2 -translate-y-1/2 text-white bg-white/10 hover:bg-white/25 w-12 h-12 rounded-xl flex items-center justify-center transition-all text-xl z-10">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button onclick="lbNext()" class="absolute right-2 top-1/2 -translate-y-1/2 text-white bg-white/10 hover:bg-white/25 w-12 h-12 rounded-xl flex items-center justify-center transition-all text-xl z-10">
        <i class="fas fa-chevron-right"></i>
    </button>
    @endif

    <!-- Thumbnails strip (hidden in portrait on small screens) -->
    @if(count($photos) > 1)
    <div class="lb-thumbs-strip flex-shrink-0 px-4 pb-4 pt-2">
        <div id="lb-thumbs" class="flex gap-2 overflow-x-auto hide-scrollbar justify-center">
            @foreach($photosThumbs as $i => $thumb)
            <button onclick="lbGoTo({{ $i }})" data-lb-thumb="{{ $i }}"
                    class="flex-shrink-0 w-14 h-14 rounded-lg overflow-hidden border-2 transition-all opacity-60 hover:opacity-100 {{ $i === 0 ? 'border-white opacity-100' : 'border-transparent' }}">
                <img src="{{ $thumb }}" alt="Photo {{ $i+1 }}" class="w-full h-full object-cover">
            </button>
            @endforeach
        </div>
    </div>
    @endif
</div>

<!-- Floating CTA Buttons (mobile-first) -->
<div id="floating-cta" class="fixed bottom-6 right-4 z-50 flex flex-col items-end gap-3 transition-all duration-300">

    <!-- WhatsApp -->
    <a href="https://wa.me/262692706610?text={{ urlencode('Bonjour, je suis intéressé par le bateau ' . $nomBateau . ' : ' . url()->current()) }}"
       target="_blank"
       rel="noopener"
       aria-label="Contacter par WhatsApp"
       class="group flex items-center gap-3 bg-[#25D366] hover:bg-[#1ebe5d] text-white rounded-full shadow-2xl transition-all duration-200 hover:scale-105 active:scale-95 px-5 py-3.5 md:px-4 md:py-3.5">
        <i class="fab fa-whatsapp text-2xl leading-none"></i>
        <span class="text-sm font-bold whitespace-nowrap hidden sm:inline">WhatsApp</span>
    </a>

    <!-- Email / formulaire -->
    <a href="#contact-form"
       aria-label="Envoyer un message"
       onclick="document.getElementById('contact-form').scrollIntoView({behavior:'smooth'}); return false;"
       class="group flex items-center gap-3 bg-ocean-600 hover:bg-ocean-700 text-white rounded-full shadow-2xl transition-all duration-200 hover:scale-105 active:scale-95 px-5 py-3.5 md:px-4 md:py-3.5">
        <i class="fas fa-envelope text-xl leading-none"></i>
        <span class="text-sm font-bold whitespace-nowrap hidden sm:inline">Envoyer un message</span>
    </a>

</div>

<!-- Gallery JavaScript -->
<script>
const photos = @json($photosLarge);
let currentImageIndex = 0;

function changeImage(index) {
    currentImageIndex = index;
    document.getElementById('mainImage').src = photos[index];
    document.getElementById('imageCounter').textContent = index + 1;

    // Update thumbnail borders
    document.querySelectorAll('.thumbnail-btn').forEach((btn, i) => {
        if (i === index) {
            btn.classList.remove('border-gray-300', 'dark:border-slate-600');
            btn.classList.add('border-ocean-600', 'ring-2', 'ring-ocean-500');
        } else {
            btn.classList.remove('border-ocean-600', 'ring-2', 'ring-ocean-500');
            btn.classList.add('border-gray-300', 'dark:border-slate-600');
        }
    });
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % photos.length;
    changeImage(currentImageIndex);
}

function previousImage() {
    currentImageIndex = (currentImageIndex - 1 + photos.length) % photos.length;
    changeImage(currentImageIndex);
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    if (document.getElementById('lightbox').classList.contains('hidden')) {
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'ArrowLeft') previousImage();
    } else {
        if (e.key === 'ArrowRight') lbNext();
        if (e.key === 'ArrowLeft') lbPrev();
        if (e.key === 'Escape') closeLightbox();
        if (e.key === '+') lbZoomIn();
        if (e.key === '-') lbZoomOut();
    }
});

// ─── Lightbox ────────────────────────────────────────────────────────────────
(function () {
    const lb        = document.getElementById('lightbox');
    const lbImg     = document.getElementById('lb-img');
    const lbCounter = document.getElementById('lb-counter');
    const wrapper   = document.getElementById('lb-img-wrapper');
    let lbIndex = 0;
    let scale = 1, minScale = 0.5, maxScale = 5;
    let originX = 0, originY = 0; // transform origin in % relative to image
    let transX = 0, transY = 0;

    function applyTransform() {
        lbImg.style.transform = `translate(${transX}px, ${transY}px) scale(${scale})`;
    }

    function lbSetImage(index) {
        lbIndex = ((index % photos.length) + photos.length) % photos.length;
        lbImg.src = photos[lbIndex];
        lbCounter.textContent = (lbIndex + 1) + ' / ' + photos.length;
        lbResetZoom();
        // Update thumb highlight
        document.querySelectorAll('[data-lb-thumb]').forEach((btn, i) => {
            btn.classList.toggle('border-white', i === lbIndex);
            btn.classList.toggle('border-transparent', i !== lbIndex);
            btn.classList.toggle('opacity-100', i === lbIndex);
            btn.classList.toggle('opacity-60', i !== lbIndex);
        });
        // Scroll thumb into view
        const activeThumb = document.querySelector('[data-lb-thumb="' + lbIndex + '"]');
        if (activeThumb) activeThumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
    }

    window.openLightbox = function(index) {
        lbSetImage(index);
        lb.classList.remove('hidden');
        lb.classList.add('flex');
        document.body.style.overflow = 'hidden';
    };

    window.closeLightbox = function() {
        lb.classList.add('hidden');
        lb.classList.remove('flex');
        document.body.style.overflow = '';
    };

    window.lbNext    = function() { lbSetImage(lbIndex + 1); };
    window.lbPrev    = function() { lbSetImage(lbIndex - 1); };
    window.lbGoTo    = function(i) { lbSetImage(i); };

    window.lbZoomIn  = function() { lbZoomTo(Math.min(scale * 1.4, maxScale)); };
    window.lbZoomOut = function() { lbZoomTo(Math.max(scale / 1.4, minScale)); };
    window.lbResetZoom = function() { scale = 1; transX = 0; transY = 0; applyTransform(); };

    function lbZoomTo(newScale) {
        scale = newScale;
        applyTransform();
    }

    // Click on backdrop (not image) closes lightbox
    wrapper.addEventListener('click', function(e) {
        if (e.target === wrapper) closeLightbox();
    });

    // Double-click/tap to zoom in/out
    let lastTap = 0;
    lbImg.addEventListener('dblclick', function(e) {
        e.preventDefault();
        if (scale > 1) {
            lbResetZoom();
        } else {
            scale = 2.5;
            applyTransform();
        }
    });
    lbImg.addEventListener('touchend', function(e) {
        const now = Date.now();
        if (now - lastTap < 300) {
            if (scale > 1) lbResetZoom();
            else { scale = 2.5; applyTransform(); }
        }
        lastTap = now;
    });

    // Mouse wheel zoom
    wrapper.addEventListener('wheel', function(e) {
        e.preventDefault();
        const delta = e.deltaY < 0 ? 1.15 : 0.87;
        scale = Math.min(Math.max(scale * delta, minScale), maxScale);
        applyTransform();
    }, { passive: false });

    // Mouse drag (pan when zoomed)
    let isDragging = false, dragStartX = 0, dragStartY = 0, dragOriginX = 0, dragOriginY = 0;
    lbImg.addEventListener('mousedown', function(e) {
        if (scale <= 1) return;
        isDragging = true;
        dragStartX = e.clientX;
        dragStartY = e.clientY;
        dragOriginX = transX;
        dragOriginY = transY;
        lbImg.style.cursor = 'grabbing';
        e.preventDefault();
    });
    document.addEventListener('mousemove', function(e) {
        if (!isDragging) return;
        transX = dragOriginX + (e.clientX - dragStartX);
        transY = dragOriginY + (e.clientY - dragStartY);
        applyTransform();
    });
    document.addEventListener('mouseup', function() {
        isDragging = false;
        lbImg.style.cursor = '';
    });

    // Touch swipe (horizontal) and pinch zoom
    let touchStartX = 0, touchStartY = 0, touchStartDist = 0, touchStartScale = 1;
    let isSwiping = false, isPinching = false;

    wrapper.addEventListener('touchstart', function(e) {
        if (e.touches.length === 1) {
            touchStartX = e.touches[0].clientX;
            touchStartY = e.touches[0].clientY;
            isSwiping = true;
            isPinching = false;
        } else if (e.touches.length === 2) {
            isPinching = true;
            isSwiping = false;
            touchStartDist = Math.hypot(
                e.touches[1].clientX - e.touches[0].clientX,
                e.touches[1].clientY - e.touches[0].clientY
            );
            touchStartScale = scale;
        }
    }, { passive: true });

    wrapper.addEventListener('touchmove', function(e) {
        if (isPinching && e.touches.length === 2) {
            const dist = Math.hypot(
                e.touches[1].clientX - e.touches[0].clientX,
                e.touches[1].clientY - e.touches[0].clientY
            );
            scale = Math.min(Math.max(touchStartScale * (dist / touchStartDist), minScale), maxScale);
            applyTransform();
            e.preventDefault();
        } else if (isSwiping && scale <= 1 && e.touches.length === 1) {
            // Allow scroll prevention only for horizontal swipe
            const dx = Math.abs(e.touches[0].clientX - touchStartX);
            const dy = Math.abs(e.touches[0].clientY - touchStartY);
            if (dx > dy) e.preventDefault();
        }
    }, { passive: false });

    wrapper.addEventListener('touchend', function(e) {
        if (isSwiping && scale <= 1 && e.changedTouches.length === 1) {
            const dx = e.changedTouches[0].clientX - touchStartX;
            const dy = Math.abs(e.changedTouches[0].clientY - touchStartY);
            if (Math.abs(dx) > 50 && dy < 80) {
                dx < 0 ? lbNext() : lbPrev();
            }
        }
        isSwiping = false;
        isPinching = false;
    }, { passive: true });
})();

// Share functions
function shareOnFacebook() {
    window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(window.location.href), '_blank');
}

function shareOnTwitter() {
    window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(window.location.href) + '&text=' + encodeURIComponent('{{ $bateau->nom }}'), '_blank');
}

function shareOnWhatsApp() {
    window.open('https://wa.me/?text=' + encodeURIComponent('{{ $nomBateau }} - ' + window.location.href), '_blank');
}

function shareOnMessenger() {
    var url = encodeURIComponent(window.location.href);
    var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

    if (isMobile) {
        // Deep link vers l'app Messenger
        window.location.href = 'fb-messenger://share?link=' + url;
    } else {
        // Version desktop
        window.open('https://www.facebook.com/dialog/send?link=' + url + '&app_id=291494419107518&redirect_uri=' + encodeURIComponent(window.location.href), '_blank');
    }
}

function shareByEmail() {
    var subject = encodeURIComponent('{{ $nomBateau }} - {{ $typeBateau }}');
    var body = encodeURIComponent('Regarde ce bateau sur My Boat :\n\n{{ $nomBateau }}\n\n' + window.location.href);
    window.location.href = 'mailto:?subject=' + subject + '&body=' + body;
}

function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        alert('Lien copié dans le presse-papier !');
    });
}

function toggleFavorite(slug) {
    const icon = document.querySelector('.favorite-icon-' + slug);
    if (icon.classList.contains('far')) {
        icon.classList.remove('far');
        icon.classList.add('fas');
        icon.style.color = '#ef4444';
    } else {
        icon.classList.remove('fas');
        icon.classList.add('far');
        icon.style.color = '';
    }
}

// Floating CTA: always visible on mobile, show on desktop only once price card scrolls out of view
(function () {
    const cta = document.getElementById('floating-cta');
    const contactForm = document.getElementById('contact-form');
    const isDesktop = () => window.innerWidth >= 1024;

    function updateCta() {
        if (!isDesktop()) {
            // Mobile: always show, hide when contact form is in viewport
            const formRect = contactForm.getBoundingClientRect();
            const formVisible = formRect.top < window.innerHeight && formRect.bottom > 0;
            cta.style.opacity = formVisible ? '0' : '1';
            cta.style.pointerEvents = formVisible ? 'none' : 'auto';
        } else {
            // Desktop: show only after scrolling 400px (price card likely out of view for some users)
            const show = window.scrollY > 400;
            cta.style.opacity = show ? '1' : '0';
            cta.style.pointerEvents = show ? 'auto' : 'none';
        }
    }

    // Initial state
    cta.style.transition = 'opacity 0.3s ease';
    updateCta();
    window.addEventListener('scroll', updateCta, { passive: true });
    window.addEventListener('resize', updateCta, { passive: true });
})();
</script>

<style>
.hide-scrollbar {
    scrollbar-width: none;
    -ms-overflow-style: none;
}
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}

.prose-ocean a {
    @apply text-ocean-600 dark:text-ocean-400 hover:underline;
}

/* Lightbox: hide thumbnail strip in portrait orientation */
@media (orientation: portrait) and (max-width: 768px) {
    .lb-thumbs-strip { display: none !important; }
}
/* Also fix lightbox image: prevent overflow when scale=1 */
#lb-img-wrapper {
    min-height: 0;
}
</style>

@endsection
