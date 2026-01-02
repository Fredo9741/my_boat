<footer class="bg-gray-900 dark:bg-slate-950 text-gray-300 dark:text-gray-400 pt-16 pb-6 mt-20 border-t border-gray-800 dark:border-white/10">
    <div class="container mx-auto px-4">
        <!-- Wave Separator -->
        <div class="absolute left-0 right-0 -top-16 h-16 overflow-hidden">
            <svg class="w-full h-full" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 0L60 10C120 20 240 40 360 46.7C480 53 600 47 720 43.3C840 40 960 40 1080 46.7C1200 53 1320 67 1380 73.3L1440 80V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0V0Z" fill="currentColor" class="text-gray-900 dark:text-slate-950"/>
            </svg>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <!-- À propos -->
            <div>
                <div class="mb-4">
                    <img src="{{ asset('images/logo-myboat.svg') }}" alt="Myboat-oi Logo" class="h-10 w-auto">
                </div>
                <p class="text-gray-400 dark:text-gray-500 mb-6">Votre courtier maritime de confiance dans l'océan Indien. Excellence et passion depuis 2024.</p>
                <div class="flex space-x-3">
                    <a href="#" class="group w-11 h-11 bg-gray-800 dark:bg-slate-900 hover:bg-gradient-to-br hover:from-ocean-600 hover:to-luxe-cyan rounded-xl flex items-center justify-center transition-all transform hover:scale-110 shadow-md hover:shadow-lg">
                        <i class="fab fa-facebook-f text-gray-400 group-hover:text-white transition-colors"></i>
                    </a>
                    <a href="#" class="group w-11 h-11 bg-gray-800 dark:bg-slate-900 hover:bg-gradient-to-br hover:from-ocean-600 hover:to-luxe-cyan rounded-xl flex items-center justify-center transition-all transform hover:scale-110 shadow-md hover:shadow-lg">
                        <i class="fab fa-instagram text-gray-400 group-hover:text-white transition-colors"></i>
                    </a>
                    <a href="#" class="group w-11 h-11 bg-gray-800 dark:bg-slate-900 hover:bg-gradient-to-br hover:from-ocean-600 hover:to-luxe-cyan rounded-xl flex items-center justify-center transition-all transform hover:scale-110 shadow-md hover:shadow-lg">
                        <i class="fab fa-youtube text-gray-400 group-hover:text-white transition-colors"></i>
                    </a>
                </div>
            </div>

            <!-- Navigation -->
            <div>
                <h5 class="text-white dark:text-gray-200 font-bold mb-4 text-lg">Navigation</h5>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 dark:text-gray-500 hover:text-ocean-500 dark:hover:text-ocean-400 transition-colors flex items-center group"><i class="fas fa-chevron-right text-xs mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i> Accueil</a></li>
                    <li><a href="{{ route('bateaux.index') }}" class="text-gray-400 dark:text-gray-500 hover:text-ocean-500 dark:hover:text-ocean-400 transition-colors flex items-center group"><i class="fas fa-chevron-right text-xs mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i> Toutes les annonces</a></li>
                    <li><a href="{{ route('sell') }}" class="text-gray-400 dark:text-gray-500 hover:text-ocean-500 dark:hover:text-ocean-400 transition-colors flex items-center group"><i class="fas fa-chevron-right text-xs mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i> Vendre mon bateau</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-400 dark:text-gray-500 hover:text-ocean-500 dark:hover:text-ocean-400 transition-colors flex items-center group"><i class="fas fa-chevron-right text-xs mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i> À propos</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-400 dark:text-gray-500 hover:text-ocean-500 dark:hover:text-ocean-400 transition-colors flex items-center group"><i class="fas fa-chevron-right text-xs mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i> Contact</a></li>
                </ul>
            </div>

            <!-- Catégories -->
            <div>
                <h5 class="text-white dark:text-gray-200 font-bold mb-4 text-lg">Catégories</h5>
                <ul class="space-y-2">
                    <li><a href="/bateaux?type=voilier" class="text-gray-400 dark:text-gray-500 hover:text-ocean-500 dark:hover:text-ocean-400 transition-colors flex items-center group"><i class="fas fa-chevron-right text-xs mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i> Voiliers</a></li>
                    <li><a href="/bateaux?type=catamaran" class="text-gray-400 dark:text-gray-500 hover:text-ocean-500 dark:hover:text-ocean-400 transition-colors flex items-center group"><i class="fas fa-chevron-right text-xs mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i> Catamarans</a></li>
                    <li><a href="/bateaux?type=yacht" class="text-gray-400 dark:text-gray-500 hover:text-ocean-500 dark:hover:text-ocean-400 transition-colors flex items-center group"><i class="fas fa-chevron-right text-xs mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i> Yachts</a></li>
                    <li><a href="/bateaux?type=semi-rigide" class="text-gray-400 dark:text-gray-500 hover:text-ocean-500 dark:hover:text-ocean-400 transition-colors flex items-center group"><i class="fas fa-chevron-right text-xs mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i> Semi-rigides</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h5 class="text-white dark:text-gray-200 font-bold mb-4 text-lg">Contact</h5>
                <ul class="space-y-3">
                    <li class="flex items-start group">
                        <i class="fas fa-map-marker-alt text-ocean-500 dark:text-ocean-400 mt-1 mr-3 group-hover:scale-110 transition-transform"></i>
                        <span class="text-gray-400 dark:text-gray-500">Port de Saint-Gilles<br>97434 La Réunion</span>
                    </li>
                    <li class="flex items-center group">
                        <i class="fas fa-phone text-ocean-500 dark:text-ocean-400 mr-3 group-hover:scale-110 transition-transform"></i>
                        <span class="text-gray-400 dark:text-gray-500">+262 692 XX XX XX</span>
                    </li>
                    <li class="flex items-center group">
                        <i class="fas fa-envelope text-ocean-500 dark:text-ocean-400 mr-3 group-hover:scale-110 transition-transform"></i>
                        <span class="text-gray-400 dark:text-gray-500">contact@oceanboats.re</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-800 dark:border-white/10 pt-8 mt-8">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <p class="text-gray-500 dark:text-gray-600 text-sm">
                    &copy; 2025 <span class="font-semibold text-white dark:text-gray-300">Myboat-oi</span> - Courtage Maritime. Tous droits réservés.
                </p>
                <div class="flex flex-wrap justify-center gap-6">
                    <a href="{{ route('mentions-legales') }}" class="text-gray-500 dark:text-gray-600 hover:text-ocean-500 dark:hover:text-ocean-400 transition-colors text-sm">Mentions légales</a>
                    <a href="{{ route('cgv') }}" class="text-gray-500 dark:text-gray-600 hover:text-ocean-500 dark:hover:text-ocean-400 transition-colors text-sm">CGV</a>
                    <a href="{{ route('confidentialite') }}" class="text-gray-500 dark:text-gray-600 hover:text-ocean-500 dark:hover:text-ocean-400 transition-colors text-sm">Confidentialité</a>
                    <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-700 hover:text-gray-400 dark:hover:text-gray-500 text-xs transition-all opacity-50 hover:opacity-100" title="Administration">•</a>
                </div>
            </div>

            <!-- Powered By -->
            <div class="mt-6 text-center">
                <p class="text-gray-600 dark:text-gray-700 text-xs flex items-center justify-center">
                    Made with <i class="fas fa-heart text-red-500 mx-1 animate-pulse"></i> in Océan Indien
                </p>
            </div>
        </div>
    </div>
</footer>
