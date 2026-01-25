<header class="sticky top-0 z-50 backdrop-blur-md bg-white/80 dark:bg-slate-950/80 border-b border-gray-200/50 dark:border-white/10 shadow-lg dark:shadow-slate-900/50 transition-all duration-300">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4 md:py-5">
            <!-- Logo -->
            <a href="/" class="flex items-center group">
                <img src="{{ asset('images/logo-myboat.svg') }}" alt="Myboat-oi Logo" class="h-12 md:h-14 w-auto transition-transform group-hover:scale-105 drop-shadow-lg">
            </a>

            <!-- Navigation Desktop -->
            <nav class="hidden lg:flex items-center space-x-1">
                <a href="{{ route('home') }}" class="relative px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-ocean-600 dark:hover:text-ocean-400 font-medium transition-all rounded-lg hover:bg-ocean-50 dark:hover:bg-ocean-950/30 {{ request()->routeIs('home') ? 'text-ocean-600 dark:text-ocean-400 bg-ocean-50 dark:bg-ocean-950/30' : '' }}">
                    {{ __('Accueil') }}
                    @if(request()->routeIs('home'))
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-0.5 bg-gradient-to-r from-ocean-600 to-luxe-cyan rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('bateaux.index') }}" class="relative px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-ocean-600 dark:hover:text-ocean-400 font-medium transition-all rounded-lg hover:bg-ocean-50 dark:hover:bg-ocean-950/30 {{ request()->routeIs('bateaux.*') ? 'text-ocean-600 dark:text-ocean-400 bg-ocean-50 dark:bg-ocean-950/30' : '' }}">
                    {{ __('Annonces') }}
                    @if(request()->routeIs('bateaux.*'))
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-0.5 bg-gradient-to-r from-ocean-600 to-luxe-cyan rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('categories') }}" class="relative px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-ocean-600 dark:hover:text-ocean-400 font-medium transition-all rounded-lg hover:bg-ocean-50 dark:hover:bg-ocean-950/30 {{ request()->routeIs('categories') ? 'text-ocean-600 dark:text-ocean-400 bg-ocean-50 dark:bg-ocean-950/30' : '' }}">
                    {{ __('Catégories') }}
                    @if(request()->routeIs('categories'))
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-0.5 bg-gradient-to-r from-ocean-600 to-luxe-cyan rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('about') }}" class="relative px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-ocean-600 dark:hover:text-ocean-400 font-medium transition-all rounded-lg hover:bg-ocean-50 dark:hover:bg-ocean-950/30 {{ request()->routeIs('about') ? 'text-ocean-600 dark:text-ocean-400 bg-ocean-50 dark:bg-ocean-950/30' : '' }}">
                    {{ __('À propos') }}
                    @if(request()->routeIs('about'))
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-0.5 bg-gradient-to-r from-ocean-600 to-luxe-cyan rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('partners') }}" class="relative px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-ocean-600 dark:hover:text-ocean-400 font-medium transition-all rounded-lg hover:bg-ocean-50 dark:hover:bg-ocean-950/30 {{ request()->routeIs('partners') ? 'text-ocean-600 dark:text-ocean-400 bg-ocean-50 dark:bg-ocean-950/30' : '' }}">
                    {{ __('Partenaires') }}
                    @if(request()->routeIs('partners'))
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-0.5 bg-gradient-to-r from-ocean-600 to-luxe-cyan rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('articles.index') }}" class="relative px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-ocean-600 dark:hover:text-ocean-400 font-medium transition-all rounded-lg hover:bg-ocean-50 dark:hover:bg-ocean-950/30 {{ request()->routeIs('articles.*') ? 'text-ocean-600 dark:text-ocean-400 bg-ocean-50 dark:bg-ocean-950/30' : '' }}">
                    {{ __('Articles') }}
                    @if(request()->routeIs('articles.*'))
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-0.5 bg-gradient-to-r from-ocean-600 to-luxe-cyan rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('contact') }}" class="relative px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-ocean-600 dark:hover:text-ocean-400 font-medium transition-all rounded-lg hover:bg-ocean-50 dark:hover:bg-ocean-950/30 {{ request()->routeIs('contact') ? 'text-ocean-600 dark:text-ocean-400 bg-ocean-50 dark:bg-ocean-950/30' : '' }}">
                    {{ __('Contact') }}
                    @if(request()->routeIs('contact'))
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-0.5 bg-gradient-to-r from-ocean-600 to-luxe-cyan rounded-full"></span>
                    @endif
                </a>
            </nav>

            <!-- Actions Desktop -->
            <div class="flex items-center space-x-3">
                <!-- Language Selector -->
                <div class="relative">
                    <button id="langSelectorBtn" class="hidden sm:flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 dark:bg-slate-800 hover:bg-gray-200 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-300 transition-all hover:scale-110 shadow-md uppercase font-semibold text-sm">
                        {{ app()->getLocale() }}
                    </button>
                    <div id="langSelectorMenu" class="hidden absolute right-0 mt-2 w-40 rounded-xl bg-white dark:bg-slate-800 shadow-lg ring-1 ring-black ring-opacity-5 py-1 z-50">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="flex items-center px-4 py-2 text-sm {{ app()->getLocale() == $localeCode ? 'text-ocean-600 dark:text-ocean-400 bg-ocean-50 dark:bg-ocean-950/30 font-medium' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700' }} transition-colors">
                                <span class="uppercase font-semibold w-6">{{ $localeCode }}</span>
                                <span class="ml-2">{{ $properties['native'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Dark Mode Toggle -->
                <button id="darkModeToggle" class="hidden sm:flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 dark:bg-slate-800 hover:bg-gray-200 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-300 transition-all hover:scale-110 shadow-md">
                    <i class="fas fa-moon dark:hidden text-lg"></i>
                    <i class="fas fa-sun hidden dark:block text-lg"></i>
                </button>

                <!-- CTA Button Desktop -->
                <a href="{{ route('sell') }}" class="hidden sm:flex items-center bg-gradient-to-r from-ocean-600 to-luxe-cyan hover:from-ocean-700 hover:to-ocean-600 text-white px-5 md:px-6 py-2.5 rounded-xl font-semibold transition-all shadow-lg hover:shadow-2xl transform hover:scale-105 text-sm md:text-base relative overflow-hidden group">
                    <span class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></span>
                    <i class="fas fa-plus-circle mr-2 relative z-10"></i>
                    <span class="hidden md:inline relative z-10">{{ __('Vendre mon bateau') }}</span>
                    <span class="md:hidden relative z-10">{{ __('Vendre') }}</span>
                </a>

                <!-- Menu Hamburger Mobile -->
                <button id="mobileMenuBtn" class="lg:hidden text-gray-700 dark:text-gray-300 hover:text-ocean-600 dark:hover:text-ocean-400 p-2 transition-colors">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="lg:hidden hidden bg-white/95 dark:bg-slate-900/95 backdrop-blur-lg border-t border-gray-200/50 dark:border-white/10 shadow-lg">
        <nav class="container mx-auto px-4 py-4 space-y-3">
            <a href="{{ route('home') }}" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-ocean-600 dark:hover:text-ocean-400 font-medium transition-colors {{ request()->routeIs('home') ? 'text-ocean-600 dark:text-ocean-400' : '' }}">
                <i class="fas fa-home w-6"></i> {{ __('Accueil') }}
            </a>
            <a href="{{ route('bateaux.index') }}" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-ocean-600 dark:hover:text-ocean-400 font-medium transition-colors {{ request()->routeIs('bateaux.*') ? 'text-ocean-600 dark:text-ocean-400' : '' }}">
                <i class="fas fa-ship w-6"></i> {{ __('Annonces') }}
            </a>
            <a href="{{ route('categories') }}" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-ocean-600 dark:hover:text-ocean-400 font-medium transition-colors {{ request()->routeIs('categories') ? 'text-ocean-600 dark:text-ocean-400' : '' }}">
                <i class="fas fa-th-large w-6"></i> {{ __('Catégories') }}
            </a>
            <a href="{{ route('about') }}" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-ocean-600 dark:hover:text-ocean-400 font-medium transition-colors {{ request()->routeIs('about') ? 'text-ocean-600 dark:text-ocean-400' : '' }}">
                <i class="fas fa-info-circle w-6"></i> {{ __('À propos') }}
            </a>
            <a href="{{ route('partners') }}" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-ocean-600 dark:hover:text-ocean-400 font-medium transition-colors {{ request()->routeIs('partners') ? 'text-ocean-600 dark:text-ocean-400' : '' }}">
                <i class="fas fa-handshake w-6"></i> {{ __('Partenaires') }}
            </a>
            <a href="{{ route('articles.index') }}" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-ocean-600 dark:hover:text-ocean-400 font-medium transition-colors {{ request()->routeIs('articles.*') ? 'text-ocean-600 dark:text-ocean-400' : '' }}">
                <i class="fas fa-newspaper w-6"></i> {{ __('Articles') }}
            </a>
            <a href="{{ route('contact') }}" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-ocean-600 dark:hover:text-ocean-400 font-medium transition-colors {{ request()->routeIs('contact') ? 'text-ocean-600 dark:text-ocean-400' : '' }}">
                <i class="fas fa-envelope w-6"></i> {{ __('Contact') }}
            </a>

            <!-- Language Selector Mobile -->
            <div class="border-t pt-3">
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-2"><i class="fas fa-globe w-6"></i> {{ __('Langue') }}</p>
                <div class="flex flex-wrap gap-2">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="px-3 py-1.5 rounded-lg text-sm font-medium {{ app()->getLocale() == $localeCode ? 'bg-ocean-600 text-white' : 'bg-gray-200 dark:bg-slate-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-slate-600' }} transition-colors">
                            {{ $properties['native'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Dark Mode Toggle Mobile -->
            <button id="darkModeToggleMobile" class="flex items-center justify-between w-full py-2 text-gray-700 dark:text-gray-300 hover:text-ocean-600 dark:hover:text-ocean-400 font-medium transition-colors border-t pt-3 mt-3">
                <span><i class="fas fa-moon w-6"></i> {{ __('Mode sombre') }}</span>
                <div class="relative inline-flex items-center cursor-pointer">
                    <div class="w-11 h-6 bg-gray-300 dark:bg-ocean-600 rounded-full peer transition-colors"></div>
                    <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform dark:translate-x-5"></div>
                </div>
            </button>

            <a href="{{ LaravelLocalization::localizeUrl('/vendre') }}" class="block sm:hidden py-2 text-ocean-600 dark:text-ocean-400 hover:text-ocean-700 dark:hover:text-ocean-300 font-semibold border-t pt-3 transition-colors">
                <i class="fas fa-plus-circle w-6"></i> {{ __('Vendre mon bateau') }}
            </a>
        </nav>
    </div>
</header>

<script>
// Mobile menu toggle
document.getElementById('mobileMenuBtn').addEventListener('click', function() {
    const menu = document.getElementById('mobileMenu');
    const icon = this.querySelector('i');

    menu.classList.toggle('hidden');
    icon.classList.toggle('fa-bars');
    icon.classList.toggle('fa-times');
});

// Dark mode toggle functionality
function toggleDarkMode() {
    if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        localStorage.theme = 'light';
    } else {
        document.documentElement.classList.add('dark');
        localStorage.theme = 'dark';
    }
}

// Desktop dark mode toggle
document.getElementById('darkModeToggle')?.addEventListener('click', toggleDarkMode);

// Mobile dark mode toggle
document.getElementById('darkModeToggleMobile')?.addEventListener('click', toggleDarkMode);

// Language selector toggle
const langBtn = document.getElementById('langSelectorBtn');
const langMenu = document.getElementById('langSelectorMenu');

langBtn?.addEventListener('click', function(e) {
    e.stopPropagation();
    langMenu.classList.toggle('hidden');
});

// Close language menu when clicking outside
document.addEventListener('click', function(e) {
    if (langMenu && !langMenu.contains(e.target) && e.target !== langBtn) {
        langMenu.classList.add('hidden');
    }
});
</script>
