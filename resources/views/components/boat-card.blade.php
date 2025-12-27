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

<div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition overflow-hidden group">
    <a href="{{ route('bateaux.show', $slug) }}" class="relative overflow-hidden block">
        <img src="{{ $image }}" class="w-full h-48 md:h-56 object-cover object-center group-hover:scale-110 transition duration-500" alt="{{ $title }}" loading="lazy">

        @if($badge)
            @php
                $badgeClasses = [
                    'green' => 'bg-green-500',
                    'yellow' => 'bg-yellow-500',
                    'red' => 'bg-red-500',
                    'blue' => 'bg-blue-500',
                    'purple' => 'bg-purple-500',
                    'pink' => 'bg-pink-500',
                    'orange' => 'bg-orange-500',
                    'gray' => 'bg-gray-500',
                ];
                $badgeClass = $badgeClasses[$badgeColor] ?? 'bg-gray-500';
            @endphp

            <div class="absolute top-4 right-4 {{ $badgeClass }} text-white px-3 py-1 rounded-full text-sm font-semibold">
                {{ $badge }}
            </div>
        @endif
    </a>

    <div class="p-4 md:p-5">
        <div class="flex justify-between items-start mb-2 md:mb-3">
            <h4 class="font-bold text-base md:text-xl text-gray-800 line-clamp-1">{{ $title }}</h4>
            <button onclick="toggleCardFavorite(event, '{{ $slug }}')" class="text-gray-400 hover:text-red-500 transition">
                <i class="favorite-icon-{{ $slug }} far fa-heart text-lg md:text-xl"></i>
            </button>
        </div>

        <p class="text-gray-600 text-sm mb-3">
            <i class="fas fa-map-marker-alt text-blue-600 mr-1"></i> {{ $location }}
        </p>

        <div class="flex items-center text-sm text-gray-500 mb-4 space-x-4">
            <span><i class="fas fa-ruler-horizontal mr-1"></i> {{ $length }}</span>
            <span><i class="fas fa-calendar-alt mr-1"></i> {{ $year }}</span>
        </div>

        <div class="flex justify-between items-center pt-3 md:pt-4 border-t">
            <div class="text-lg md:text-2xl font-bold text-blue-600">{{ number_format($price, 0, ',', ' ') }} €</div>
            <a href="{{ route('bateaux.show', $slug) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 md:px-4 py-2 rounded-lg text-sm font-medium transition">
                Voir <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
</div>
