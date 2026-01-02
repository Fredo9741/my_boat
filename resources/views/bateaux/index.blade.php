@extends('layouts.app')

@section('title', 'Annonces de Bateaux - Myboat-oi')

@section('content')

    <!-- Page Header -->
    <div class="bg-gradient-to-br from-ocean-600 via-ocean-700 to-luxe-navy dark:from-slate-950 dark:via-ocean-950 dark:to-luxe-navy text-white py-16 md:py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-6xl font-black mb-4">Toutes nos annonces</h1>
                <p class="text-xl md:text-2xl text-ocean-100 dark:text-ocean-200 mb-6">
                    {{ number_format($bateaux->count()) }} {{ $bateaux->count() > 1 ? 'bateaux disponibles' : 'bateau disponible' }}
                </p>
                <div class="flex flex-wrap justify-center gap-2 mt-6">
                    @php
                        $activeFilters = collect(request()->except(['page', 'sort_by', 'search']))->filter();
                    @endphp
                    @if($activeFilters->count() > 0)
                        <span class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm border border-white/20">
                            <i class="fas fa-filter mr-2"></i>
                            {{ $activeFilters->count() }} filtre{{ $activeFilters->count() > 1 ? 's' : '' }} actif{{ $activeFilters->count() > 1 ? 's' : '' }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Filter Button -->
    <div class="container mx-auto px-4 py-4 lg:hidden sticky top-20 z-30 bg-gray-50 dark:bg-slate-950">
        <button id="mobileFilterBtn" class="w-full bg-gradient-to-r from-ocean-600 to-luxe-cyan hover:from-ocean-700 hover:to-ocean-600 text-white px-6 py-4 rounded-2xl font-bold flex items-center justify-center shadow-lg transition-all transform hover:scale-105">
            <i class="fas fa-filter mr-2"></i>
            Filtres
            <span class="ml-2 px-2 py-1 bg-white/20 rounded-full text-xs">{{ number_format($bateaux->count()) }}</span>
        </button>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8 lg:py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <!-- Sidebar Filters -->
            <aside class="lg:col-span-1">
                <!-- Mobile Overlay -->
                <div id="mobileFilterOverlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 lg:hidden hidden transition-opacity"></div>

                <!-- Filter Panel -->
                <div id="filterPanel" class="fixed lg:relative inset-x-0 bottom-0 lg:inset-auto bg-white dark:bg-slate-900 rounded-t-3xl lg:rounded-3xl shadow-2xl lg:shadow-xl p-6 lg:sticky lg:top-28 max-h-[85vh] lg:max-h-[calc(100vh-8rem)] overflow-y-auto z-50 transform translate-y-full lg:translate-y-0 transition-all duration-300 border border-gray-100 dark:border-white/10">

                    <!-- Panel Header -->
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200 dark:border-white/10">
                        <h3 class="text-2xl font-black text-gray-900 dark:text-white flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-ocean-600 to-luxe-cyan rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-filter text-white"></i>
                            </div>
                            Filtres
                        </h3>
                        <button id="closeFilterBtn" class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl hover:bg-gray-100 dark:hover:bg-slate-800 transition-colors">
                            <i class="fas fa-times text-2xl text-gray-500 dark:text-gray-400"></i>
                        </button>
                    </div>

                    <form id="filterForm" method="GET" action="{{ route('bateaux.index') }}">
                        @php
                            $selectedTypeIds = is_array(request('type_id')) ? request('type_id') : (request('type_id') ? [request('type_id')] : []);
                            $selectedZoneIds = is_array(request('zone_id')) ? request('zone_id') : (request('zone_id') ? [request('zone_id')] : []);
                        @endphp

                        <!-- Type de bateau -->
                        <div class="mb-6">
                            <label class="block text-sm font-black text-gray-900 dark:text-white mb-4 flex items-center">
                                <i class="fas fa-ship text-ocean-600 dark:text-ocean-400 mr-2"></i>
                                Type de bateau
                            </label>
                            <div class="space-y-2">
                                @foreach($types as $type)
                                    <label class="flex items-center cursor-pointer group p-2 rounded-xl hover:bg-ocean-50 dark:hover:bg-ocean-950/30 transition-colors">
                                        <input type="checkbox" name="type_id[]" value="{{ $type->id }}"
                                               class="w-5 h-5 text-ocean-600 dark:text-ocean-400 rounded focus:ring-2 focus:ring-ocean-500 dark:focus:ring-ocean-400 border-gray-300 dark:border-gray-600 filter-checkbox"
                                               {{ in_array($type->id, $selectedTypeIds) ? 'checked' : '' }}>
                                        <span class="ml-3 text-gray-700 dark:text-gray-300 font-medium flex-1">{{ $type->libelle }}</span>
                                        <span class="ml-auto px-2 py-1 bg-ocean-100 dark:bg-ocean-950/50 text-ocean-600 dark:text-ocean-400 text-xs font-bold rounded-full">{{ $type->bateaux_count }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <hr class="my-6 border-gray-200 dark:border-white/10">

                        <!-- Prix -->
                        <div class="mb-6">
                            <label class="block text-sm font-black text-gray-900 dark:text-white mb-4 flex items-center">
                                <i class="fas fa-euro-sign text-ocean-600 dark:text-ocean-400 mr-2"></i>
                                Budget (€)
                            </label>
                            <div class="grid grid-cols-2 gap-3">
                                <input type="number" name="prix_min" value="{{ request('prix_min') }}"
                                       placeholder="Min"
                                       class="px-4 py-3 rounded-xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 dark:focus:ring-ocean-400 text-gray-700 dark:text-gray-300 font-medium filter-input placeholder-gray-400 dark:placeholder-gray-500">
                                <input type="number" name="prix_max" value="{{ request('prix_max') }}"
                                       placeholder="Max"
                                       class="px-4 py-3 rounded-xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 dark:focus:ring-ocean-400 text-gray-700 dark:text-gray-300 font-medium filter-input placeholder-gray-400 dark:placeholder-gray-500">
                            </div>
                        </div>

                        <hr class="my-6 border-gray-200 dark:border-white/10">

                        <!-- Localisation -->
                        <div class="mb-6">
                            <label class="block text-sm font-black text-gray-900 dark:text-white mb-4 flex items-center">
                                <i class="fas fa-map-marker-alt text-ocean-600 dark:text-ocean-400 mr-2"></i>
                                Localisation
                            </label>
                            <div class="space-y-2">
                                @foreach($zones as $zone)
                                    <label class="flex items-center cursor-pointer group p-2 rounded-xl hover:bg-ocean-50 dark:hover:bg-ocean-950/30 transition-colors">
                                        <input type="checkbox" name="zone_id[]" value="{{ $zone->id }}"
                                               class="w-5 h-5 text-ocean-600 dark:text-ocean-400 rounded focus:ring-2 focus:ring-ocean-500 dark:focus:ring-ocean-400 border-gray-300 dark:border-gray-600 filter-checkbox"
                                               {{ in_array($zone->id, $selectedZoneIds) ? 'checked' : '' }}>
                                        <span class="ml-3 text-gray-700 dark:text-gray-300 font-medium flex-1">{{ $zone->libelle }}</span>
                                        <span class="ml-auto px-2 py-1 bg-ocean-100 dark:bg-ocean-950/50 text-ocean-600 dark:text-ocean-400 text-xs font-bold rounded-full">{{ $zone->bateaux_count }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <hr class="my-6 border-gray-200 dark:border-white/10">

                        <!-- Année -->
                        <div class="mb-6">
                            <label class="block text-sm font-black text-gray-900 dark:text-white mb-4 flex items-center">
                                <i class="fas fa-calendar-alt text-ocean-600 dark:text-ocean-400 mr-2"></i>
                                Année
                            </label>
                            <div class="grid grid-cols-2 gap-3">
                                <input type="number" name="annee_min" value="{{ request('annee_min') }}"
                                       placeholder="De"
                                       class="px-4 py-3 rounded-xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 dark:focus:ring-ocean-400 text-gray-700 dark:text-gray-300 font-medium filter-input placeholder-gray-400 dark:placeholder-gray-500">
                                <input type="number" name="annee_max" value="{{ request('annee_max') }}"
                                       placeholder="À"
                                       class="px-4 py-3 rounded-xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 dark:focus:ring-ocean-400 text-gray-700 dark:text-gray-300 font-medium filter-input placeholder-gray-400 dark:placeholder-gray-500">
                            </div>
                        </div>

                        <hr class="my-6 border-gray-200 dark:border-white/10">

                        <!-- État -->
                        <div class="mb-6">
                            <label class="block text-sm font-black text-gray-900 dark:text-white mb-4 flex items-center">
                                <i class="fas fa-check-circle text-ocean-600 dark:text-ocean-400 mr-2"></i>
                                État
                            </label>
                            <div class="space-y-2">
                                <label class="flex items-center cursor-pointer group p-2 rounded-xl hover:bg-ocean-50 dark:hover:bg-ocean-950/30 transition-colors">
                                    <input type="radio" name="etat" value=""
                                           class="w-5 h-5 text-ocean-600 dark:text-ocean-400 focus:ring-2 focus:ring-ocean-500 dark:focus:ring-ocean-400 border-gray-300 dark:border-gray-600 filter-radio"
                                           {{ request('etat') === null ? 'checked' : '' }}>
                                    <span class="ml-3 text-gray-700 dark:text-gray-300 font-medium">Tous</span>
                                </label>
                                <label class="flex items-center cursor-pointer group p-2 rounded-xl hover:bg-ocean-50 dark:hover:bg-ocean-950/30 transition-colors">
                                    <input type="radio" name="etat" value="neuf"
                                           class="w-5 h-5 text-ocean-600 dark:text-ocean-400 focus:ring-2 focus:ring-ocean-500 dark:focus:ring-ocean-400 border-gray-300 dark:border-gray-600 filter-radio"
                                           {{ request('etat') === 'neuf' ? 'checked' : '' }}>
                                    <span class="ml-3 text-gray-700 dark:text-gray-300 font-medium">Neuf</span>
                                </label>
                                <label class="flex items-center cursor-pointer group p-2 rounded-xl hover:bg-ocean-50 dark:hover:bg-ocean-950/30 transition-colors">
                                    <input type="radio" name="etat" value="occasion"
                                           class="w-5 h-5 text-ocean-600 dark:text-ocean-400 focus:ring-2 focus:ring-ocean-500 dark:focus:ring-ocean-400 border-gray-300 dark:border-gray-600 filter-radio"
                                           {{ request('etat') === 'occasion' ? 'checked' : '' }}>
                                    <span class="ml-3 text-gray-700 dark:text-gray-300 font-medium">Occasion</span>
                                </label>
                            </div>
                        </div>

                        <!-- Hidden fields -->
                        <input type="hidden" name="search" id="hiddenSearch" value="{{ request('search') }}">
                        <input type="hidden" name="sort_by" id="hiddenSort" value="{{ request('sort_by', 'created_at') }}">

                        <!-- Action Buttons -->
                        <div class="flex gap-3 mt-8 pt-6 border-t border-gray-200 dark:border-white/10">
                            <button type="submit" class="flex-1 px-6 py-4 bg-gradient-to-r from-ocean-600 to-luxe-cyan hover:from-ocean-700 hover:to-ocean-600 text-white rounded-2xl font-bold transition-all shadow-lg hover:shadow-2xl transform hover:scale-105">
                                Appliquer
                            </button>
                            <a href="{{ route('bateaux.index') }}" class="px-6 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-2xl hover:bg-gray-100 dark:hover:bg-slate-800 transition-all flex items-center justify-center">
                                <i class="fas fa-redo text-gray-600 dark:text-gray-400"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="lg:col-span-3">

                <!-- Toolbar -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-lg dark:shadow-slate-950/50 p-4 md:p-6 mb-8 border border-gray-100 dark:border-white/10">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <!-- Search -->
                        <div class="flex-1 w-full">
                            <div class="relative group">
                                <input type="text" id="searchInput" value="{{ request('search') }}"
                                       placeholder="Rechercher un bateau..."
                                       class="w-full pl-12 pr-4 py-4 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 dark:focus:ring-ocean-400 text-gray-700 dark:text-gray-300 font-medium placeholder-gray-400 dark:placeholder-gray-500 transition-all">
                                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500 group-focus-within:text-ocean-500 transition-colors"></i>
                            </div>
                        </div>

                        <!-- Sort & View -->
                        <div class="flex gap-3 items-center w-full md:w-auto">
                            <label class="text-sm text-gray-600 dark:text-gray-400 whitespace-nowrap font-medium hidden md:block">Trier :</label>
                            <select id="sortSelect" class="flex-1 md:flex-none px-4 py-4 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 dark:focus:ring-ocean-400 text-gray-700 dark:text-gray-300 font-medium appearance-none cursor-pointer">
                                <option value="created_at" {{ request('sort_by') === 'created_at' ? 'selected' : '' }}>Plus récents</option>
                                <option value="prix_asc" {{ request('sort_by') === 'prix_asc' ? 'selected' : '' }}>Prix ↑</option>
                                <option value="prix_desc" {{ request('sort_by') === 'prix_desc' ? 'selected' : '' }}>Prix ↓</option>
                                <option value="annee_desc" {{ request('sort_by') === 'annee_desc' ? 'selected' : '' }}>Année récente</option>
                                <option value="annee_asc" {{ request('sort_by') === 'annee_asc' ? 'selected' : '' }}>Année ancienne</option>
                            </select>

                            <!-- View Toggle -->
                            <div class="hidden md:flex gap-1 border-2 border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden p-1">
                                <button id="gridView" class="px-4 py-2 bg-gradient-to-r from-ocean-600 to-luxe-cyan text-white rounded-xl transition-all">
                                    <i class="fas fa-th-large"></i>
                                </button>
                                <button id="listView" class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-xl transition-all text-gray-600 dark:text-gray-400">
                                    <i class="fas fa-list"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Boats Grid -->
                <div id="boatsGrid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 md:gap-8">
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
                        <div class="col-span-3 text-center py-20">
                            <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-ocean-100 to-ocean-200 dark:from-ocean-950 dark:to-ocean-900 rounded-full flex items-center justify-center">
                                <i class="fas fa-anchor text-6xl text-ocean-400 dark:text-ocean-600"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Aucun bateau trouvé</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-6">Essayez de modifier vos critères de recherche</p>
                            <a href="{{ route('bateaux.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-ocean-600 to-luxe-cyan text-white rounded-xl font-bold transition-all shadow-lg hover:shadow-2xl transform hover:scale-105">
                                <i class="fas fa-redo mr-2"></i>
                                Réinitialiser les filtres
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination - Removed since we're using get() instead of paginate() -->

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

mobileFilterBtn?.addEventListener('click', openFilters);
closeFilterBtn?.addEventListener('click', closeFilters);
mobileFilterOverlay?.addEventListener('click', closeFilters);

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
                }, 2000);
            }
        });
    });

    // Handle search input
    let searchTimeout;
    searchInput?.addEventListener('keyup', function(e) {
        clearTimeout(searchTimeout);
        hiddenSearch.value = this.value;

        if (e.key === 'Enter') {
            form.submit();
        } else {
            searchTimeout = setTimeout(() => {
                form.submit();
            }, 800);
        }
    });

    // Handle sort select
    sortSelect?.addEventListener('change', function() {
        hiddenSort.value = this.value;
        form.submit();
    });

    // View toggle functionality
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');
    const boatsGrid = document.getElementById('boatsGrid');

    gridView?.addEventListener('click', function() {
        boatsGrid.className = 'grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 md:gap-8';
        gridView.classList.add('bg-gradient-to-r', 'from-ocean-600', 'to-luxe-cyan', 'text-white');
        gridView.classList.remove('hover:bg-gray-100', 'dark:hover:bg-slate-800', 'text-gray-600', 'dark:text-gray-400');
        listView.classList.remove('bg-gradient-to-r', 'from-ocean-600', 'to-luxe-cyan', 'text-white');
        listView.classList.add('hover:bg-gray-100', 'dark:hover:bg-slate-800', 'text-gray-600', 'dark:text-gray-400');
    });

    listView?.addEventListener('click', function() {
        boatsGrid.className = 'grid grid-cols-1 gap-6 md:gap-8';
        listView.classList.add('bg-gradient-to-r', 'from-ocean-600', 'to-luxe-cyan', 'text-white');
        listView.classList.remove('hover:bg-gray-100', 'dark:hover:bg-slate-800', 'text-gray-600', 'dark:text-gray-400');
        gridView.classList.remove('bg-gradient-to-r', 'from-ocean-600', 'to-luxe-cyan', 'text-white');
        gridView.classList.add('hover:bg-gray-100', 'dark:hover:bg-slate-800', 'text-gray-600', 'dark:text-gray-400');
    });
});
</script>
@endpush
