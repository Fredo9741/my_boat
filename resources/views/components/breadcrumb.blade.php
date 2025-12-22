@props(['items' => []])

<div class="bg-gray-100 border-b">
    <div class="container mx-auto px-4 py-3">
        <div class="flex items-center text-sm text-gray-600">
            <a href="/" class="hover:text-blue-600">Accueil</a>

            @foreach($items as $item)
                <i class="fas fa-chevron-right mx-2 text-xs"></i>

                @if(!$loop->last)
                    <a href="{{ $item['url'] }}" class="hover:text-blue-600">{{ $item['label'] }}</a>
                @else
                    <span class="text-gray-800 font-medium">{{ $item['label'] }}</span>
                @endif
            @endforeach
        </div>
    </div>
</div>
