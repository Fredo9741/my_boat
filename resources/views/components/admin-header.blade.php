<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center space-x-8">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/logo-myboat.svg') }}" alt="My Boat Logo" class="h-12 w-auto">
                </a>

                <nav class="hidden md:flex items-center space-x-6">
                    <a href="/" class="text-gray-700 hover:text-blue-600 font-medium transition">
                        <i class="fas fa-home mr-1"></i> Accueil
                    </a>
                    <a href="/bateaux" class="text-gray-700 hover:text-blue-600 font-medium transition">
                        <i class="fas fa-search mr-1"></i> Annonces
                    </a>
                </nav>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Profil -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-800 rounded-full flex items-center justify-center text-white">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="hidden md:block">
                        <p class="font-semibold text-gray-800">Admin</p>
                        <p class="text-xs text-gray-500">Courtier maritime</p>
                    </div>
                </div>

                <!-- Déconnexion -->
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-600 hover:text-red-600 transition">
                        <i class="fas fa-sign-out-alt text-xl"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
