@extends('layouts.admin')

@section('title', 'Zones géographiques - Administration')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        @include('components.admin-sidebar')

        <main class="lg:col-span-3">
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Zones géographiques</h1>
                        <p class="text-gray-600 mt-2">{{ $zones->count() }} zone(s) géographique(s)</p>
                    </div>
                    <a href="{{ route('admin.zones.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition shadow-lg">
                        <i class="fas fa-plus-circle mr-2"></i>Nouvelle zone
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
                @if($zones->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Zone</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre de bateaux</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($zones as $zone)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="fas fa-map-marked-alt text-green-600 mr-3 text-xl"></i>
                                        <span class="text-sm font-medium text-gray-900">{{ $zone->libelle }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-500 font-mono">{{ $zone->slug }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $zone->bateaux_count }} bateau(x)
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('admin.zones.edit', $zone) }}"
                                           class="text-blue-600 hover:text-blue-900 transition"
                                           title="Modifier">
                                            <i class="fas fa-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('admin.zones.destroy', $zone) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette zone ? {{ $zone->bateaux_count > 0 ? 'Attention : ' . $zone->bateaux_count . ' bateau(x) utilisent cette zone.' : '' }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-900 transition {{ $zone->bateaux_count > 0 ? 'opacity-50' : '' }}"
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
                @else
                <div class="text-center py-12">
                    <i class="fas fa-map-marked-alt text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Aucune zone géographique</h3>
                    <p class="text-gray-500 mb-6">Commencez par ajouter une zone géographique</p>
                    <a href="{{ route('admin.zones.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                        <i class="fas fa-plus-circle mr-2"></i>Ajouter une zone
                    </a>
                </div>
                @endif
            </div>
        </main>
    </div>
</div>
@endsection
