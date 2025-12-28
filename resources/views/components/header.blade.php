<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-3 md:py-4">
            <!-- Logo -->
            <a href="/" class="flex items-center">
                <img src="{{ asset('images/logo-myboat.svg') }}" alt="Myboat-oi Logo" class="h-10 md:h-12 w-auto">
            </a>

            <!-- Navigation Desktop -->
            <nav class="hidden lg:flex items-center space-x-6">
                <a href="/" class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->is('/') ? 'text-blue-600' : '' }}">
                    Accueil
                </a>
                <a href="/bateaux" class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->is('bateaux*') ? 'text-blue-600' : '' }}">
                    Annonces
                </a>
                <a href="/categories" class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->is('categories') ? 'text-blue-600' : '' }}">
                    Catégories
                </a>
                <a href="/a-propos" class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->is('a-propos') ? 'text-blue-600' : '' }}">
                    À propos
                </a>
                <a href="/partenaires" class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->is('partenaires') ? 'text-blue-600' : '' }}">
                    Partenaires
                </a>
                <a href="/contact" class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->is('contact') ? 'text-blue-600' : '' }}">
                    Contact
                </a>
            </nav>

            <!-- Actions Desktop + Hamburger -->
            <div class="flex items-center space-x-2 md:space-x-4">
                <!-- CTA Button Desktop -->
                <a href="/vendre" class="hidden sm:flex bg-blue-600 hover:bg-blue-700 text-white px-4 md:px-6 py-2 rounded-lg font-medium transition text-sm md:text-base">
                    <i class="fas fa-handshake mr-1"></i> <span class="hidden md:inline">Vendre mon bateau</span><span class="md:hidden">Vendre</span>
                </a>

                <!-- Menu Hamburger Mobile -->
                <button id="mobileMenuBtn" class="lg:hidden text-gray-700 hover:text-blue-600 p-2">
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
