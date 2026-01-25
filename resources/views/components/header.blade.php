<header class="sticky top-0 z-50 backdrop-blur-md bg-white/80 dark:bg-slate-950/80 border-b border-gray-200/50 dark:border-white/10 shadow-lg dark:shadow-slate-900/50 transition-all duration-300">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4 md:py-5">
            <!-- Logo -->
            <a href="/" class="flex items-center group">
                <img src="{{ asset('images/logo-myboat.svg') }}" alt="Myboat-oi Logo" class="h-12 md:h-14 w-auto transition-transform group-hover:scale-105 drop-shadow-lg">
            </a>

            <!-- Navigation Desktop (épurée) -->
            <nav class="hidden lg:flex items-center space-x-1">
                <!-- Annonces (mis en avant) -->
                <a href="{{ route('bateaux.index') }}" class="relative px-4 py-2 text-ocean-600 dark:text-ocean-400 hover:text-ocean-700 dark:hover:text-ocean-300 font-semibold transition-all rounded-lg hover:bg-ocean-50 dark:hover:bg-ocean-950/30 {{ request()->routeIs('bateaux.*') || request()->routeIs('categories') ? 'bg-ocean-50 dark:bg-ocean-950/30' : '' }}">
                    <i class="fas fa-ship mr-1.5 text-sm"></i>{{ __('Annonces') }}
                </a>

                <!-- Info (Dropdown) -->
                <div class="relative" id="aboutDropdown">
                    <button class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-ocean-600 dark:hover:text-ocean-400 font-medium transition-all rounded-lg hover:bg-ocean-50 dark:hover:bg-ocean-950/30 {{ request()->routeIs('about') || request()->routeIs('partners') || request()->routeIs('articles.*') ? 'text-ocean-600 dark:text-ocean-400' : '' }}">
                        Info
                        <i class="fas fa-chevron-down ml-1.5 text-xs transition-transform" id="aboutChevron"></i>
                    </button>
                    <div id="aboutMenu" class="hidden absolute left-0 mt-1 w-48 rounded-xl bg-white dark:bg-slate-800 shadow-lg ring-1 ring-black/5 dark:ring-white/10 py-2 z-50">
                        <a href="{{ route('about') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-ocean-50 dark:hover:bg-ocean-950/30 hover:text-ocean-600 dark:hover:text-ocean-400 transition-colors {{ request()->routeIs('about') ? 'text-ocean-600 dark:text-ocean-400 bg-ocean-50 dark:bg-ocean-950/30' : '' }}">
                            <i class="fas fa-info-circle w-5 text-ocean-500"></i>
                            {{ __('À propos') }}
                        </a>
                        <a href="{{ route('partners') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-ocean-50 dark:hover:bg-ocean-950/30 hover:text-ocean-600 dark:hover:text-ocean-400 transition-colors {{ request()->routeIs('partners') ? 'text-ocean-600 dark:text-ocean-400 bg-ocean-50 dark:bg-ocean-950/30' : '' }}">
                            <i class="fas fa-handshake w-5 text-ocean-500"></i>
                            {{ __('Partenaires') }}
                        </a>
                        <a href="{{ route('articles.index') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-ocean-50 dark:hover:bg-ocean-950/30 hover:text-ocean-600 dark:hover:text-ocean-400 transition-colors {{ request()->routeIs('articles.*') ? 'text-ocean-600 dark:text-ocean-400 bg-ocean-50 dark:bg-ocean-950/30' : '' }}">
                            <i class="fas fa-newspaper w-5 text-ocean-500"></i>
                            {{ __('Articles') }}
                        </a>
                    </div>
                </div>

                <!-- Contact -->
                <a href="{{ route('contact') }}" class="relative px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-ocean-600 dark:hover:text-ocean-400 font-medium transition-all rounded-lg hover:bg-ocean-50 dark:hover:bg-ocean-950/30 {{ request()->routeIs('contact') ? 'text-ocean-600 dark:text-ocean-400' : '' }}">
                    {{ __('Contact') }}
                </a>
            </nav>

            <!-- Actions Desktop -->
            <div class="flex items-center space-x-2">
                <!-- Language Selector (discret) -->
                <div class="relative hidden lg:block">
                    <button id="langSelectorBtn" class="flex items-center px-2.5 py-1.5 rounded-lg text-gray-500 dark:text-gray-400 hover:text-ocean-600 dark:hover:text-ocean-400 hover:bg-gray-100 dark:hover:bg-slate-800 transition-all text-sm font-medium uppercase">
                        {{ app()->getLocale() }}
                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div id="langSelectorMenu" class="hidden absolute right-0 mt-1 w-36 rounded-xl bg-white dark:bg-slate-800 shadow-lg ring-1 ring-black/5 dark:ring-white/10 py-1 z-50">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="flex items-center px-3 py-2 text-sm {{ app()->getLocale() == $localeCode ? 'text-ocean-600 dark:text-ocean-400 bg-ocean-50 dark:bg-ocean-950/30 font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700' }} transition-colors">
                                <span class="uppercase font-semibold w-6 text-xs">{{ $localeCode }}</span>
                                <span class="ml-1.5">{{ $properties['native'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- CTA Button Desktop -->
                <a href="{{ route('sell') }}" class="hidden lg:flex items-center bg-gradient-to-r from-ocean-600 to-luxe-cyan hover:from-ocean-700 hover:to-ocean-600 text-white px-5 py-2 rounded-xl font-semibold transition-all shadow-md hover:shadow-lg transform hover:scale-[1.02] text-sm">
                    <i class="fas fa-plus-circle mr-2"></i>
                    {{ __('Vendre mon bateau') }}
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
    // Close about menu if open
    aboutMenu?.classList.add('hidden');
    aboutChevron?.classList.remove('rotate-180');
});

// About dropdown toggle
const aboutDropdown = document.getElementById('aboutDropdown');
const aboutMenu = document.getElementById('aboutMenu');
const aboutChevron = document.getElementById('aboutChevron');

aboutDropdown?.addEventListener('click', function(e) {
    e.stopPropagation();
    aboutMenu.classList.toggle('hidden');
    aboutChevron.classList.toggle('rotate-180');
    // Close language menu if open
    langMenu?.classList.add('hidden');
});

// Close menus when clicking outside
document.addEventListener('click', function(e) {
    if (langMenu && !langMenu.contains(e.target) && e.target !== langBtn) {
        langMenu.classList.add('hidden');
    }
    if (aboutMenu && !aboutDropdown.contains(e.target)) {
        aboutMenu.classList.add('hidden');
        aboutChevron?.classList.remove('rotate-180');
    }
});
</script>
