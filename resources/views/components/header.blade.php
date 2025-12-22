<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <a href="/" class="flex items-center">
                <img src="{{ asset('images/logo-myboat.svg') }}" alt="My Boat Logo" class="h-12 w-auto">
            </a>

            <!-- Navigation Desktop -->
            <nav class="hidden md:flex items-center space-x-6">
                <a href="{{ LaravelLocalization::localizeURL('/') }}" class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->is('/') ? 'text-blue-600' : '' }}">
                    {{ __('Accueil') }}
                </a>
                <a href="{{ LaravelLocalization::localizeURL('/bateaux') }}" class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->is('bateaux*') ? 'text-blue-600' : '' }}">
                    {{ __('Annonces') }}
                </a>
                <a href="{{ LaravelLocalization::localizeURL('/categories') }}" class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->is('categories') ? 'text-blue-600' : '' }}">
                    {{ __('Catégories') }}
                </a>
                <a href="{{ LaravelLocalization::localizeURL('/a-propos') }}" class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->is('a-propos') ? 'text-blue-600' : '' }}">
                    {{ __('À propos') }}
                </a>
                <a href="{{ LaravelLocalization::localizeURL('/contact') }}" class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->is('contact') ? 'text-blue-600' : '' }}">
                    {{ __('Contact') }}
                </a>
            </nav>

            <!-- Actions -->
            <div class="flex items-center space-x-4">
                <!-- Language Selector -->
                <div class="relative group">
                    <button class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 font-medium transition">
                        <i class="fas fa-globe"></i>
                        <span class="uppercase">{{ LaravelLocalization::getCurrentLocale() }}</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                               class="block px-4 py-2 text-gray-700 hover:bg-blue-50 first:rounded-t-lg last:rounded-b-lg {{ $localeCode === LaravelLocalization::getCurrentLocale() ? 'bg-blue-50 font-semibold' : '' }}">
                                <span class="uppercase">{{ $localeCode }}</span> - {{ $properties['native'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <a href="{{ LaravelLocalization::localizeURL('/vendre') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
                    <i class="fas fa-handshake mr-1"></i> {{ __('Vendre mon bateau') }}
                </a>
            </div>
        </div>
    </div>
</header>
