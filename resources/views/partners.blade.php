@extends('layouts.app')

@section('title', 'Devenir Partenaire - Myboat-oi')

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
                    Développez votre activité avec Myboat-oi, la plateforme de référence pour les professionnels nautiques
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

    <!-- Nos Partenaires -->
    <section class="py-16 md:py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Nos Partenaires de Confiance</h2>
                <p class="text-base md:text-xl text-gray-600 max-w-3xl mx-auto">
                    Des professionnels reconnus dans l'océan Indien nous font déjà confiance
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Partenaire 1: SAILOÉ -->
                <div class="bg-white rounded-xl border-2 border-gray-200 p-8 hover:border-blue-500 transition hover:shadow-xl group">
                    <div class="flex flex-col items-center text-center h-full">
                        <div class="h-20 flex items-center justify-center mb-4 group-hover:scale-105 transition">
                            <img src="https://www.sailoe.com/img/sailoe/logo%20Sailoe%20black.png?version=d9ba1dcc" alt="SAILOÉ Logo" class="h-16 w-auto object-contain">
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">SAILOÉ</h3>
                        <p class="text-gray-600 text-sm mb-3">
                            <i class="fas fa-map-marker-alt mr-1 text-blue-600"></i>
                            Réunion - Seychelles - Corsica
                        </p>
                        <p class="text-gray-700 text-sm font-semibold mb-2">Distributeur Lagoon</p>
                        <p class="text-gray-600 text-xs mb-4 flex-grow">
                            Location & vente de catamarans, yacht management
                        </p>
                        <div class="flex gap-3 mt-auto">
                            <a href="https://www.sailoe.com" target="_blank" rel="noopener" class="text-blue-600 hover:text-blue-700 transition" title="Site web">
                                <i class="fas fa-globe text-xl"></i>
                            </a>
                            <a href="mailto:sailoe@sailoe.com" class="text-blue-600 hover:text-blue-700 transition" title="Email">
                                <i class="fas fa-envelope text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Partenaire 2: Plaisance Pro / Athanaze -->
                <div class="bg-white rounded-xl border-2 border-gray-200 p-8 hover:border-blue-500 transition hover:shadow-xl group">
                    <div class="flex flex-col items-center text-center h-full">
                        <div class="h-20 flex items-center justify-center mb-4 group-hover:scale-105 transition">
                            <img src="{{ asset('images/partners/logo_plaisance_pro.png') }}" alt="Plaisance Pro Logo" class="h-16 w-auto object-contain">
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Plaisance Pro</h3>
                        <p class="text-gray-600 text-sm mb-3">
                            <i class="fas fa-map-marker-alt mr-1 text-blue-600"></i>
                            Le Port, La Réunion
                        </p>
                        <p class="text-gray-700 text-sm font-semibold mb-2">Athanaze</p>
                        <p class="text-gray-600 text-xs mb-4 flex-grow">
                            Vente & réparation de bateaux, accastillage
                        </p>
                        <div class="flex gap-3 mt-auto">
                            <a href="https://www.facebook.com/ATHANAZE/" target="_blank" rel="noopener" class="text-blue-600 hover:text-blue-700 transition" title="Facebook">
                                <i class="fab fa-facebook text-xl"></i>
                            </a>
                            <a href="https://www.plaisance-pro.com" target="_blank" rel="noopener" class="text-blue-600 hover:text-blue-700 transition" title="Site web">
                                <i class="fas fa-globe text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Partenaire 3: Yacht Mauritius -->
                <div class="bg-white rounded-xl border-2 border-gray-200 p-8 hover:border-blue-500 transition hover:shadow-xl group">
                    <div class="flex flex-col items-center text-center h-full">
                        <div class="h-20 flex items-center justify-center mb-4 group-hover:scale-105 transition">
                            <img src="https://yachtmauritius.com/wp-content/uploads/2015/12/logo-web_YMT.svg" alt="Yacht Mauritius Logo" class="h-16 w-auto object-contain">
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Yacht Mauritius</h3>
                        <p class="text-gray-600 text-sm mb-3">
                            <i class="fas fa-map-marker-alt mr-1 text-blue-600"></i>
                            La Balise Marina, Maurice
                        </p>
                        <p class="text-gray-700 text-sm font-semibold mb-2">Distributeur Beneteau</p>
                        <p class="text-gray-600 text-xs mb-4 flex-grow">
                            Vente, charter & gestion de yachts
                        </p>
                        <div class="flex gap-3 mt-auto">
                            <a href="https://yachtmauritius.com/fr/" target="_blank" rel="noopener" class="text-blue-600 hover:text-blue-700 transition" title="Site web">
                                <i class="fas fa-globe text-xl"></i>
                            </a>
                            <a href="mailto:info@yachtmauritius.com" class="text-blue-600 hover:text-blue-700 transition" title="Email">
                                <i class="fas fa-envelope text-xl"></i>
                            </a>
                            <a href="https://www.instagram.com/yacht_mauritius_ltd" target="_blank" rel="noopener" class="text-blue-600 hover:text-blue-700 transition" title="Instagram">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Partenaire 4: Aurélien Bilh - CNC Marine -->
                <div class="bg-white rounded-xl border-2 border-gray-200 p-8 hover:border-blue-500 transition hover:shadow-xl group">
                    <div class="flex flex-col items-center text-center h-full">
                        <div class="h-20 flex items-center justify-center mb-4 group-hover:scale-105 transition">
                            <img src="https://cncmarine.com.au/wp-content/uploads/2023/03/Cnc-marine-logo-01-300x77.png" alt="CNC Marine Logo" class="h-16 w-auto object-contain brightness-0">
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Aurélien Bilh</h3>
                        <p class="text-gray-600 text-sm mb-3">
                            <i class="fas fa-map-marker-alt mr-1 text-blue-600"></i>
                            La Réunion
                        </p>
                        <p class="text-gray-700 text-sm font-semibold mb-2">Bateaux CNC Marine</p>
                        <p class="text-gray-600 text-xs mb-4 flex-grow">
                            Fabrication bateaux aluminium sur-mesure
                        </p>
                        <div class="flex gap-3 mt-auto">
                            <a href="https://cncmarine.com.au" target="_blank" rel="noopener" class="text-blue-600 hover:text-blue-700 transition" title="Site web">
                                <i class="fas fa-globe text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Partenaire 5: MadaNautique -->
                <div class="bg-white rounded-xl border-2 border-gray-200 p-8 hover:border-blue-500 transition hover:shadow-xl group">
                    <div class="flex flex-col items-center text-center h-full">
                        <div class="h-20 flex items-center justify-center mb-4 group-hover:scale-105 transition">
                            <img src="{{ asset('images/partners/logo_madanautique.jpg') }}" alt="MadaNautique Logo" class="h-16 w-auto object-contain">
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">MadaNautique</h3>
                        <p class="text-gray-600 text-sm mb-3">
                            <i class="fas fa-map-marker-alt mr-1 text-blue-600"></i>
                            Nosy-Bé, Madagascar
                        </p>
                        <p class="text-gray-700 text-sm font-semibold mb-2">Chantier naval</p>
                        <p class="text-gray-600 text-xs mb-4 flex-grow">
                            Travaux, acastillage & gestion de bateaux
                        </p>
                        <div class="flex gap-3 mt-auto">
                            <a href="https://www.facebook.com/profile.php?id=61572523351163" target="_blank" rel="noopener" class="text-blue-600 hover:text-blue-700 transition" title="Facebook">
                                <i class="fab fa-facebook text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <p class="text-gray-600 text-base md:text-lg">
                    <i class="fas fa-handshake mr-2 text-blue-600"></i>
                    Rejoignez nos partenaires et bénéficiez d'une visibilité maximale dans tout l'océan Indien
                </p>
            </div>
        </div>
    </section>

    <!-- Avantages Partenaires -->
    <section id="avantages" class="py-16 md:py-24 bg-white">
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
                    <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-4">Partenariat Gagnant-Gagnant</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                        Nous publions vos bateaux et vous offrons une visibilité maximale.
                        Aucun frais, juste une collaboration professionnelle et transparente.
                    </p>
                </div>
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
                        "Myboat-oi a transformé notre business. Visibilité maximale, leads qualifiés et service client au top. Je recommande vivement !"
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
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Prêt à rejoindre Myboat-oi ?</h2>
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
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Type d'activité</label>
                            <select name="activity_type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Sélectionnez votre activité</option>
                                <option value="courtier">Courtier maritime</option>
                                <option value="fabricant">Fabricant de bateaux</option>
                                <option value="distributeur">Distributeur / Revendeur</option>
                                <option value="accastillage">Accastillage / Équipements</option>
                                <option value="location">Location de bateaux</option>
                                <option value="autre">Autre activité nautique</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre estimé de bateaux</label>
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
