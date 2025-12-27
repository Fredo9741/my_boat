@extends('layouts.app')

@section('title', 'Devenir Partenaire - My Boat')

@section('content')

    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-900 text-white py-20 md:py-32 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute transform rotate-45 -top-20 -right-20 w-96 h-96 bg-white rounded-full"></div>
            <div class="absolute transform -rotate-12 -bottom-32 -left-20 w-80 h-80 bg-white rounded-full"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    Rejoignez le N°1 de la vente de bateaux dans l'océan Indien
                </h1>
                <p class="text-lg md:text-2xl text-blue-100 mb-8 md:mb-12">
                    Développez votre activité avec My Boat, la plateforme de référence pour les professionnels nautiques
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#contact" class="bg-white text-blue-600 hover:bg-blue-50 px-8 md:px-12 py-4 md:py-5 rounded-lg font-bold text-base md:text-xl transition transform hover:scale-105 shadow-2xl inline-flex items-center justify-center">
                        <i class="fas fa-handshake mr-3"></i> Devenir partenaire
                    </a>
                    <a href="#avantages" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 md:px-12 py-4 md:py-5 rounded-lg font-bold text-base md:text-xl transition transform hover:scale-105 inline-flex items-center justify-center">
                        <i class="fas fa-info-circle mr-3"></i> En savoir plus
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques Clés -->
    <div class="bg-white py-12 md:py-16 border-b">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
                <div class="text-center">
                    <div class="text-3xl md:text-5xl font-bold text-blue-600 mb-2">5000+</div>
                    <div class="text-sm md:text-base text-gray-600">Visiteurs/mois</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-5xl font-bold text-blue-600 mb-2">98%</div>
                    <div class="text-sm md:text-base text-gray-600">Satisfaction client</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-5xl font-bold text-blue-600 mb-2">24h</div>
                    <div class="text-sm md:text-base text-gray-600">Temps de réponse moyen</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-5xl font-bold text-blue-600 mb-2">100%</div>
                    <div class="text-sm md:text-base text-gray-600">Océan Indien</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Avantages Partenaires -->
    <section id="avantages" class="py-16 md:py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Pourquoi devenir partenaire ?</h2>
                <p class="text-base md:text-xl text-gray-600 max-w-3xl mx-auto">
                    Profitez d'une visibilité maximale et d'outils professionnels pour booster vos ventes
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Avantage 1 -->
                <div class="bg-white rounded-xl p-6 md:p-8 shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-chart-line text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-4">Visibilité Maximale</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                        Votre catalogue accessible à des milliers d'acheteurs potentiels dans toute la zone océan Indien.
                        Référencement premium et mise en avant de vos annonces.
                    </p>
                </div>

                <!-- Avantage 2 -->
                <div class="bg-white rounded-xl p-6 md:p-8 shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-tools text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-4">Outils Professionnels</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                        Interface d'administration intuitive, gestion simplifiée de vos annonces,
                        statistiques détaillées et outils marketing performants.
                    </p>
                </div>

                <!-- Avantage 3 -->
                <div class="bg-white rounded-xl p-6 md:p-8 shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-headset text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-4">Support Dédié</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                        Accompagnement personnalisé par notre équipe d'experts.
                        Formation, conseils et assistance technique disponibles 7j/7.
                    </p>
                </div>

                <!-- Avantage 4 -->
                <div class="bg-white rounded-xl p-6 md:p-8 shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-bolt text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-4">Mise en Ligne Rapide</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                        Publiez vos annonces en quelques clics.
                        Modification instantanée, upload massif de photos et vidéos YouTube intégrées.
                    </p>
                </div>

                <!-- Avantage 5 -->
                <div class="bg-white rounded-xl p-6 md:p-8 shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-shield-alt text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-4">Sécurité & Confiance</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                        Badge "Professionnel vérifié", système de notation clients,
                        et modération active pour garantir des transactions sécurisées.
                    </p>
                </div>

                <!-- Avantage 6 -->
                <div class="bg-white rounded-xl p-6 md:p-8 shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-euro-sign text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-4">Tarifs Compétitifs</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                        Formules adaptées à tous les budgets.
                        Sans engagement, sans frais cachés. Payez uniquement pour vos annonces actives.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Formules & Tarifs -->
    <section class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Nos Formules Partenaires</h2>
                <p class="text-base md:text-xl text-gray-600 max-w-3xl mx-auto">
                    Des solutions flexibles adaptées à votre activité
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Formule Essentielle -->
                <div class="bg-white rounded-xl border-2 border-gray-200 p-8 hover:border-blue-500 transition">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Essentielle</h3>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-blue-600">29€</span>
                        <span class="text-gray-600">/annonce/mois</span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">Jusqu'à 10 photos par annonce</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">Fiche détaillée avec équipements</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">Badge "Professionnel"</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">Statistiques de base</span>
                        </li>
                    </ul>
                    <a href="#contact" class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-800 text-center px-6 py-3 rounded-lg font-semibold transition">
                        Commencer
                    </a>
                </div>

                <!-- Formule Premium -->
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl p-8 text-white relative transform md:scale-105 shadow-2xl">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-orange-500 text-white px-4 py-1 rounded-full text-sm font-bold">
                        POPULAIRE
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Premium</h3>
                    <div class="mb-6">
                        <span class="text-4xl font-bold">49€</span>
                        <span class="text-blue-100">/annonce/mois</span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-300 mt-1 mr-3"></i>
                            <span>Photos illimitées + Vidéos YouTube</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-300 mt-1 mr-3"></i>
                            <span>Mise en avant en page d'accueil</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-300 mt-1 mr-3"></i>
                            <span>Badge personnalisé (Exclusivité, etc.)</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-300 mt-1 mr-3"></i>
                            <span>Statistiques avancées + Analytics</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-300 mt-1 mr-3"></i>
                            <span>Support prioritaire</span>
                        </li>
                    </ul>
                    <a href="#contact" class="block w-full bg-white hover:bg-gray-100 text-blue-600 text-center px-6 py-3 rounded-lg font-semibold transition">
                        Choisir Premium
                    </a>
                </div>

                <!-- Formule Pro -->
                <div class="bg-white rounded-xl border-2 border-gray-200 p-8 hover:border-blue-500 transition">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Pro</h3>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-blue-600">Sur mesure</span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">Tout Premium inclus</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">Page courtier personnalisée</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">API et intégration site web</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">Campagnes marketing dédiées</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">Account manager dédié</span>
                        </li>
                    </ul>
                    <a href="#contact" class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-800 text-center px-6 py-3 rounded-lg font-semibold transition">
                        Nous contacter
                    </a>
                </div>
            </div>

            <div class="text-center mt-12">
                <p class="text-gray-600 text-sm md:text-base">
                    <i class="fas fa-info-circle mr-2"></i>
                    Tous les tarifs sont HT. Réduction de 15% pour un engagement annuel.
                </p>
            </div>
        </div>
    </section>

    <!-- Témoignages -->
    <section class="py-16 md:py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Ils nous font confiance</h2>
                <p class="text-base md:text-xl text-gray-600 max-w-3xl mx-auto">
                    Découvrez les retours de nos partenaires professionnels
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Témoignage 1 -->
                <div class="bg-white rounded-xl p-8 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 text-xl">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-6 text-sm md:text-base">
                        "Excellent retour sur investissement. Nous vendons 3 fois plus de bateaux depuis que nous sommes partenaires. L'interface est intuitive et le support réactif."
                    </p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                            JD
                        </div>
                        <div>
                            <div class="font-bold text-gray-800">Jean Dupont</div>
                            <div class="text-sm text-gray-600">Courtier Maritime - La Réunion</div>
                        </div>
                    </div>
                </div>

                <!-- Témoignage 2 -->
                <div class="bg-white rounded-xl p-8 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 text-xl">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-6 text-sm md:text-base">
                        "Plateforme professionnelle et efficace. Les outils de gestion sont vraiment pratiques et les statistiques nous aident à optimiser nos annonces."
                    </p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                            MR
                        </div>
                        <div>
                            <div class="font-bold text-gray-800">Marie Ravanne</div>
                            <div class="text-sm text-gray-600">Nautic Services - Maurice</div>
                        </div>
                    </div>
                </div>

                <!-- Témoignage 3 -->
                <div class="bg-white rounded-xl p-8 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 text-xl">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-6 text-sm md:text-base">
                        "My Boat a transformé notre business. Visibilité maximale, leads qualifiés et service client au top. Je recommande vivement !"
                    </p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                            PR
                        </div>
                        <div>
                            <div class="font-bold text-gray-800">Paul Randria</div>
                            <div class="text-sm text-gray-600">Ocean Boats - Madagascar</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Partenaires -->
    <section id="contact" class="py-16 md:py-24 bg-gradient-to-br from-blue-600 to-blue-800 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Prêt à rejoindre My Boat ?</h2>
                    <p class="text-lg md:text-xl text-blue-100">
                        Remplissez le formulaire ci-dessous et notre équipe vous contactera dans les 24h
                    </p>
                </div>

                <div class="bg-white rounded-xl p-8 md:p-12 text-gray-800">
                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="subject" value="Demande de partenariat">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nom de l'entreprise *</label>
                                <input type="text" name="company" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Votre nom *</label>
                                <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                                <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Téléphone *</label>
                                <input type="tel" name="phone" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Formule souhaitée</label>
                            <select name="formula" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Sélectionnez une formule</option>
                                <option value="essentielle">Essentielle - 29€/annonce/mois</option>
                                <option value="premium">Premium - 49€/annonce/mois</option>
                                <option value="pro">Pro - Sur mesure</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre de bateaux à publier</label>
                            <input type="number" name="boat_count" min="1" placeholder="Ex: 5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
                            <textarea name="message" rows="5" placeholder="Parlez-nous de votre activité et de vos besoins..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                        </div>

                        <div class="flex items-start">
                            <input type="checkbox" id="cgv" name="accept_terms" required class="mt-1 mr-3">
                            <label for="cgv" class="text-sm text-gray-600">
                                J'accepte les <a href="{{ route('cgv') }}" class="text-blue-600 hover:underline">conditions générales de vente</a> et la <a href="{{ route('confidentialite') }}" class="text-blue-600 hover:underline">politique de confidentialité</a>
                            </label>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-8 py-4 rounded-lg font-bold text-lg transition transform hover:scale-105 shadow-lg">
                            <i class="fas fa-paper-plane mr-2"></i> Envoyer ma demande
                        </button>

                        <p class="text-center text-sm text-gray-600">
                            <i class="fas fa-clock mr-1"></i> Réponse garantie sous 24h •
                            <i class="fas fa-shield-alt mr-1"></i> Sans engagement
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
