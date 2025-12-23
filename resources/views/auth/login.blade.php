<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - My Boat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased">

    <!-- Header Simple -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/logo-myboat.svg') }}" alt="My Boat Logo" class="h-12 w-auto">
                </a>

                <a href="/" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times text-2xl"></i>
                </a>
            </div>
        </div>
    </header>

    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Colonne gauche - Image et Info -->
            <div class="hidden lg:flex flex-col justify-center bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl p-12 text-white">
                <div class="mb-8">
                    <i class="fas fa-shield-alt text-6xl mb-6"></i>
                    <h2 class="text-4xl font-bold mb-4">Espace Administration</h2>
                    <p class="text-xl text-blue-100 mb-8">Accès réservé au courtier My Boat</p>
                </div>

                <div class="space-y-6">
                    @php
                        $features = [
                            ['icon' => 'ship', 'title' => 'Gestion des annonces', 'description' => 'Créez et gérez toutes les annonces de bateaux en vente'],
                            ['icon' => 'users', 'title' => 'Gestion des clients', 'description' => 'Suivez vos vendeurs et acheteurs potentiels'],
                            ['icon' => 'chart-line', 'title' => 'Statistiques complètes', 'description' => 'Analysez les performances de vos annonces'],
                        ];
                    @endphp

                    @foreach($features as $feature)
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-{{ $feature['icon'] }} text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-1">{{ $feature['title'] }}</h3>
                                <p class="text-blue-100">{{ $feature['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Colonne droite - Formulaire -->
            <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Connexion Administration</h2>
                    <p class="text-gray-600">Accédez à votre espace de gestion</p>
                </div>

                <!-- Formulaire de connexion -->
                <form action="{{ route('admin.login') }}" method="POST" class="space-y-6">
                    @csrf

                    @if($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                            <p class="font-semibold">{{ $errors->first() }}</p>
                        </div>
                    @endif

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Adresse email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email"
                                   name="email"
                                   placeholder="votre@email.com"
                                   class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   required>
                        </div>
                    </div>

                    <!-- Mot de passe -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Mot de passe
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password"
                                   id="passwordInput"
                                   name="password"
                                   placeholder="••••••••"
                                   class="w-full pl-12 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   required
                                   autocomplete="current-password">
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 transition">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Se souvenir / Mot de passe oublié -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 rounded">
                            <span class="ml-2 text-sm text-gray-700">Se souvenir de moi</span>
                        </label>
                    </div>

                    <!-- Bouton connexion -->
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition transform hover:scale-105">
                        <i class="fas fa-shield-alt mr-2"></i> Accéder au tableau de bord
                    </button>

                </form>

                <!-- Info sécurité -->
                <div class="mt-8 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-600 mt-1 mr-3"></i>
                        <div>
                            <p class="text-sm text-blue-900 font-medium">Accès réservé</p>
                            <p class="text-sm text-blue-700 mt-1">Cet espace est exclusivement réservé aux administrateurs My Boat.</p>
                        </div>
                    </div>
                </div>

                <!-- Retour accueil -->
                <div class="mt-6 text-center">
                    <a href="/" class="text-sm text-gray-500 hover:text-gray-700">
                        <i class="fas fa-arrow-left mr-1"></i> Retour à l'accueil
                    </a>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');
        const toggleIcon = document.getElementById('toggleIcon');

        togglePassword.addEventListener('click', function() {
            // Toggle password visibility
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle icon
            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        });

        // Auto-fill email for dev (remove in production)
        @if(config('app.env') === 'local')
            const emailInput = document.querySelector('input[name="email"]');
            if (!emailInput.value) {
                emailInput.value = 'admin@myboat.re';
            }
        @endif
    </script>

</body>
</html>
