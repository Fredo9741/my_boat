@extends('layouts.app')

@section('title', 'Annonces de Bateaux - My Boat')

@section('content')

    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['label' => __('Annonces de bateaux'), 'url' => '#']
    ]" />

    <!-- Page Title & Stats -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl md:text-4xl font-bold text-gray-800 mb-2">{{ __('Toutes les annonces') }}</h1>
            <p class="text-gray-600 text-sm md:text-lg">{{ number_format($bateaux->total()) }} {{ $bateaux->total() > 1 ? __('bateaux') : __('bateau') }} {{ $bateaux->total() > 1 ? __('trouvés') : __('trouvé') }}</p>
        </div>
    </div>

    <!-- Mobile Filter Button -->
    <div class="container mx-auto px-4 py-4 lg:hidden">
        <button id="mobileFilterBtn" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg font-medium flex items-center justify-center">
            <i class="fas fa-filter mr-2"></i> Afficher les filtres <span class="ml-2 text-xs">({{ number_format($bateaux->total()) }} bateaux)</span>
        </button>
    </div>

    <!-- Filters & Listings -->
    <div class="container mx-auto px-4 pb-8 lg:py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <!-- Sidebar Filters -->
            <aside class="lg:col-span-1">
                <!-- Mobile Filter Overlay -->
                <div id="mobileFilterOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>

                <!-- Filter Panel -->
                <div id="filterPanel" class="fixed lg:relative inset-x-0 bottom-0 lg:inset-auto bg-white rounded-t-2xl lg:rounded-xl shadow-lg lg:shadow-md p-6 lg:sticky lg:top-24 max-h-[85vh] lg:max-h-none overflow-y-auto z-50 transform translate-y-full lg:translate-y-0 transition-transform duration-300">
                    <!-- Mobile Header -->
                    <div class="flex items-center justify-between mb-4 lg:mb-6 lg:block">
                        <h3 class="text-xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-filter text-blue-600 mr-2"></i> Filtres
                        </h3>
                        <button id="closeFilterBtn" class="lg:hidden text-gray-500 hover:text-gray-700 p-2">
                            <i class="fas fa-times text-2xl"></i>
                        </button>
                    </div>

                    <form id="filterForm" method="GET" action="{{ route('bateaux.index') }}">
                        @php
                            // Ensure request parameters are arrays
                            $selectedTypeIds = is_array(request('type_id')) ? request('type_id') : (request('type_id') ? [request('type_id')] : []);
                            $selectedZoneIds = is_array(request('zone_id')) ? request('zone_id') : (request('zone_id') ? [request('zone_id')] : []);
                        @endphp

                        <!-- Type de bateau -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">{{ __('Type de bateau') }}</label>
                            <div class="space-y-2">
                                @foreach($types as $type)
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" name="type_id[]" value="{{ $type->id }}"
                                               class="w-4 h-4 text-blue-600 rounded filter-checkbox"
                                               {{ in_array($type->id, $selectedTypeIds) ? 'checked' : '' }}>
                                        <span class="ml-2 text-gray-700">{{ $type->libelle }}</span>
                                        <span class="ml-auto text-gray-500 text-sm">({{ $type->bateaux_count }})</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <hr class="my-6">

                        <!-- Prix -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Prix (€)</label>
                            <div class="grid grid-cols-2 gap-2">
                                <input type="number" name="prix_min" value="{{ request('prix_min') }}"
                                       placeholder="Min" class="px-3 py-2 border rounded-lg text-sm filter-input">
                                <input type="number" name="prix_max" value="{{ request('prix_max') }}"
                                       placeholder="Max" class="px-3 py-2 border rounded-lg text-sm filter-input">
                            </div>
                        </div>

                        <hr class="my-6">

                        <!-- Localisation -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Localisation</label>
                            <div class="space-y-2">
                                @foreach($zones as $zone)
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" name="zone_id[]" value="{{ $zone->id }}"
                                               class="w-4 h-4 text-blue-600 rounded filter-checkbox"
                                               {{ in_array($zone->id, $selectedZoneIds) ? 'checked' : '' }}>
                                        <span class="ml-2 text-gray-700">{{ $zone->libelle }}</span>
                                        <span class="ml-auto text-gray-500 text-sm">({{ $zone->bateaux_count }})</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <hr class="my-6">

                        <!-- Année -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Année</label>
                            <div class="grid grid-cols-2 gap-2">
                                <input type="number" name="annee_min" value="{{ request('annee_min') }}"
                                       placeholder="De" class="px-3 py-2 border rounded-lg text-sm filter-input">
                                <input type="number" name="annee_max" value="{{ request('annee_max') }}"
                                       placeholder="À" class="px-3 py-2 border rounded-lg text-sm filter-input">
                            </div>
                        </div>

                        <hr class="my-6">

                        <!-- État -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">État</label>
                            <div class="space-y-2">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="etat" value=""
                                           class="w-4 h-4 text-blue-600 filter-radio"
                                           {{ request('etat') === null ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">Tous</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="etat" value="neuf"
                                           class="w-4 h-4 text-blue-600 filter-radio"
                                           {{ request('etat') === 'neuf' ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">Neuf</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="etat" value="occasion"
                                           class="w-4 h-4 text-blue-600 filter-radio"
                                           {{ request('etat') === 'occasion' ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">Occasion</span>
                                </label>
                            </div>
                        </div>

                        <!-- Hidden field for search -->
                        <input type="hidden" name="search" id="hiddenSearch" value="{{ request('search') }}">

                        <!-- Hidden field for sort -->
                        <input type="hidden" name="sort_by" id="hiddenSort" value="{{ request('sort_by', 'created_at') }}">

                        <!-- Boutons -->
                        <div class="flex gap-2 mt-6">
                            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition">
                                Appliquer
                            </button>
                            <a href="{{ route('bateaux.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition flex items-center justify-center">
                                <i class="fas fa-redo text-gray-600"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </aside>

            <!-- Listings -->
            <main class="lg:col-span-3">

                <!-- Toolbar -->
                <div class="bg-white rounded-xl shadow-md p-4 mb-6">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <!-- Search -->
                        <div class="flex-1 w-full">
                            <div class="relative">
                                <input type="text" id="searchInput" value="{{ request('search') }}"
                                       placeholder="Rechercher un bateau..."
                                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Sort -->
                        <div class="flex gap-2 items-center">
                            <label class="text-sm text-gray-600 whitespace-nowrap">Trier par:</label>
                            <select id="sortSelect" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="created_at" {{ request('sort_by') === 'created_at' ? 'selected' : '' }}>Plus récents</option>
                                <option value="prix_asc" {{ request('sort_by') === 'prix_asc' ? 'selected' : '' }}>Prix croissant</option>
                                <option value="prix_desc" {{ request('sort_by') === 'prix_desc' ? 'selected' : '' }}>Prix décroissant</option>
                                <option value="annee_desc" {{ request('sort_by') === 'annee_desc' ? 'selected' : '' }}>Année récente</option>
                                <option value="annee_asc" {{ request('sort_by') === 'annee_asc' ? 'selected' : '' }}>Année ancienne</option>
                            </select>
                        </div>

                        <!-- View Toggle -->
                        <div class="flex gap-1 border border-gray-300 rounded-lg overflow-hidden">
                            <button id="gridView" class="px-3 py-2 bg-blue-600 text-white">
                                <i class="fas fa-th-large"></i>
                            </button>
                            <button id="listView" class="px-3 py-2 hover:bg-gray-100">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Grid de bateaux -->
                <div id="boatsGrid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @forelse($bateaux as $bateau)
                        <x-boat-card
                            :slug="$bateau->slug"
                            :title="$bateau->modele"
                            :image="$bateau->main_image"
                            :price="$bateau->prix"
                            :location="$bateau->location"
                            :length="$bateau->length"
                            :year="$bateau->annee"
                            :published-at="$bateau->published_at ? $bateau->published_at->format('d/m/Y') : null"
                            :badge="$bateau->badge['label'] ?? null"
                            :badge-color="$bateau->badge['color'] ?? 'green'"
                        />
                    @empty
                        <div class="col-span-3 text-center py-12 text-gray-500">
                            <i class="fas fa-anchor text-6xl mb-4 opacity-30"></i>
                            <p class="text-xl mb-2">Aucun bateau trouvé</p>
                            <p>Essayez de modifier vos critères de recherche</p>
                        </div>
                    @endforelse
                </div>

            </main>

        </div>
    </div>

@endsection

@push('scripts')
<script>
// Mobile Filter Toggle
const mobileFilterBtn = document.getElementById('mobileFilterBtn');
const closeFilterBtn = document.getElementById('closeFilterBtn');
const filterPanel = document.getElementById('filterPanel');
const mobileFilterOverlay = document.getElementById('mobileFilterOverlay');

function openFilters() {
    filterPanel.classList.remove('translate-y-full');
    filterPanel.classList.add('translate-y-0');
    mobileFilterOverlay.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeFilters() {
    filterPanel.classList.add('translate-y-full');
    filterPanel.classList.remove('translate-y-0');
    mobileFilterOverlay.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

mobileFilterBtn.addEventListener('click', openFilters);
closeFilterBtn.addEventListener('click', closeFilters);
mobileFilterOverlay.addEventListener('click', closeFilters);
</script>
@endpush

@push('scripts')
<script>
    // Auto-submit form when filters change
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('filterForm');
        const checkboxes = document.querySelectorAll('.filter-checkbox');
        const radios = document.querySelectorAll('.filter-radio');
        const inputs = document.querySelectorAll('.filter-input');
        const searchInput = document.getElementById('searchInput');
        const hiddenSearch = document.getElementById('hiddenSearch');
        const sortSelect = document.getElementById('sortSelect');
        const hiddenSort = document.getElementById('hiddenSort');

        // Submit form when checkbox changes
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                form.submit();
            });
        });

        // Submit form when radio changes
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                form.submit();
            });
        });

        // Submit form when input loses focus or Enter is pressed
        let inputTimeout;
        inputs.forEach(input => {
            input.addEventListener('keyup', function(e) {
                clearTimeout(inputTimeout);
                if (e.key === 'Enter') {
                    form.submit();
                } else {
                    inputTimeout = setTimeout(() => {
                        form.submit();
                    }, 2000); // Wait 2 seconds after last keystroke
                }
            });
        });

        // Handle search input
        let searchTimeout;
        searchInput.addEventListener('keyup', function(e) {
            clearTimeout(searchTimeout);
            hiddenSearch.value = this.value;

            if (e.key === 'Enter') {
                form.submit();
            } else {
                searchTimeout = setTimeout(() => {
                    form.submit();
                }, 800); // Wait 800ms after last keystroke
            }
        });

        // Handle sort select
        sortSelect.addEventListener('change', function() {
            hiddenSort.value = this.value;
            form.submit();
        });

        // View toggle functionality
        const gridView = document.getElementById('gridView');
        const listView = document.getElementById('listView');
        const boatsGrid = document.getElementById('boatsGrid');

        gridView.addEventListener('click', function() {
            boatsGrid.className = 'grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6';
            gridView.classList.add('bg-blue-600', 'text-white');
            gridView.classList.remove('hover:bg-gray-100');
            listView.classList.remove('bg-blue-600', 'text-white');
            listView.classList.add('hover:bg-gray-100');
        });

        listView.addEventListener('click', function() {
            boatsGrid.className = 'grid grid-cols-1 gap-6';
            listView.classList.add('bg-blue-600', 'text-white');
            listView.classList.remove('hover:bg-gray-100');
            gridView.classList.remove('bg-blue-600', 'text-white');
            gridView.classList.add('hover:bg-gray-100');
        });
    });
</script>
@endpush
