@extends('layouts.admin')

@section('title', $article->title . ' - Administration')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        @include('components.admin-sidebar')

        <main class="lg:col-span-3">
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center space-x-3 mb-2">
                            @if($article->status === 'published')
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>Publié
                            </span>
                            @else
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-edit mr-1"></i>Brouillon
                            </span>
                            @endif
                        </div>
                        <h1 class="text-3xl font-bold text-gray-800">{{ $article->title }}</h1>
                        <p class="text-gray-600 mt-2">
                            <i class="fas fa-calendar mr-1"></i>
                            {{ $article->created_at->format('d/m/Y à H:i') }}
                            @if($article->user)
                            <span class="mx-2">|</span>
                            <i class="fas fa-user mr-1"></i>
                            {{ $article->user->name }}
                            @endif
                        </p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.articles.edit', $article) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition shadow-lg">
                            <i class="fas fa-edit mr-2"></i>Modifier
                        </a>
                        <a href="{{ route('admin.articles.index') }}" class="text-gray-600 hover:text-gray-800 transition">
                            <i class="fas fa-arrow-left mr-2"></i>Retour
                        </a>
                    </div>
                </div>
            </div>

            <!-- Image à la une -->
            @if($article->featured_image)
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" class="w-full h-64 object-cover">
            </div>
            @endif

            <!-- Contenu de l'article -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">
                        <i class="fas fa-file-alt mr-2 text-blue-600"></i>Contenu
                    </h2>

                    <div class="prose prose-lg max-w-none article-content">
                        {!! $article->content !!}
                    </div>
                </div>
            </div>

            <!-- Métadonnées -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">
                        <i class="fas fa-info-circle mr-2 text-blue-600"></i>Informations
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-sm text-gray-500 mb-1">Slug</div>
                            <div class="font-mono text-gray-800">{{ $article->slug }}</div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-sm text-gray-500 mb-1">Statut</div>
                            <div class="text-gray-800">
                                @if($article->status === 'published')
                                <span class="text-green-600 font-semibold">Publié</span>
                                @else
                                <span class="text-yellow-600 font-semibold">Brouillon</span>
                                @endif
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-sm text-gray-500 mb-1">Créé le</div>
                            <div class="text-gray-800">{{ $article->created_at->format('d/m/Y à H:i') }}</div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-sm text-gray-500 mb-1">Mis à jour le</div>
                            <div class="text-gray-800">{{ $article->updated_at->format('d/m/Y à H:i') }}</div>
                        </div>

                        @if($article->published_at)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-sm text-gray-500 mb-1">Publié le</div>
                            <div class="text-gray-800">{{ $article->published_at->format('d/m/Y à H:i') }}</div>
                        </div>
                        @endif

                        @if($article->user)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-sm text-gray-500 mb-1">Auteur</div>
                            <div class="text-gray-800">{{ $article->user->name }}</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between">
                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                        <i class="fas fa-trash mr-2"></i>Supprimer
                    </button>
                </form>

                <a href="{{ route('admin.articles.edit', $article) }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition">
                    <i class="fas fa-edit mr-2"></i>Modifier cet article
                </a>
            </div>
        </main>
    </div>
</div>
@endsection

@push('styles')
<style>
    .article-content h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #1f2937;
    }
    .article-content h3 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        color: #374151;
    }
    .article-content h4 {
        font-size: 1.125rem;
        font-weight: 600;
        margin-top: 1.25rem;
        margin-bottom: 0.5rem;
        color: #4b5563;
    }
    .article-content p {
        margin-bottom: 1rem;
        line-height: 1.75;
        color: #4b5563;
    }
    .article-content ul, .article-content ol {
        margin-bottom: 1rem;
        padding-left: 1.5rem;
    }
    .article-content li {
        margin-bottom: 0.5rem;
    }
    .article-content blockquote {
        border-left: 4px solid #3b82f6;
        padding-left: 1rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #6b7280;
    }
    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1.5rem 0;
    }
    .article-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 1.5rem 0;
    }
    .article-content th, .article-content td {
        border: 1px solid #e5e7eb;
        padding: 0.75rem;
        text-align: left;
    }
    .article-content th {
        background-color: #f9fafb;
        font-weight: 600;
    }
    .article-content a {
        color: #3b82f6;
        text-decoration: underline;
    }
    .article-content a:hover {
        color: #1d4ed8;
    }
    .article-content hr {
        margin: 2rem 0;
        border-color: #e5e7eb;
    }
    .article-content iframe {
        max-width: 100%;
        margin: 1.5rem 0;
    }
</style>
@endpush
