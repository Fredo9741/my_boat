@extends('layouts.app')

@section('title', $article->title . ' - Myboat-oi')
@section('description', $article->excerpt)

@section('content')

<!-- Hero Section with Featured Image -->
<div class="relative bg-gradient-to-br from-ocean-600 via-ocean-700 to-luxe-navy dark:from-luxe-navy dark:via-ocean-950 dark:to-black text-white overflow-hidden">
    @if($article->featured_image)
    <div class="absolute inset-0">
        <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-t from-ocean-900 via-ocean-800/80 to-ocean-700/50"></div>
    </div>
    @else
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-20 w-96 h-96 bg-luxe-cyan rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-ocean-400 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
    </div>
    @endif

    <div class="container mx-auto px-4 py-20 relative z-10">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-6">
                <ol class="flex items-center space-x-2 text-sm text-ocean-200">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Accueil</a></li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li><a href="{{ route('articles.index') }}" class="hover:text-white transition-colors">Articles</a></li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-white font-medium truncate max-w-xs">{{ $article->title }}</li>
                </ol>
            </nav>

            <!-- Meta -->
            <div class="flex items-center space-x-4 mb-6">
                <span class="inline-flex items-center text-sm text-ocean-100">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    {{ $article->formatted_date }}
                </span>
                @if($article->user)
                <span class="inline-flex items-center text-sm text-ocean-100">
                    <i class="fas fa-user mr-2"></i>
                    {{ $article->user->name }}
                </span>
                @endif
            </div>

            <!-- Title -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black leading-tight">{{ $article->title }}</h1>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">

        <!-- Article Content -->
        <article class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl p-8 md:p-12 border border-gray-100 dark:border-white/10 mb-12">
            <div class="prose prose-lg dark:prose-invert max-w-none article-content">
                {!! $article->content !!}
            </div>
        </article>

        <!-- Share Buttons -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-lg p-6 border border-gray-100 dark:border-white/10 mb-12">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                <i class="fas fa-share-alt mr-2 text-ocean-500"></i>Partager cet article
            </h3>
            <div class="flex items-center space-x-3">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" class="w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-xl flex items-center justify-center transition-all hover:scale-110 shadow-lg">
                    <i class="fab fa-facebook-f text-xl"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" target="_blank" rel="noopener" class="w-12 h-12 bg-sky-500 hover:bg-sky-600 text-white rounded-xl flex items-center justify-center transition-all hover:scale-110 shadow-lg">
                    <i class="fab fa-twitter text-xl"></i>
                </a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($article->title) }}" target="_blank" rel="noopener" class="w-12 h-12 bg-blue-700 hover:bg-blue-800 text-white rounded-xl flex items-center justify-center transition-all hover:scale-110 shadow-lg">
                    <i class="fab fa-linkedin-in text-xl"></i>
                </a>
                <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . request()->url()) }}" target="_blank" rel="noopener" class="w-12 h-12 bg-green-500 hover:bg-green-600 text-white rounded-xl flex items-center justify-center transition-all hover:scale-110 shadow-lg">
                    <i class="fab fa-whatsapp text-xl"></i>
                </a>
                <button onclick="navigator.clipboard.writeText('{{ request()->url() }}'); alert('Lien copié !');" class="w-12 h-12 bg-gray-600 hover:bg-gray-700 text-white rounded-xl flex items-center justify-center transition-all hover:scale-110 shadow-lg">
                    <i class="fas fa-link text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Related Articles -->
        @if($relatedArticles->count() > 0)
        <div class="mb-12">
            <h2 class="text-3xl font-black text-gray-900 dark:text-white mb-8 flex items-center">
                <i class="fas fa-newspaper mr-3 text-ocean-500"></i>
                Articles similaires
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedArticles as $related)
                <article class="bg-white dark:bg-slate-900 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all transform hover:-translate-y-1 border border-gray-100 dark:border-white/10 group">
                    <a href="{{ route('articles.show', $related->slug) }}" class="block">
                        @if($related->featured_image)
                        <img src="{{ $related->featured_image_url }}" alt="{{ $related->title }}" class="w-full h-40 object-cover transition-transform duration-300 group-hover:scale-105">
                        @else
                        <div class="w-full h-40 bg-gradient-to-br from-ocean-100 to-ocean-200 dark:from-ocean-950 dark:to-ocean-900 flex items-center justify-center">
                            <i class="fas fa-newspaper text-4xl text-ocean-400"></i>
                        </div>
                        @endif
                    </a>
                    <div class="p-5">
                        <div class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                            <i class="fas fa-calendar-alt mr-1"></i>{{ $related->formatted_date }}
                        </div>
                        <h3 class="font-bold text-gray-900 dark:text-white group-hover:text-ocean-600 dark:group-hover:text-ocean-400 transition-colors line-clamp-2">
                            <a href="{{ route('articles.show', $related->slug) }}">{{ $related->title }}</a>
                        </h3>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Back to Articles -->
        <div class="text-center">
            <a href="{{ route('articles.index') }}" class="inline-flex items-center bg-gradient-to-r from-ocean-600 to-luxe-cyan hover:from-ocean-700 hover:to-ocean-600 text-white px-8 py-4 rounded-xl font-semibold transition-all shadow-lg hover:shadow-2xl transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i>
                Voir tous les articles
            </a>
        </div>

    </div>
</div>

@endsection

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .article-content h2 {
        font-size: 1.75rem;
        font-weight: 800;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
        color: #1f2937;
        border-bottom: 2px solid #0ea5e9;
        padding-bottom: 0.5rem;
    }
    .dark .article-content h2 {
        color: #f9fafb;
        border-bottom-color: #0284c7;
    }

    .article-content h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 0.75rem;
        color: #374151;
    }
    .dark .article-content h3 {
        color: #e5e7eb;
    }

    .article-content h4 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
        color: #4b5563;
    }
    .dark .article-content h4 {
        color: #d1d5db;
    }

    .article-content p {
        margin-bottom: 1.25rem;
        line-height: 1.8;
        color: #4b5563;
    }
    .dark .article-content p {
        color: #9ca3af;
    }

    .article-content ul, .article-content ol {
        margin-bottom: 1.25rem;
        padding-left: 1.75rem;
    }

    .article-content li {
        margin-bottom: 0.5rem;
        color: #4b5563;
    }
    .dark .article-content li {
        color: #9ca3af;
    }

    .article-content blockquote {
        border-left: 4px solid #0ea5e9;
        padding-left: 1.5rem;
        margin: 2rem 0;
        font-style: italic;
        color: #6b7280;
        background: linear-gradient(to right, rgba(14, 165, 233, 0.1), transparent);
        padding: 1rem 1.5rem;
        border-radius: 0 0.5rem 0.5rem 0;
    }
    .dark .article-content blockquote {
        color: #9ca3af;
        background: linear-gradient(to right, rgba(14, 165, 233, 0.15), transparent);
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 1rem;
        margin: 2rem auto;
        box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.2);
    }

    .article-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 2rem 0;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .article-content th, .article-content td {
        border: 1px solid #e5e7eb;
        padding: 0.75rem 1rem;
        text-align: left;
    }
    .dark .article-content th, .dark .article-content td {
        border-color: #374151;
    }

    .article-content th {
        background-color: #f3f4f6;
        font-weight: 600;
        color: #1f2937;
    }
    .dark .article-content th {
        background-color: #1f2937;
        color: #f9fafb;
    }

    .article-content a {
        color: #0ea5e9;
        text-decoration: underline;
        text-underline-offset: 2px;
    }
    .article-content a:hover {
        color: #0284c7;
    }

    .article-content hr {
        margin: 3rem 0;
        border: none;
        height: 2px;
        background: linear-gradient(to right, transparent, #e5e7eb, transparent);
    }
    .dark .article-content hr {
        background: linear-gradient(to right, transparent, #374151, transparent);
    }

    .article-content iframe {
        max-width: 100%;
        margin: 2rem auto;
        border-radius: 1rem;
        box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.2);
    }

    .article-content figure {
        margin: 2rem 0;
    }

    .article-content figcaption {
        text-align: center;
        font-size: 0.875rem;
        color: #6b7280;
        margin-top: 0.5rem;
    }
    .dark .article-content figcaption {
        color: #9ca3af;
    }
</style>
@endpush
