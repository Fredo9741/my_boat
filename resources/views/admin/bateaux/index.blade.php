@extends('layouts.admin')

@section('title', 'Gestion des bateaux - Administration')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        @include('components.admin-sidebar')

        <main class="lg:col-span-3">
            {{-- Header --}}
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Gestion des bateaux</h1>
                        <p class="text-gray-600 mt-1">
                            {{ $bateaux->total() }} bateau(x)
                            @if(request()->hasAny(['search','type_id','zone_id','visible','occasion','prix_min','prix_max']))
                                <span class="text-blue-600 font-medium">— filtrés</span>
                            @endif
                        </p>
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

            {{-- Filtres --}}
            <form method="GET" action="{{ route('admin.bateaux.index') }}" class="bg-white rounded-xl shadow-md p-4 mb-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-3">
                    {{-- Recherche --}}
                    <div class="xl:col-span-2">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Rechercher un bateau..."
                                   class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    {{-- Type --}}
                    <div>
                        <select name="type_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Tous les types</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ request('type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->libelle }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Zone --}}
                    <div>
                        <select name="zone_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Toutes les zones</option>
                            @foreach($zones as $zone)
                                <option value="{{ $zone->id }}" {{ request('zone_id') == $zone->id ? 'selected' : '' }}>
                                    {{ $zone->libelle }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Visibilité --}}
                    <div>
                        <select name="visible" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Visibilité : tous</option>
                            <option value="1" {{ request('visible') === '1' ? 'selected' : '' }}>Visible</option>
                            <option value="0" {{ request('visible') === '0' ? 'selected' : '' }}>Masqué</option>
                        </select>
                    </div>

                    {{-- Occasion / Neuf --}}
                    <div>
                        <select name="occasion" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Neuf / Occasion</option>
                            <option value="0" {{ request('occasion') === '0' ? 'selected' : '' }}>Neuf</option>
                            <option value="1" {{ request('occasion') === '1' ? 'selected' : '' }}>Occasion</option>
                        </select>
                    </div>

                    {{-- Prix min --}}
                    <div>
                        <input type="number"
                               name="prix_min"
                               value="{{ request('prix_min') }}"
                               placeholder="Prix min (€)"
                               min="0"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    {{-- Prix max --}}
                    <div>
                        <input type="number"
                               name="prix_max"
                               value="{{ request('prix_max') }}"
                               placeholder="Prix max (€)"
                               min="0"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    {{-- Tri --}}
                    <div>
                        <select name="sort" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="date_desc" {{ request('sort', 'date_desc') === 'date_desc' ? 'selected' : '' }}>Plus récents</option>
                            <option value="prix_asc"  {{ request('sort') === 'prix_asc'  ? 'selected' : '' }}>Prix croissant</option>
                            <option value="prix_desc" {{ request('sort') === 'prix_desc' ? 'selected' : '' }}>Prix décroissant</option>
                            <option value="modele_asc" {{ request('sort') === 'modele_asc' ? 'selected' : '' }}>Modèle A→Z</option>
                        </select>
                    </div>

                    {{-- Boutons --}}
                    <div class="sm:col-span-2 xl:col-span-4 flex items-center gap-3">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition">
                            <i class="fas fa-filter mr-1"></i> Filtrer
                        </button>
                        @if(request()->hasAny(['search','type_id','zone_id','visible','occasion','prix_min','prix_max','sort']))
                            <a href="{{ route('admin.bateaux.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg text-sm font-medium transition">
                                <i class="fas fa-times mr-1"></i> Réinitialiser
                            </a>
                        @endif
                    </div>
                </div>
            </form>

            {{-- Tableau --}}
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                @if($bateaux->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-3 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Photo</th>
                                <th class="px-3 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modèle</th>
                                <th class="px-3 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Type / Zone</th>
                                <th class="px-3 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                                <th class="px-3 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-3 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Publié</th>
                                <th class="px-3 md:px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">⭐</th>
                                <th class="px-3 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($bateaux as $i => $bateau)
                            <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-blue-50 transition cursor-pointer"
                                onclick="window.location='{{ route('admin.bateaux.edit', $bateau) }}'">

                                {{-- Photo --}}
                                <td class="px-3 md:px-6 py-3 whitespace-nowrap hidden md:table-cell">
                                    <div class="h-14 w-20 flex-shrink-0 relative bg-gray-100 rounded-lg overflow-hidden">
                                        @if($bateau->medias->where('type', 'image')->first())
                                            <img class="absolute inset-0 w-full h-full object-cover"
                                                 src="{{ $bateau->medias->where('type', 'image')->first()->url }}"
                                                 alt="{{ $bateau->modele }}"
                                                 loading="lazy">
                                        @else
                                            <div class="absolute inset-0 flex items-center justify-center bg-gray-200">
                                                <i class="fas fa-ship text-gray-400 text-xl"></i>
                                            </div>
                                        @endif
                                        @if($bateau->medias->count() > 1)
                                            <span class="absolute -top-1 -right-1 bg-blue-600 text-white text-xs px-1.5 py-0.5 rounded-full leading-none">
                                                {{ $bateau->medias->count() }}
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                {{-- Modèle --}}
                                <td class="px-3 md:px-6 py-3">
                                    <div class="text-sm font-semibold text-gray-900">{{ $bateau->modele }}</div>
                                    @if($bateau->annee)
                                        <div class="text-xs text-gray-400">{{ $bateau->annee }}</div>
                                    @endif
                                    @if($bateau->slogan)
                                        <span class="inline-block mt-1 px-2 py-0.5 text-xs font-medium rounded-full bg-{{ $bateau->slogan->color ?? 'gray' }}-100 text-{{ $bateau->slogan->color ?? 'gray' }}-700">
                                            {{ $bateau->slogan->libelle }}
                                        </span>
                                    @endif
                                </td>

                                {{-- Type / Zone --}}
                                <td class="px-3 md:px-6 py-3 whitespace-nowrap hidden lg:table-cell">
                                    <div class="text-sm text-gray-700">{{ $bateau->type->libelle ?? '—' }}</div>
                                    <div class="text-xs text-gray-400">{{ $bateau->zone->libelle ?? '—' }}</div>
                                </td>

                                {{-- Prix --}}
                                <td class="px-3 md:px-6 py-3 whitespace-nowrap">
                                    @if($bateau->afficher_prix)
                                        <div class="text-sm font-semibold text-gray-900">{{ number_format($bateau->prix, 0, ',', ' ') }} €</div>
                                    @else
                                        <div class="text-xs italic text-gray-400">Sur demande</div>
                                    @endif
                                </td>

                                {{-- Statut --}}
                                <td class="px-3 md:px-6 py-3 whitespace-nowrap">
                                    <div class="flex flex-col gap-1">
                                        @if($bateau->visible)
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-700">
                                                <i class="fas fa-eye text-xs"></i> Visible
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-red-100 text-red-700">
                                                <i class="fas fa-eye-slash text-xs"></i> Masqué
                                            </span>
                                        @endif
                                        @if($bateau->occasion)
                                            <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-full bg-orange-100 text-orange-700">Occasion</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-full bg-purple-100 text-purple-700">Neuf</span>
                                        @endif
                                    </div>
                                </td>

                                {{-- Date publication --}}
                                <td class="px-3 md:px-6 py-3 whitespace-nowrap hidden lg:table-cell">
                                    @if($bateau->published_at)
                                        <div class="text-sm text-gray-700">{{ $bateau->published_at->format('d/m/Y') }}</div>
                                        <div class="text-xs text-gray-400">{{ $bateau->published_at->format('H:i') }}</div>
                                    @else
                                        <span class="text-xs text-gray-400 italic">Non publiée</span>
                                    @endif
                                </td>

                                {{-- Featured --}}
                                <td class="px-3 md:px-6 py-3 whitespace-nowrap text-center" onclick="event.stopPropagation()">
                                    <button onclick="toggleFeatured({{ $bateau->id }})"
                                            id="featured-btn-{{ $bateau->id }}"
                                            class="text-xl transition hover:scale-110"
                                            title="{{ $bateau->featured ? 'Retirer de la mise en avant' : 'Mettre en avant' }}">
                                        <i class="{{ $bateau->featured ? 'fas' : 'far' }} fa-star text-yellow-500"></i>
                                    </button>
                                </td>

                                {{-- Actions --}}
                                <td class="px-3 md:px-6 py-3 whitespace-nowrap text-sm font-medium" onclick="event.stopPropagation()">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('admin.bateaux.edit', $bateau) }}"
                                           class="text-blue-600 hover:text-blue-800 transition"
                                           title="Modifier">
                                            <i class="fas fa-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('admin.bateaux.destroy', $bateau) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Supprimer ce bateau ? Cette action est irréversible.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-500 hover:text-red-700 transition"
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

                {{-- Pagination --}}
                <div class="px-6 py-4 border-t bg-gray-50">
                    {{ $bateaux->links() }}
                </div>

                @else
                <div class="text-center py-16">
                    <i class="fas fa-ship text-gray-300 text-6xl mb-4"></i>
                    @if(request()->hasAny(['search','type_id','zone_id','visible','occasion','prix_min','prix_max']))
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Aucun résultat</h3>
                        <p class="text-gray-500 mb-6">Aucun bateau ne correspond à vos filtres.</p>
                        <a href="{{ route('admin.bateaux.index') }}" class="inline-block bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold transition">
                            <i class="fas fa-times mr-2"></i>Réinitialiser les filtres
                        </a>
                    @else
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Aucun bateau</h3>
                        <p class="text-gray-500 mb-6">Commencez par ajouter votre premier bateau.</p>
                        <a href="{{ route('admin.bateaux.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                            <i class="fas fa-plus-circle mr-2"></i>Ajouter un bateau
                        </a>
                    @endif
                </div>
                @endif
            </div>
        </main>
    </div>
</div>

@push('scripts')
<script>
function toggleFeatured(bateauId) {
    const btn = document.getElementById(`featured-btn-${bateauId}`);
    const icon = btn.querySelector('i');

    fetch(`/admin/bateaux/${bateauId}/toggle-featured`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.featured) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                btn.title = 'Retirer de la mise en avant';
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                btn.title = 'Mettre en avant';
            }
            if (data.message) {
                alert(data.message);
            }
        }
    })
    .catch(() => alert('Une erreur est survenue'));
}
</script>
@endpush

@endsection
