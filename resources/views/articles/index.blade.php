@extends('layouts.app')

@section('title', 'Articles - Myboat-oi | Blog Maritime Océan Indien')
@section('description', 'Découvrez nos articles sur le monde maritime, les conseils d\'achat de bateaux, et l\'actualité nautique de l\'océan Indien.')

@section('content')

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-ocean-600 via-ocean-700 to-luxe-navy dark:from-luxe-navy dark:via-ocean-950 dark:to-black text-white py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-20 w-96 h-96 bg-luxe-cyan rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-ocean-400 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-5xl md:text-6xl font-black mb-4">Articles</h1>
            <p class="text-xl text-ocean-100 dark:text-ocean-200">Conseils, actualités et guides pour les passionnés de navigation</p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-16">

    @if($articles->count() > 0)
    <!-- Articles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($articles as $article)
        <article class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all transform hover:-translate-y-2 border border-gray-100 dark:border-white/10 group">
            <!-- Image -->
            <a href="{{ route('articles.show', $article->slug) }}" class="block relative overflow-hidden">
                @if($article->featured_image)
                <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                @else
                <div class="w-full h-56 bg-gradient-to-br from-ocean-100 to-ocean-200 dark:from-ocean-950 dark:to-ocean-900 flex items-center justify-center">
                    <i class="fas fa-newspaper text-6xl text-ocean-400 dark:text-ocean-600"></i>
                </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </a>

            <!-- Content -->
            <div class="p-6">
                <!-- Date -->
                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-3">
                    <i class="fas fa-calendar-alt mr-2 text-ocean-500"></i>
                    {{ $article->formatted_date }}
                </div>

                <!-- Title -->
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-ocean-600 dark:group-hover:text-ocean-400 transition-colors">
                    <a href="{{ route('articles.show', $article->slug) }}">
                        {{ $article->title }}
                    </a>
                </h2>

                <!-- Excerpt -->
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-3">
                    {{ $article->excerpt }}
                </p>

                <!-- Read More -->
                <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center text-ocean-600 dark:text-ocean-400 hover:text-ocean-700 dark:hover:text-ocean-300 font-semibold transition-colors group/link">
                    Lire la suite
                    <i class="fas fa-arrow-right ml-2 transform group-hover/link:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </article>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($articles->hasPages())
    <div class="mt-12 flex justify-center">
        {{ $articles->links() }}
    </div>
    @endif

    @else
    <!-- Empty State -->
    <div class="text-center py-20">
        <div class="w-32 h-32 bg-gradient-to-br from-ocean-100 to-ocean-200 dark:from-ocean-950 dark:to-ocean-900 rounded-full flex items-center justify-center mx-auto mb-8">
            <i class="fas fa-newspaper text-5xl text-ocean-500 dark:text-ocean-400"></i>
        </div>
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Aucun article pour le moment</h2>
        <p class="text-gray-600 dark:text-gray-400 text-lg mb-8">
            Nos articles arrivent bientôt ! Revenez nous voir prochainement.
        </p>
        <a href="{{ route('home') }}" class="inline-flex items-center bg-gradient-to-r from-ocean-600 to-luxe-cyan hover:from-ocean-700 hover:to-ocean-600 text-white px-8 py-4 rounded-xl font-semibold transition-all shadow-lg hover:shadow-2xl transform hover:scale-105">
            <i class="fas fa-home mr-2"></i>
            Retour à l'accueil
        </a>
    </div>
    @endif

</div>

@endsection

@push('styles')
<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
