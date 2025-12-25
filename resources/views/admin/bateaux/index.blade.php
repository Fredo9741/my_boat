@extends('layouts.admin')

@section('title', 'Gestion des bateaux - Administration')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        @include('components.admin-sidebar')

        <main class="lg:col-span-3">
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Gestion des bateaux</h1>
                        <p class="text-gray-600 mt-2">{{ $bateaux->total() }} bateau(x) au total</p>
                    </div>
                    <a href="{{ route('admin.bateaux.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition shadow-lg">
                        <i class="fas fa-plus-circle mr-2"></i>Nouveau bateau
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
                @if($bateaux->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Photo</th>
                                <th class="px-3 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modèle</th>
                                <th class="px-3 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                <th class="px-3 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Type</th>
                                <th class="px-3 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                                <th class="px-3 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden xl:table-cell">Zone</th>
                                <th class="px-3 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Badge</th>
                                <th class="px-3 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden xl:table-cell">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($bateaux as $bateau)
                            <tr class="hover:bg-gray-50 transition cursor-pointer" onclick="window.location='{{ route('admin.bateaux.edit', $bateau) }}'">
                                <td class="px-3 md:px-6 py-4 whitespace-nowrap hidden md:table-cell">
                                    <div class="flex items-center">
                                        <div class="h-16 w-24 flex-shrink-0 relative">
                                            @if($bateau->medias->where('type', 'image')->first())
                                                <img class="h-16 w-24 object-cover rounded-lg"
                                                     src="{{ $bateau->medias->where('type', 'image')->first()->url }}"
                                                     alt="{{ $bateau->modele }}">
                                            @else
                                                <div class="h-16 w-24 bg-gray-200 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-ship text-gray-400 text-2xl"></i>
                                                </div>
                                            @endif
                                            @if($bateau->medias->count() > 1)
                                                <span class="absolute -top-1 -right-1 bg-blue-600 text-white text-xs px-2 py-0.5 rounded-full">
                                                    {{ $bateau->medias->count() }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 md:px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $bateau->modele }}</div>
                                    @if($bateau->annee)
                                        <div class="text-xs text-gray-500">{{ $bateau->annee }}</div>
                                    @endif
                                    <div class="md:hidden text-xs text-gray-500 mt-1">
                                        {{ $bateau->type->libelle ?? 'N/A' }}
                                    </div>
                                </td>
                                <td class="px-3 md:px-6 py-4 whitespace-nowrap text-sm font-medium" onclick="event.stopPropagation()">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.bateaux.edit', $bateau) }}"
                                           class="text-blue-600 hover:text-blue-900 transition"
                                           title="Modifier">
                                            <i class="fas fa-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('admin.bateaux.destroy', $bateau) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce bateau ? Cette action est irréversible.');">
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
                                <td class="px-3 md:px-6 py-4 whitespace-nowrap hidden lg:table-cell">
                                    <span class="text-sm text-gray-900">{{ $bateau->type->libelle ?? 'N/A' }}</span>
                                </td>
                                <td class="px-3 md:px-6 py-4 whitespace-nowrap">
                                    @if($bateau->afficher_prix)
                                        <div class="text-sm font-semibold text-gray-900">{{ number_format($bateau->prix, 0, ',', ' ') }} €</div>
                                    @else
                                        <div class="text-sm italic text-gray-500">Sur demande</div>
                                    @endif
                                </td>
                                <td class="px-3 md:px-6 py-4 whitespace-nowrap hidden xl:table-cell">
                                    <span class="text-sm text-gray-900">{{ $bateau->zone->libelle ?? 'N/A' }}</span>
                                </td>
                                <td class="px-3 md:px-6 py-4 whitespace-nowrap hidden lg:table-cell">
                                    @if($bateau->slogan)
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-{{ $bateau->slogan->color ?? 'gray' }}-100 text-{{ $bateau->slogan->color ?? 'gray' }}-800">
                                            {{ $bateau->slogan->libelle }}
                                        </span>
                                    @else
                                        <span class="text-xs text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-3 md:px-6 py-4 whitespace-nowrap hidden xl:table-cell">
                                    <div class="flex flex-col gap-1">
                                        @if($bateau->visible)
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                <i class="fas fa-eye text-xs"></i> Visible
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                                <i class="fas fa-eye-slash text-xs"></i> Masqué
                                            </span>
                                        @endif
                                        @if($bateau->occasion)
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">
                                                Occasion
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                                Neuf
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t">
                    {{ $bateaux->links() }}
                </div>
                @else
                <div class="text-center py-12">
                    <i class="fas fa-ship text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Aucun bateau</h3>
                    <p class="text-gray-500 mb-6">Commencez par ajouter votre premier bateau</p>
                    <a href="{{ route('admin.bateaux.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                        <i class="fas fa-plus-circle mr-2"></i>Ajouter un bateau
                    </a>
                </div>
                @endif
            </div>
        </main>
    </div>
</div>
@endsection
