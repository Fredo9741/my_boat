@props([
    'slug' => '',
    'title' => 'Bateau',
    'image' => 'https://images.unsplash.com/photo-1504198453319-5ce911bafcde?auto=format&fit=crop&w=800&q=80',
    'price' => 0,
    'location' => 'La Réunion',
    'length' => '0m',
    'year' => 2024,
    'badge' => null,
    'badgeColor' => 'green'
])

<div class="group bg-white dark:bg-slate-900 rounded-2xl shadow-lg hover:shadow-2xl dark:shadow-slate-950/50 transition-all duration-300 overflow-hidden transform hover:-translate-y-2 border border-gray-100 dark:border-white/10">
    <a href="{{ route('bateaux.show', $slug) }}" class="relative overflow-hidden block bg-gray-100 dark:bg-slate-800">
        <div class="w-full h-48 md:h-56 relative overflow-hidden">
            <img src="{{ $image }}"
                 class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500"
                 alt="{{ $title }}"
                 loading="lazy"
                 onerror="this.style.objectFit='contain'; this.parentElement.classList.add('bg-gray-200', 'dark:bg-slate-700');">

            <!-- Gradient overlay on hover -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>

        @if($badge)
            @php
                $badgeClasses = [
                    'green' => 'bg-gradient-to-r from-green-500 to-emerald-600',
                    'yellow' => 'bg-gradient-to-r from-yellow-500 to-amber-600',
                    'red' => 'bg-gradient-to-r from-red-500 to-rose-600',
                    'blue' => 'bg-gradient-to-r from-ocean-500 to-ocean-600',
                    'purple' => 'bg-gradient-to-r from-purple-500 to-violet-600',
                    'pink' => 'bg-gradient-to-r from-pink-500 to-rose-600',
                    'orange' => 'bg-gradient-to-r from-orange-500 to-amber-600',
                    'gray' => 'bg-gradient-to-r from-gray-500 to-slate-600',
                ];
                $badgeClass = $badgeClasses[$badgeColor] ?? 'bg-gradient-to-r from-gray-500 to-slate-600';
            @endphp

            <div class="absolute top-4 right-4 {{ $badgeClass }} text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg backdrop-blur-sm">
                {{ $badge }}
            </div>
        @endif
    </a>

    <div class="p-4 md:p-5">
        <div class="flex justify-between items-start mb-2 md:mb-3">
            <h4 class="font-bold text-base md:text-xl text-gray-900 dark:text-white line-clamp-1 group-hover:text-ocean-600 dark:group-hover:text-ocean-400 transition-colors">{{ $title }}</h4>
            <button onclick="toggleCardFavorite(event, '{{ $slug }}')" class="text-gray-400 dark:text-gray-500 hover:text-red-500 dark:hover:text-red-400 transition-all hover:scale-110">
                <i class="favorite-icon-{{ $slug }} far fa-heart text-lg md:text-xl"></i>
            </button>
        </div>

        <p class="text-gray-600 dark:text-gray-400 text-sm mb-3 flex items-center">
            <i class="fas fa-map-marker-alt text-ocean-600 dark:text-ocean-400 mr-1"></i> {{ $location }}
        </p>

        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-4 space-x-4">
            <span class="flex items-center">
                <i class="fas fa-ruler-horizontal mr-1 text-ocean-500 dark:text-ocean-400"></i> {{ $length }}
            </span>
            <span class="flex items-center">
                <i class="fas fa-calendar-alt mr-1 text-ocean-500 dark:text-ocean-400"></i> {{ $year }}
            </span>
        </div>

        <div class="flex justify-between items-center pt-3 md:pt-4 border-t border-gray-200 dark:border-white/10">
            <div class="text-lg md:text-2xl font-black bg-gradient-to-r from-ocean-600 to-luxe-cyan bg-clip-text text-transparent">
                {{ number_format($price, 0, ',', ' ') }} €
            </div>
            <a href="{{ route('bateaux.show', $slug) }}" class="group/btn relative overflow-hidden bg-gradient-to-r from-ocean-600 to-luxe-cyan hover:from-ocean-700 hover:to-ocean-600 text-white px-3 md:px-4 py-2 rounded-xl text-sm font-medium transition-all shadow-md hover:shadow-xl transform hover:scale-105">
                <span class="absolute inset-0 bg-white/20 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-300"></span>
                <span class="relative z-10">Voir <i class="fas fa-arrow-right ml-1"></i></span>
            </a>
        </div>
    </div>
</div>
