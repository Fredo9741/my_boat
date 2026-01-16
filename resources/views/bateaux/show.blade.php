@extends('layouts.app')

@section('title', $bateau->nom . ' - ' . ($bateau->type->libelle ?? 'Bateau'))
@section('meta_description', 'Découvrez ' . $bateau->nom . ' - ' . Str::limit($bateau->description, 150))

@push('head')
<meta property="og:title" content="{{ $bateau->nom }} - {{ $bateau->type->libelle ?? 'Bateau' }}">
<meta property="og:description" content="{{ Str::limit($bateau->description, 200) }}">
<meta property="og:image" content="{{ $bateau->photo_principale ? Storage::disk('r2')->url($bateau->photo_principale) : asset('images/default-boat.jpg') }}">
<meta property="og:type" content="product">
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
                <h1 class="text-3xl md:text-4xl font-black mb-3">{{ $bateau->nom }}</h1>
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
                @if($bateau->negociable)
                <span class="inline-block bg-luxe-gold/20 text-luxe-gold px-4 py-1.5 rounded-full text-sm font-semibold backdrop-blur-sm">
                    Prix négociable
                </span>
                @endif
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
                @endphp

                <!-- Main Image -->
                <div class="relative bg-gray-100 dark:bg-slate-800 aspect-video overflow-hidden">
                    <img id="mainImage"
                         src="{{ $photos[0] }}"
                         alt="{{ $bateau->nom }}"
                         class="w-full h-full object-cover"
                         onerror="this.style.objectFit='contain'; this.parentElement.classList.add('bg-gray-200', 'dark:bg-slate-700');">

                    <!-- Image Counter Badge -->
                    <div class="absolute top-6 right-6 bg-black/60 backdrop-blur-md text-white px-4 py-2 rounded-xl font-semibold shadow-lg">
                        <i class="fas fa-images mr-2"></i>
                        <span id="imageCounter">1</span> / {{ count($photos) }}
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
                        @foreach($photos as $index => $photo)
                        <button onclick="changeImage({{ $index }})"
                                class="thumbnail-btn flex-shrink-0 w-24 h-24 rounded-xl overflow-hidden border-3 transition-all hover:scale-105 {{ $index === 0 ? 'border-ocean-600 ring-2 ring-ocean-500' : 'border-gray-300 dark:border-slate-600' }}">
                            <img src="{{ $photo }}" alt="Photo {{ $index + 1 }}" class="w-full h-full object-cover">
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
                    <div class="relative rounded-2xl overflow-hidden shadow-lg aspect-video bg-gray-900">
                        <iframe
                            class="w-full h-full"
                            src="{{ $video->url }}"
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
                <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-6 flex items-center">
                    <i class="fas fa-align-left text-ocean-600 dark:text-ocean-400 mr-3"></i>
                    Description
                </h3>
                <div class="prose prose-ocean dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 leading-relaxed">
                    {!! nl2br(e($bateau->description)) !!}
                </div>
            </div>

            <!-- Technical Specifications -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl p-6 md:p-8 border border-gray-100 dark:border-white/10">
                <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-6 flex items-center">
                    <i class="fas fa-cog text-ocean-600 dark:text-ocean-400 mr-3"></i>
                    Caractéristiques techniques
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-ocean-50 dark:bg-slate-800/50 rounded-2xl p-5 border border-ocean-100 dark:border-ocean-900/30">
                        <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Type de bateau</div>
                        <div class="text-lg font-bold text-gray-900 dark:text-white">{{ $bateau->type->libelle ?? 'Bateau' }}</div>
                    </div>
                    <div class="bg-ocean-50 dark:bg-slate-800/50 rounded-2xl p-5 border border-ocean-100 dark:border-ocean-900/30">
                        <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Longueur</div>
                        <div class="text-lg font-bold text-gray-900 dark:text-white">{{ $bateau->length }}</div>
                    </div>
                    <div class="bg-ocean-50 dark:bg-slate-800/50 rounded-2xl p-5 border border-ocean-100 dark:border-ocean-900/30">
                        <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Année</div>
                        <div class="text-lg font-bold text-gray-900 dark:text-white">{{ $bateau->annee }}</div>
                    </div>
                    @if($bateau->cabines)
                    <div class="bg-ocean-50 dark:bg-slate-800/50 rounded-2xl p-5 border border-ocean-100 dark:border-ocean-900/30">
                        <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Cabines</div>
                        <div class="text-lg font-bold text-gray-900 dark:text-white">{{ $bateau->cabines }}</div>
                    </div>
                    @endif
                    @if($bateau->passagers)
                    <div class="bg-ocean-50 dark:bg-slate-800/50 rounded-2xl p-5 border border-ocean-100 dark:border-ocean-900/30">
                        <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Passagers</div>
                        <div class="text-lg font-bold text-gray-900 dark:text-white">{{ $bateau->passagers }}</div>
                    </div>
                    @endif
                    @if($bateau->puissance)
                    <div class="bg-ocean-50 dark:bg-slate-800/50 rounded-2xl p-5 border border-ocean-100 dark:border-ocean-900/30">
                        <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Puissance moteur</div>
                        <div class="text-lg font-bold text-gray-900 dark:text-white">{{ $bateau->puissance }} CV</div>
                    </div>
                    @endif
                    @if($bateau->etat)
                    <div class="bg-ocean-50 dark:bg-slate-800/50 rounded-2xl p-5 border border-ocean-100 dark:border-ocean-900/30">
                        <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">État</div>
                        <div class="text-lg font-bold text-gray-900 dark:text-white">{{ ucfirst($bateau->etat) }}</div>
                    </div>
                    @endif
                    <div class="bg-ocean-50 dark:bg-slate-800/50 rounded-2xl p-5 border border-ocean-100 dark:border-ocean-900/30">
                        <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Localisation</div>
                        <div class="text-lg font-bold text-gray-900 dark:text-white">{{ $bateau->location }}</div>
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
                        @if($bateau->negociable)
                        <span class="inline-block bg-luxe-gold/30 backdrop-blur-sm text-luxe-gold px-4 py-1.5 rounded-full text-sm font-semibold">
                            Négociable
                        </span>
                        @endif
                    </div>

                    <div class="space-y-3">
                        <a href="#contact-form" class="block w-full bg-white hover:bg-gray-100 text-ocean-900 px-6 py-4 rounded-2xl font-bold text-center transition-all transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <i class="fas fa-envelope mr-2"></i>
                            Contacter le vendeur
                        </a>
                        <a href="tel:+262692000000" class="block w-full bg-ocean-500/20 hover:bg-ocean-500/30 backdrop-blur-sm border-2 border-white/50 text-white px-6 py-4 rounded-2xl font-bold text-center transition-all">
                            <i class="fas fa-phone mr-2"></i>
                            Appeler
                        </a>
                    </div>
                </div>

                <!-- Share & Favorite -->
                <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl p-6 border border-gray-100 dark:border-white/10">
                    <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Partager cette annonce</h4>
                    <div class="flex gap-3">
                        <button onclick="shareOnFacebook()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-xl font-medium transition-all hover:scale-105 shadow-md">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                        <button onclick="shareOnTwitter()" class="flex-1 bg-sky-500 hover:bg-sky-600 text-white px-4 py-3 rounded-xl font-medium transition-all hover:scale-105 shadow-md">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button onclick="shareOnWhatsApp()" class="flex-1 bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-xl font-medium transition-all hover:scale-105 shadow-md">
                            <i class="fab fa-whatsapp"></i>
                        </button>
                        <button onclick="copyLink()" class="flex-1 bg-gray-600 hover:bg-gray-700 dark:bg-slate-700 dark:hover:bg-slate-600 text-white px-4 py-3 rounded-xl font-medium transition-all hover:scale-105 shadow-md" title="Copier le lien">
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
                <input type="hidden" name="bateau_id" value="{{ $bateau->id }}">
                <input type="hidden" name="bateau_titre" value="{{ $bateau->nom }}">
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

<!-- Gallery JavaScript -->
<script>
const photos = @json($photos);
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
    if (e.key === 'ArrowRight') nextImage();
    if (e.key === 'ArrowLeft') previousImage();
});

// Share functions
function shareOnFacebook() {
    window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(window.location.href), '_blank');
}

function shareOnTwitter() {
    window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(window.location.href) + '&text=' + encodeURIComponent('{{ $bateau->nom }}'), '_blank');
}

function shareOnWhatsApp() {
    window.open('https://wa.me/?text=' + encodeURIComponent('{{ $bateau->nom }} - ' + window.location.href), '_blank');
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
</style>

@endsection
