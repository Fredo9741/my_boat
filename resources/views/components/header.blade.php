<header class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4 md:py-5">
            <!-- Logo -->
            <a href="/" class="flex items-center group">
                <img src="{{ asset('images/logo-myboat.svg') }}" alt="Myboat-oi Logo" class="h-12 md:h-14 w-auto transition-transform group-hover:scale-105">
            </a>

            <!-- Navigation Desktop -->
            <nav class="hidden lg:flex items-center space-x-1">
                <a href="/" class="relative px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors rounded-lg hover:bg-blue-50 {{ request()->is('/') ? 'text-blue-600 bg-blue-50' : '' }}">
                    Accueil
                    @if(request()->is('/'))
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-0.5 bg-blue-600 rounded-full"></span>
                    @endif
                </a>
                <a href="/bateaux" class="relative px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors rounded-lg hover:bg-blue-50 {{ request()->is('bateaux*') ? 'text-blue-600 bg-blue-50' : '' }}">
                    Annonces
                    @if(request()->is('bateaux*'))
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-0.5 bg-blue-600 rounded-full"></span>
                    @endif
                </a>
                <a href="/categories" class="relative px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors rounded-lg hover:bg-blue-50 {{ request()->is('categories') ? 'text-blue-600 bg-blue-50' : '' }}">
                    Catégories
                    @if(request()->is('categories'))
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-0.5 bg-blue-600 rounded-full"></span>
                    @endif
                </a>
                <a href="/a-propos" class="relative px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors rounded-lg hover:bg-blue-50 {{ request()->is('a-propos') ? 'text-blue-600 bg-blue-50' : '' }}">
                    À propos
                    @if(request()->is('a-propos'))
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-0.5 bg-blue-600 rounded-full"></span>
                    @endif
                </a>
                <a href="/partenaires" class="relative px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors rounded-lg hover:bg-blue-50 {{ request()->is('partenaires') ? 'text-blue-600 bg-blue-50' : '' }}">
                    Partenaires
                    @if(request()->is('partenaires'))
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-0.5 bg-blue-600 rounded-full"></span>
                    @endif
                </a>
                <a href="/contact" class="relative px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors rounded-lg hover:bg-blue-50 {{ request()->is('contact') ? 'text-blue-600 bg-blue-50' : '' }}">
                    Contact
                    @if(request()->is('contact'))
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-0.5 bg-blue-600 rounded-full"></span>
                    @endif
                </a>
            </nav>

            <!-- Actions Desktop + Hamburger -->
            <div class="flex items-center space-x-3">
                <!-- CTA Button Desktop -->
                <a href="/vendre" class="hidden sm:flex items-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-5 md:px-6 py-2.5 rounded-lg font-semibold transition-all shadow-md hover:shadow-lg transform hover:scale-105 text-sm md:text-base">
                    <i class="fas fa-plus-circle mr-2"></i>
                    <span class="hidden md:inline">Vendre mon bateau</span>
                    <span class="md:hidden">Vendre</span>
                </a>

                <!-- Menu Hamburger Mobile -->
                <button id="mobileMenuBtn" class="lg:hidden text-gray-700 hover:text-blue-600 p-2 transition-colors">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="lg:hidden hidden bg-white border-t shadow-lg">
        <nav class="container mx-auto px-4 py-4 space-y-3">
            <a href="/" class="block py-2 text-gray-700 hover:text-blue-600 font-medium {{ request()->is('/') ? 'text-blue-600' : '' }}">
                <i class="fas fa-home w-6"></i> Accueil
            </a>
            <a href="/bateaux" class="block py-2 text-gray-700 hover:text-blue-600 font-medium {{ request()->is('bateaux*') ? 'text-blue-600' : '' }}">
                <i class="fas fa-ship w-6"></i> Annonces
            </a>
            <a href="/categories" class="block py-2 text-gray-700 hover:text-blue-600 font-medium {{ request()->is('categories') ? 'text-blue-600' : '' }}">
                <i class="fas fa-th-large w-6"></i> Catégories
            </a>
            <a href="/a-propos" class="block py-2 text-gray-700 hover:text-blue-600 font-medium {{ request()->is('a-propos') ? 'text-blue-600' : '' }}">
                <i class="fas fa-info-circle w-6"></i> À propos
            </a>
            <a href="/partenaires" class="block py-2 text-gray-700 hover:text-blue-600 font-medium {{ request()->is('partenaires') ? 'text-blue-600' : '' }}">
                <i class="fas fa-handshake w-6"></i> Partenaires
            </a>
            <a href="/contact" class="block py-2 text-gray-700 hover:text-blue-600 font-medium {{ request()->is('contact') ? 'text-blue-600' : '' }}">
                <i class="fas fa-envelope w-6"></i> Contact
            </a>
            <a href="/vendre" class="block sm:hidden py-2 text-blue-600 hover:text-blue-700 font-semibold border-t pt-3">
                <i class="fas fa-handshake w-6"></i> Vendre mon bateau
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
</script>
