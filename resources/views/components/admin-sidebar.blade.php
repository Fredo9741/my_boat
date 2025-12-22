<aside class="lg:col-span-1">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <nav class="p-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg font-medium mb-1 transition">
                <i class="fas fa-chart-line mr-3 w-5"></i>
                Tableau de bord
            </a>

            <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider mt-3">Gestion</div>

            <a href="{{ route('admin.bateaux.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.bateaux.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg font-medium mb-1 transition">
                <i class="fas fa-ship mr-3 w-5"></i>
                Bateaux
            </a>
            <a href="{{ route('admin.types.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.types.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg font-medium mb-1 transition">
                <i class="fas fa-tags mr-3 w-5"></i>
                Types de bateaux
            </a>
            <a href="{{ route('admin.zones.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.zones.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg font-medium mb-1 transition">
                <i class="fas fa-map-marked-alt mr-3 w-5"></i>
                Zones géographiques
            </a>
            <a href="{{ route('admin.actions.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.actions.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg font-medium mb-1 transition">
                <i class="fas fa-bullhorn mr-3 w-5"></i>
                Slogans
            </a>

            <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider mt-3">Configuration</div>

            <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.settings.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg font-medium mb-1 transition">
                <i class="fas fa-share-alt mr-3 w-5"></i>
                Réseaux sociaux
            </a>

            <hr class="my-2">

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg font-medium mb-1 transition">
                    <i class="fas fa-sign-out-alt mr-3 w-5"></i>
                    Déconnexion
                </button>
            </form>
        </nav>
    </div>

    <!-- Bouton nouvelle annonce -->
    <div class="mt-6">
        <a href="{{ route('admin.bateaux.create') }}" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-4 rounded-xl font-bold text-center transition transform hover:scale-105 flex items-center justify-center shadow-lg">
            <i class="fas fa-plus-circle mr-2 text-xl"></i>
            Nouveau bateau
        </a>
    </div>
</aside>
