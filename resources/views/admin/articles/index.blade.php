@extends('layouts.admin')

@section('title', 'Articles - Administration')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        @include('components.admin-sidebar')

        <main class="lg:col-span-3">
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Articles</h1>
                        <p class="text-gray-600 mt-2">{{ $articles->total() }} article(s)</p>
                    </div>
                    <a href="{{ route('admin.articles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition shadow-lg">
                        <i class="fas fa-plus-circle mr-2"></i>Nouvel article
                    </a>
                </div>
            </div>

            @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                @if($articles->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Article</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($articles as $article)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if($article->featured_image)
                                        <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" class="w-16 h-12 object-cover rounded mr-4">
                                        @else
                                        <div class="w-16 h-12 bg-gray-200 rounded mr-4 flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $article->title }}</div>
                                            <div class="text-sm text-gray-500 font-mono">{{ $article->slug }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($article->status === 'published')
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>Publié
                                    </span>
                                    @else
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-edit mr-1"></i>Brouillon
                                    </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $article->created_at->format('d/m/Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ $article->created_at->format('H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('admin.articles.show', $article) }}"
                                           class="text-gray-600 hover:text-gray-900 transition"
                                           title="Voir">
                                            <i class="fas fa-eye text-lg"></i>
                                        </a>
                                        <a href="{{ route('admin.articles.edit', $article) }}"
                                           class="text-blue-600 hover:text-blue-900 transition"
                                           title="Modifier">
                                            <i class="fas fa-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('admin.articles.destroy', $article) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-900 transition"
                                                    title="Supprimer">
                                                <i class="fas fa-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($articles->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $articles->links() }}
                </div>
                @endif
                @else
                <div class="text-center py-12">
                    <i class="fas fa-newspaper text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Aucun article</h3>
                    <p class="text-gray-500 mb-6">Commencez par créer votre premier article</p>
                    <a href="{{ route('admin.articles.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                        <i class="fas fa-plus-circle mr-2"></i>Créer un article
                    </a>
                </div>
                @endif
            </div>
        </main>
    </div>
</div>
@endsection
