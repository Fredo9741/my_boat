@extends('layouts.app')

@section('title', __('Bateau vendu') . ' - Myboat-oi')
@section('description', __('Ce bateau a été vendu. Découvrez nos autres bateaux disponibles dans l\'océan Indien.'))

@section('content')

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-ocean-600 via-ocean-700 to-luxe-navy dark:from-luxe-navy dark:via-ocean-950 dark:to-black text-white py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-20 w-96 h-96 bg-luxe-cyan rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-ocean-400 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <div class="w-24 h-24 bg-white/10 backdrop-blur rounded-full flex items-center justify-center mx-auto mb-8">
                <i class="fas fa-check-circle text-5xl text-green-400"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-black mb-4">{{ __('Ce bateau a été vendu !') }}</h1>
            <p class="text-xl text-ocean-100 dark:text-ocean-200">{{ __('Bonne nouvelle pour son ancien propriétaire ! Mais ne vous inquiétez pas, nous avons d\'autres bateaux qui pourraient vous plaire.') }}</p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-16">

    <!-- Call to Action -->
    <div class="max-w-3xl mx-auto text-center mb-16">
        <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-8 md:p-12 border border-gray-100 dark:border-white/10">
            <i class="fas fa-ship text-6xl text-ocean-500 mb-6"></i>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-4">
                {{ __('Trouvez votre prochain bateau') }}
            </h2>
            <p class="text-gray-600 dark:text-gray-400 mb-8">
                {{ __('Explorez notre catalogue de bateaux disponibles à la vente dans l\'océan Indien : La Réunion, Maurice, Madagascar, Seychelles et plus encore.') }}
            </p>
            <a href="{{ route('bateaux.index') }}" class="inline-flex items-center bg-gradient-to-r from-ocean-600 to-luxe-cyan hover:from-ocean-700 hover:to-ocean-600 text-white px-8 py-4 rounded-xl font-semibold transition-all shadow-lg hover:shadow-2xl transform hover:scale-105">
                <i class="fas fa-search mr-3"></i>
                {{ __('Voir tous les bateaux disponibles') }}
            </a>
        </div>
    </div>

    <!-- Suggested Boats -->
    @if($suggestedBoats->count() > 0)
    <div class="mb-12">
        <h2 class="text-3xl font-black text-gray-900 dark:text-white mb-8 text-center">
            <i class="fas fa-star mr-3 text-ocean-500"></i>
            {{ __('Bateaux qui pourraient vous intéresser') }}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($suggestedBoats as $boat)
            <article class="bg-white dark:bg-slate-900 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all transform hover:-translate-y-1 border border-gray-100 dark:border-white/10 group">
                <a href="{{ route('bateaux.show', $boat->slug) }}" class="block">
                    @if($boat->main_image)
                    <img src="{{ $boat->main_image }}" alt="{{ $boat->titre }}" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                    @else
                    <div class="w-full h-48 bg-gradient-to-br from-ocean-100 to-ocean-200 dark:from-ocean-950 dark:to-ocean-900 flex items-center justify-center">
                        <i class="fas fa-ship text-4xl text-ocean-400"></i>
                    </div>
                    @endif
                </a>
                <div class="p-5">
                    <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 mb-2">
                        @if($boat->type)
                        <span class="bg-ocean-100 dark:bg-ocean-950 text-ocean-700 dark:text-ocean-300 px-2 py-1 rounded-full">{{ $boat->type->libelle }}</span>
                        @endif
                        @if($boat->zone)
                        <span><i class="fas fa-map-marker-alt mr-1"></i>{{ $boat->zone->libelle }}</span>
                        @endif
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white group-hover:text-ocean-600 dark:group-hover:text-ocean-400 transition-colors mb-2">
                        <a href="{{ route('bateaux.show', $boat->slug) }}">{{ $boat->titre }}</a>
                    </h3>
                    <p class="text-ocean-600 dark:text-ocean-400 font-bold text-lg">
                        {{ number_format($boat->prix, 0, ',', ' ') }} €
                    </p>
                </div>
            </article>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Contact CTA -->
    <div class="bg-gradient-to-r from-ocean-600 to-luxe-cyan rounded-3xl p-8 md:p-12 text-white text-center">
        <h3 class="text-2xl md:text-3xl font-bold mb-4">{{ __('Vous cherchez un bateau spécifique ?') }}</h3>
        <p class="text-ocean-100 mb-8 max-w-2xl mx-auto">
            {{ __('Contactez-nous avec vos critères et nous vous aiderons à trouver le bateau idéal dans l\'océan Indien.') }}
        </p>
        <a href="{{ route('contact') }}" class="inline-flex items-center bg-white text-ocean-600 hover:bg-ocean-50 px-8 py-4 rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl">
            <i class="fas fa-envelope mr-3"></i>
            {{ __('Nous contacter') }}
        </a>
    </div>

</div>

@endsection
