<footer class="bg-gray-900 text-gray-300 pt-12 pb-6 mt-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <!-- À propos -->
            <div>
                <div class="mb-4">
                    <img src="{{ asset('images/logo-myboat.svg') }}" alt="My Boat Logo" class="h-10 w-auto">
                </div>
                <p class="text-gray-400 mb-4">Votre courtier maritime de confiance dans l'océan Indien.</p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-blue-600 rounded-full flex items-center justify-center transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-blue-600 rounded-full flex items-center justify-center transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-blue-600 rounded-full flex items-center justify-center transition">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <!-- Navigation -->
            <div>
                <h5 class="text-white font-bold mb-4">Navigation</h5>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-500 transition">Accueil</a></li>
                    <li><a href="{{ route('bateaux.index') }}" class="hover:text-blue-500 transition">Toutes les annonces</a></li>
                    <li><a href="{{ route('sell') }}" class="hover:text-blue-500 transition">Vendre mon bateau</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-blue-500 transition">À propos</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-blue-500 transition">Contact</a></li>
                </ul>
            </div>

            <!-- Catégories -->
            <div>
                <h5 class="text-white font-bold mb-4">Catégories</h5>
                <ul class="space-y-2">
                    <li><a href="/bateaux?type=voilier" class="hover:text-blue-500 transition">Voiliers</a></li>
                    <li><a href="/bateaux?type=catamaran" class="hover:text-blue-500 transition">Catamarans</a></li>
                    <li><a href="/bateaux?type=yacht" class="hover:text-blue-500 transition">Yachts</a></li>
                    <li><a href="/bateaux?type=semi-rigide" class="hover:text-blue-500 transition">Semi-rigides</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h5 class="text-white font-bold mb-4">Contact</h5>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt text-blue-500 mt-1 mr-3"></i>
                        <span>Port de Saint-Gilles<br>97434 La Réunion</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone text-blue-500 mr-3"></i>
                        <span>+262 692 XX XX XX</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope text-blue-500 mr-3"></i>
                        <span>contact@oceanboats.re</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-6 mt-6 text-center text-gray-500">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p>&copy; 2025 My Boat - Courtage Maritime. Tous droits réservés.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="{{ route('mentions-legales') }}" class="hover:text-blue-500 transition">Mentions légales</a>
                    <a href="{{ route('cgv') }}" class="hover:text-blue-500 transition">CGV</a>
                    <a href="{{ route('confidentialite') }}" class="hover:text-blue-500 transition">Confidentialité</a>
                </div>
            </div>
        </div>
    </div>
</footer>
