@extends('layouts.app')

@section('title', $seoData['title'])
@section('description', $seoData['description'])
@section('og_title', $seoData['title'])
@section('og_description', $seoData['description'])
@section('og_type', 'website')

@section('content')

{{-- Hero --}}
<div class="relative bg-gradient-to-br from-ocean-700 via-ocean-800 to-luxe-navy text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-20 w-96 h-96 bg-luxe-cyan rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-20 w-80 h-80 bg-ocean-400 rounded-full blur-3xl"></div>
    </div>
    <div class="container mx-auto px-4 py-16 relative z-10">
        <nav class="mb-6 text-sm text-ocean-200">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Accueil</a>
            <span class="mx-2"><i class="fas fa-chevron-right text-xs"></i></span>
            <a href="{{ route('bateaux.index') }}" class="hover:text-white transition-colors">Annonces</a>
            <span class="mx-2"><i class="fas fa-chevron-right text-xs"></i></span>
            <span class="text-white font-medium">{{ $seoData['name'] }}</span>
        </nav>
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
            <div>
                <h1 class="text-4xl md:text-5xl font-black mb-3">{{ $seoData['heading'] }}</h1>
                <p class="text-ocean-200 text-lg">
                    <i class="fas fa-ship mr-2"></i>
                    <span class="font-bold text-white">{{ $bateaux->count() }}</span>
                    {{ $bateaux->count() > 1 ? 'annonces disponibles' : 'annonce disponible' }}
                </p>
            </div>
            <a href="{{ route('bateaux.index', ['zone' => $zone->slug]) }}"
               class="inline-flex items-center gap-2 bg-white/15 hover:bg-white/25 border border-white/30 text-white px-5 py-3 rounded-xl text-sm font-semibold transition-all self-start md:self-auto">
                <i class="fas fa-sliders-h"></i> Filtres avancés
            </a>
        </div>
    </div>
</div>

{{-- Intro + Highlights --}}
<div class="bg-white dark:bg-slate-900 border-b border-gray-100 dark:border-white/10">
    <div class="container mx-auto px-4 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

            {{-- Texte intro --}}
            <div>
                <p class="text-gray-600 dark:text-gray-300 text-base leading-relaxed border-l-4 border-ocean-500 pl-5">
                    {{ $seoData['intro'] }}
                </p>
            </div>

            {{-- Points clés --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach($seoData['highlights'] as $h)
                <div class="flex items-start gap-3 bg-ocean-50 dark:bg-ocean-950/40 rounded-xl p-4 border border-ocean-100 dark:border-ocean-800/40">
                    <div class="w-8 h-8 rounded-lg bg-ocean-500 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="fas {{ $h['icon'] }} text-white text-sm"></i>
                    </div>
                    <p class="text-sm text-gray-700 dark:text-gray-300 font-medium leading-snug">{{ $h['text'] }}</p>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-10">

    {{-- Filtres par type --}}
    <div class="flex flex-wrap gap-3 items-center mb-8">
        @foreach($types as $type)
            @if($type->bateaux_count > 0)
            @php $active = in_array($type->slug, (array) request('type')); @endphp
            <a href="{{ request()->fullUrlWithQuery(['type' => $active ? null : $type->slug]) }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold border transition-all
                      {{ $active
                         ? 'bg-ocean-600 text-white border-ocean-600 shadow-md'
                         : 'bg-white dark:bg-slate-800 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-white/10 hover:border-ocean-400' }}">
                {{ $type->libelle }}
                <span class="text-xs opacity-60">({{ $type->bateaux_count }})</span>
            </a>
            @endif
        @endforeach

        @if(request()->hasAny(['type', 'prix_min', 'prix_max']))
        <a href="{{ url()->current() }}" class="inline-flex items-center gap-1 px-3 py-2 rounded-full text-sm text-gray-500 dark:text-gray-400 hover:text-red-500 transition-colors border border-gray-200 dark:border-white/10">
            <i class="fas fa-times text-xs"></i> Effacer
        </a>
        @endif
    </div>

    {{-- Grille bateaux --}}
    @if($bateaux->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 md:gap-8 mb-12">
            @foreach($bateaux as $bateau)
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
                    :alt="$bateau->alt_text"
                    :priority="$loop->index < 3"
                />
            @endforeach
        </div>
    @else
        <div class="text-center py-20">
            <i class="fas fa-ship text-5xl text-gray-300 dark:text-gray-600 mb-4 block"></i>
            <p class="text-xl text-gray-500 dark:text-gray-400 mb-6">Aucune annonce disponible en ce moment pour {{ $seoData['name'] }}.</p>
            <a href="{{ route('bateaux.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-ocean-600 to-luxe-cyan text-white font-bold px-6 py-3 rounded-xl hover:shadow-xl transition-all">
                <i class="fas fa-search"></i> Voir toutes les annonces
            </a>
        </div>
    @endif

    {{-- CTA Vendre --}}
    <div class="bg-gradient-to-r from-ocean-600 to-luxe-cyan rounded-3xl p-8 text-white text-center shadow-2xl">
        <h2 class="text-2xl font-black mb-3">Vous avez un bateau à vendre à {{ $seoData['name'] }} ?</h2>
        <p class="text-ocean-100 mb-6">Déposez votre annonce et touchez des acheteurs dans tout l'Océan Indien.</p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('fiche-bateau') }}" class="inline-flex items-center justify-center gap-2 bg-white text-ocean-700 font-bold px-6 py-3 rounded-xl hover:bg-ocean-50 transition-all shadow-lg">
                <i class="fas fa-plus"></i> Déposer mon bateau
            </a>
            <a href="{{ route('sell') }}" class="inline-flex items-center justify-center gap-2 bg-white/20 hover:bg-white/30 text-white font-bold px-6 py-3 rounded-xl transition-all border border-white/30">
                <i class="fas fa-euro-sign"></i> Estimation gratuite
            </a>
        </div>
    </div>

</div>

@endsection
