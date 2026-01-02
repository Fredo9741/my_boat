@extends('layouts.app')

@section('title', 'Devenir Partenaire - Myboat-oi')
@section('description', 'Rejoignez le N°1 de la vente de bateaux dans l\'océan Indien. Développez votre activité avec Myboat-oi.')

@section('content')

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-ocean-600 via-ocean-700 to-luxe-navy dark:from-luxe-navy dark:via-ocean-950 dark:to-black text-white py-24 md:py-32 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-20 w-96 h-96 bg-luxe-cyan rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-ocean-400 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-black mb-6 leading-tight">
                Rejoignez le N°1 de la vente de bateaux dans l'océan Indien
            </h1>
            <p class="text-xl md:text-2xl text-ocean-100 dark:text-ocean-200 mb-12">
                Développez votre activité avec Myboat-oi, la plateforme de référence pour les professionnels nautiques
            </p>
            <div class="flex flex-col sm:flex-row gap-5 justify-center">
                <a href="#contact" class="inline-flex items-center justify-center bg-white hover:bg-ocean-50 text-ocean-900 px-10 py-5 rounded-2xl font-black text-lg transition-all shadow-xl hover:shadow-2xl transform hover:scale-105">
                    <i class="fas fa-handshake mr-3"></i> Devenir partenaire
                </a>
                <a href="#avantages" class="inline-flex items-center justify-center bg-ocean-500/20 hover:bg-ocean-500/30 backdrop-blur-sm border-2 border-white/50 text-white px-10 py-5 rounded-2xl font-black text-lg transition-all shadow-xl">
                    <i class="fas fa-info-circle mr-3"></i> En savoir plus
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Statistiques Clés -->
<div class="bg-white dark:bg-slate-900 py-16 border-b border-gray-200 dark:border-white/10">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-4xl md:text-6xl font-black bg-gradient-to-br from-ocean-600 to-luxe-cyan bg-clip-text text-transparent mb-3">5000+</div>
                <div class="text-sm md:text-base text-gray-600 dark:text-gray-400 font-semibold">Visiteurs/mois</div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-6xl font-black bg-gradient-to-br from-ocean-600 to-luxe-cyan bg-clip-text text-transparent mb-3">98%</div>
                <div class="text-sm md:text-base text-gray-600 dark:text-gray-400 font-semibold">Satisfaction client</div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-6xl font-black bg-gradient-to-br from-ocean-600 to-luxe-cyan bg-clip-text text-transparent mb-3">24h</div>
                <div class="text-sm md:text-base text-gray-600 dark:text-gray-400 font-semibold">Temps de réponse moyen</div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-6xl font-black bg-gradient-to-br from-ocean-600 to-luxe-cyan bg-clip-text text-transparent mb-3">100%</div>
                <div class="text-sm md:text-base text-gray-600 dark:text-gray-400 font-semibold">Océan Indien</div>
            </div>
        </div>
    </div>
</div>

<!-- Nos Partenaires -->
<section class="py-20 md:py-24 bg-gray-50 dark:bg-slate-950">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black text-gray-800 dark:text-white mb-5">Nos Partenaires de Confiance</h2>
            <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                Des professionnels reconnus dans l'océan Indien nous font déjà confiance
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Partenaire 1: SAILOÉ -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl border-2 border-gray-200 dark:border-white/10 p-8 hover:border-ocean-500 dark:hover:border-ocean-500 transition-all hover:shadow-2xl transform hover:-translate-y-2 group">
                <div class="flex flex-col items-center text-center h-full">
                    <div class="h-20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <img src="https://www.sailoe.com/img/sailoe/logo%20Sailoe%20black.png?version=d9ba1dcc" alt="SAILOÉ Logo" class="h-16 w-auto object-contain dark:brightness-0 dark:invert">
                    </div>
                    <h3 class="text-2xl font-black text-gray-800 dark:text-white mb-3">SAILOÉ</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-ocean-600 dark:text-ocean-400"></i>
                        Réunion - Seychelles - Corsica
                    </p>
                    <p class="text-ocean-700 dark:text-ocean-300 text-sm font-bold mb-3">Distributeur Lagoon</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-6 flex-grow leading-relaxed">
                        Location & vente de catamarans, yacht management
                    </p>
                    <div class="flex gap-4 mt-auto">
                        <a href="https://www.sailoe.com" target="_blank" rel="noopener" class="text-ocean-600 dark:text-ocean-400 hover:text-ocean-700 dark:hover:text-ocean-300 transition text-2xl" title="Site web">
                            <i class="fas fa-globe"></i>
                        </a>
                        <a href="mailto:sailoe@sailoe.com" class="text-ocean-600 dark:text-ocean-400 hover:text-ocean-700 dark:hover:text-ocean-300 transition text-2xl" title="Email">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Partenaire 2: Plaisance Pro / Athanaze -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl border-2 border-gray-200 dark:border-white/10 p-8 hover:border-ocean-500 dark:hover:border-ocean-500 transition-all hover:shadow-2xl transform hover:-translate-y-2 group">
                <div class="flex flex-col items-center text-center h-full">
                    <div class="h-20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <img src="{{ asset('images/partners/logo_plaisance_pro.png') }}" alt="Plaisance Pro Logo" class="h-16 w-auto object-contain">
                    </div>
                    <h3 class="text-2xl font-black text-gray-800 dark:text-white mb-3">Plaisance Pro</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-ocean-600 dark:text-ocean-400"></i>
                        Le Port, La Réunion
                    </p>
                    <p class="text-ocean-700 dark:text-ocean-300 text-sm font-bold mb-3">Athanaze</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-6 flex-grow leading-relaxed">
                        Vente & réparation de bateaux, accastillage
                    </p>
                    <div class="flex gap-4 mt-auto">
                        <a href="https://www.facebook.com/ATHANAZE/" target="_blank" rel="noopener" class="text-ocean-600 dark:text-ocean-400 hover:text-ocean-700 dark:hover:text-ocean-300 transition text-2xl" title="Facebook">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://www.plaisance-pro.com" target="_blank" rel="noopener" class="text-ocean-600 dark:text-ocean-400 hover:text-ocean-700 dark:hover:text-ocean-300 transition text-2xl" title="Site web">
                            <i class="fas fa-globe"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Partenaire 3: Yacht Mauritius -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl border-2 border-gray-200 dark:border-white/10 p-8 hover:border-ocean-500 dark:hover:border-ocean-500 transition-all hover:shadow-2xl transform hover:-translate-y-2 group">
                <div class="flex flex-col items-center text-center h-full">
                    <div class="h-20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <img src="https://yachtmauritius.com/wp-content/uploads/2015/12/logo-web_YMT.svg" alt="Yacht Mauritius Logo" class="h-16 w-auto object-contain dark:brightness-0 dark:invert">
                    </div>
                    <h3 class="text-2xl font-black text-gray-800 dark:text-white mb-3">Yacht Mauritius</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-ocean-600 dark:text-ocean-400"></i>
                        La Balise Marina, Maurice
                    </p>
                    <p class="text-ocean-700 dark:text-ocean-300 text-sm font-bold mb-3">Distributeur Beneteau</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-6 flex-grow leading-relaxed">
                        Vente, charter & gestion de yachts
                    </p>
                    <div class="flex gap-4 mt-auto">
                        <a href="https://yachtmauritius.com/fr/" target="_blank" rel="noopener" class="text-ocean-600 dark:text-ocean-400 hover:text-ocean-700 dark:hover:text-ocean-300 transition text-2xl" title="Site web">
                            <i class="fas fa-globe"></i>
                        </a>
                        <a href="mailto:info@yachtmauritius.com" class="text-ocean-600 dark:text-ocean-400 hover:text-ocean-700 dark:hover:text-ocean-300 transition text-2xl" title="Email">
                            <i class="fas fa-envelope"></i>
                        </a>
                        <a href="https://www.instagram.com/yacht_mauritius_ltd" target="_blank" rel="noopener" class="text-ocean-600 dark:text-ocean-400 hover:text-ocean-700 dark:hover:text-ocean-300 transition text-2xl" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Partenaire 4: Aurélien Bilh - CNC Marine -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl border-2 border-gray-200 dark:border-white/10 p-8 hover:border-ocean-500 dark:hover:border-ocean-500 transition-all hover:shadow-2xl transform hover:-translate-y-2 group">
                <div class="flex flex-col items-center text-center h-full">
                    <div class="h-20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <img src="https://cncmarine.com.au/wp-content/uploads/2023/03/Cnc-marine-logo-01-300x77.png" alt="CNC Marine Logo" class="h-16 w-auto object-contain brightness-0 dark:brightness-0 dark:invert">
                    </div>
                    <h3 class="text-2xl font-black text-gray-800 dark:text-white mb-3">Aurélien Bilh</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-ocean-600 dark:text-ocean-400"></i>
                        La Réunion
                    </p>
                    <p class="text-ocean-700 dark:text-ocean-300 text-sm font-bold mb-3">Bateaux CNC Marine</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-6 flex-grow leading-relaxed">
                        Fabrication bateaux aluminium sur-mesure
                    </p>
                    <div class="flex gap-4 mt-auto">
                        <a href="https://cncmarine.com.au" target="_blank" rel="noopener" class="text-ocean-600 dark:text-ocean-400 hover:text-ocean-700 dark:hover:text-ocean-300 transition text-2xl" title="Site web">
                            <i class="fas fa-globe"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Partenaire 5: MadaNautique -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl border-2 border-gray-200 dark:border-white/10 p-8 hover:border-ocean-500 dark:hover:border-ocean-500 transition-all hover:shadow-2xl transform hover:-translate-y-2 group">
                <div class="flex flex-col items-center text-center h-full">
                    <div class="h-20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <img src="{{ asset('images/partners/logo_madanautique.jpg') }}" alt="MadaNautique Logo" class="h-16 w-auto object-contain">
                    </div>
                    <h3 class="text-2xl font-black text-gray-800 dark:text-white mb-3">MadaNautique</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-ocean-600 dark:text-ocean-400"></i>
                        Nosy-Bé, Madagascar
                    </p>
                    <p class="text-ocean-700 dark:text-ocean-300 text-sm font-bold mb-3">Chantier naval</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-6 flex-grow leading-relaxed">
                        Travaux, accastillage & gestion de bateaux
                    </p>
                    <div class="flex gap-4 mt-auto">
                        <a href="https://www.facebook.com/profile.php?id=61572523351163" target="_blank" rel="noopener" class="text-ocean-600 dark:text-ocean-400 hover:text-ocean-700 dark:hover:text-ocean-300 transition text-2xl" title="Facebook">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-16">
            <p class="text-gray-600 dark:text-gray-400 text-lg font-semibold">
                <i class="fas fa-handshake mr-2 text-ocean-600 dark:text-ocean-400"></i>
                Rejoignez nos partenaires et bénéficiez d'une visibilité maximale dans tout l'océan Indien
            </p>
        </div>
    </div>
</section>

<!-- Avantages Partenaires -->
<section id="avantages" class="py-20 md:py-24 bg-white dark:bg-slate-900">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black text-gray-800 dark:text-white mb-5">Pourquoi devenir partenaire ?</h2>
            <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                Profitez d'une visibilité maximale et d'outils professionnels pour booster vos ventes
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Avantage 1 -->
            <div class="bg-gray-50 dark:bg-slate-800 rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-2 border border-gray-100 dark:border-white/10">
                <div class="w-16 h-16 bg-gradient-to-br from-ocean-500 to-ocean-600 rounded-2xl flex items-center justify-center mb-6 shadow-xl">
                    <i class="fas fa-chart-line text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-800 dark:text-white mb-4">Visibilité Maximale</h3>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                    Votre catalogue accessible à des milliers d'acheteurs potentiels dans toute la zone océan Indien.
                    Référencement premium et mise en avant de vos annonces.
                </p>
            </div>

            <!-- Avantage 2 -->
            <div class="bg-gray-50 dark:bg-slate-800 rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-2 border border-gray-100 dark:border-white/10">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6 shadow-xl">
                    <i class="fas fa-tools text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-800 dark:text-white mb-4">Outils Professionnels</h3>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                    Interface d'administration intuitive, gestion simplifiée de vos annonces,
                    statistiques détaillées et outils marketing performants.
                </p>
            </div>

            <!-- Avantage 3 -->
            <div class="bg-gray-50 dark:bg-slate-800 rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-2 border border-gray-100 dark:border-white/10">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 shadow-xl">
                    <i class="fas fa-headset text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-800 dark:text-white mb-4">Support Dédié</h3>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                    Accompagnement personnalisé par notre équipe d'experts.
                    Formation, conseils et assistance technique disponibles 7j/7.
                </p>
            </div>

            <!-- Avantage 4 -->
            <div class="bg-gray-50 dark:bg-slate-800 rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-2 border border-gray-100 dark:border-white/10">
                <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6 shadow-xl">
                    <i class="fas fa-bolt text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-800 dark:text-white mb-4">Mise en Ligne Rapide</h3>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                    Publiez vos annonces en quelques clics.
                    Modification instantanée, upload massif de photos et vidéos YouTube intégrées.
                </p>
            </div>

            <!-- Avantage 5 -->
            <div class="bg-gray-50 dark:bg-slate-800 rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-2 border border-gray-100 dark:border-white/10">
                <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mb-6 shadow-xl">
                    <i class="fas fa-shield-alt text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-800 dark:text-white mb-4">Sécurité & Confiance</h3>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                    Badge "Professionnel vérifié", système de notation clients,
                    et modération active pour garantir des transactions sécurisées.
                </p>
            </div>

            <!-- Avantage 6 -->
            <div class="bg-gray-50 dark:bg-slate-800 rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-2 border border-gray-100 dark:border-white/10">
                <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6 shadow-xl">
                    <i class="fas fa-euro-sign text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-800 dark:text-white mb-4">Partenariat Gagnant-Gagnant</h3>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                    Nous publions vos bateaux et vous offrons une visibilité maximale.
                    Aucun frais, juste une collaboration professionnelle et transparente.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Témoignages -->
<section class="py-20 md:py-24 bg-gray-50 dark:bg-slate-950">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black text-gray-800 dark:text-white mb-5">Ils nous font confiance</h2>
            <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                Découvrez les retours de nos partenaires professionnels
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Témoignage 1 -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-8 shadow-xl border border-gray-100 dark:border-white/10">
                <div class="flex items-center mb-6">
                    <div class="text-luxe-gold text-2xl">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <p class="text-gray-700 dark:text-gray-300 italic mb-8 leading-relaxed">
                    "Excellent retour sur investissement. Nous vendons 3 fois plus de bateaux depuis que nous sommes partenaires. L'interface est intuitive et le support réactif."
                </p>
                <div class="flex items-center">
                    <div class="w-14 h-14 bg-gradient-to-br from-ocean-600 to-luxe-cyan rounded-2xl flex items-center justify-center text-white font-black mr-4 shadow-lg">
                        JD
                    </div>
                    <div>
                        <div class="font-black text-gray-800 dark:text-white">Jean Dupont</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Courtier Maritime - La Réunion</div>
                    </div>
                </div>
            </div>

            <!-- Témoignage 2 -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-8 shadow-xl border border-gray-100 dark:border-white/10">
                <div class="flex items-center mb-6">
                    <div class="text-luxe-gold text-2xl">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <p class="text-gray-700 dark:text-gray-300 italic mb-8 leading-relaxed">
                    "Plateforme professionnelle et efficace. Les outils de gestion sont vraiment pratiques et les statistiques nous aident à optimiser nos annonces."
                </p>
                <div class="flex items-center">
                    <div class="w-14 h-14 bg-gradient-to-br from-ocean-600 to-luxe-cyan rounded-2xl flex items-center justify-center text-white font-black mr-4 shadow-lg">
                        MR
                    </div>
                    <div>
                        <div class="font-black text-gray-800 dark:text-white">Marie Ravanne</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Nautic Services - Maurice</div>
                    </div>
                </div>
            </div>

            <!-- Témoignage 3 -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-8 shadow-xl border border-gray-100 dark:border-white/10">
                <div class="flex items-center mb-6">
                    <div class="text-luxe-gold text-2xl">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <p class="text-gray-700 dark:text-gray-300 italic mb-8 leading-relaxed">
                    "Myboat-oi a transformé notre business. Visibilité maximale, leads qualifiés et service client au top. Je recommande vivement !"
                </p>
                <div class="flex items-center">
                    <div class="w-14 h-14 bg-gradient-to-br from-ocean-600 to-luxe-cyan rounded-2xl flex items-center justify-center text-white font-black mr-4 shadow-lg">
                        PR
                    </div>
                    <div>
                        <div class="font-black text-gray-800 dark:text-white">Paul Randria</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Ocean Boats - Madagascar</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Partenaires -->
<section id="contact" class="py-20 md:py-24 bg-gradient-to-br from-ocean-600 via-ocean-700 to-luxe-navy dark:from-luxe-navy dark:via-ocean-950 dark:to-black text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-black mb-5">Prêt à rejoindre Myboat-oi ?</h2>
                <p class="text-xl text-ocean-100 dark:text-ocean-200">
                    Remplissez le formulaire ci-dessous et notre équipe vous contactera dans les 24h
                </p>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-3xl p-10 md:p-12 text-gray-800 dark:text-white shadow-2xl border border-gray-100 dark:border-white/10">
                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="subject" value="Demande de partenariat">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nom de l'entreprise *</label>
                            <input type="text" name="company" required class="w-full px-4 py-3 border-2 border-gray-300 dark:border-slate-700 dark:bg-slate-800 rounded-xl focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Votre nom *</label>
                            <input type="text" name="name" required class="w-full px-4 py-3 border-2 border-gray-300 dark:border-slate-700 dark:bg-slate-800 rounded-xl focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Email *</label>
                            <input type="email" name="email" required class="w-full px-4 py-3 border-2 border-gray-300 dark:border-slate-700 dark:bg-slate-800 rounded-xl focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Téléphone *</label>
                            <input type="tel" name="phone" required class="w-full px-4 py-3 border-2 border-gray-300 dark:border-slate-700 dark:bg-slate-800 rounded-xl focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Type d'activité</label>
                        <select name="activity_type" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-slate-700 dark:bg-slate-800 rounded-xl focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition">
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
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nombre estimé de bateaux</label>
                        <input type="number" name="boat_count" min="1" placeholder="Ex: 5" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-slate-700 dark:bg-slate-800 rounded-xl focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Message</label>
                        <textarea name="message" rows="5" placeholder="Parlez-nous de votre activité et de vos besoins..." class="w-full px-4 py-3 border-2 border-gray-300 dark:border-slate-700 dark:bg-slate-800 rounded-xl focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition"></textarea>
                    </div>

                    <div class="flex items-start">
                        <input type="checkbox" id="cgv" name="accept_terms" required class="mt-1 mr-3 w-5 h-5 text-ocean-600 border-gray-300 rounded focus:ring-ocean-500">
                        <label for="cgv" class="text-sm text-gray-600 dark:text-gray-400">
                            J'accepte les <a href="{{ route('cgv') }}" class="text-ocean-600 dark:text-ocean-400 hover:underline font-semibold">conditions générales de vente</a> et la <a href="{{ route('confidentialite') }}" class="text-ocean-600 dark:text-ocean-400 hover:underline font-semibold">politique de confidentialité</a>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-ocean-600 to-luxe-cyan hover:from-ocean-700 hover:to-ocean-500 text-white px-10 py-5 rounded-2xl font-black text-lg transition-all transform hover:scale-105 shadow-xl">
                        <i class="fas fa-paper-plane mr-2"></i> Envoyer ma demande
                    </button>

                    <p class="text-center text-sm text-gray-600 dark:text-gray-400 font-semibold">
                        <i class="fas fa-clock mr-2"></i> Réponse garantie sous 24h •
                        <i class="fas fa-shield-alt mr-2"></i> Sans engagement
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
