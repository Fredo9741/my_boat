@extends('layouts.app')

@section('title', __('Vendre Mon Bateau - Myboat-oi | Courtage Maritime'))
@section('description', __('Confiez la vente de votre bateau à Myboat-oi. Service professionnel, estimation gratuite, photos pro et accompagnement personnalisé dans l\'océan Indien.'))

@section('content')

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-ocean-600 via-ocean-700 to-luxe-navy dark:from-luxe-navy dark:via-ocean-950 dark:to-black text-white py-24 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-96 h-96 bg-luxe-cyan rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-ocean-400 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-5xl md:text-7xl font-black mb-6">{{ __('Vendez Votre Bateau') }}</h1>
            <p class="text-xl md:text-2xl text-ocean-100 dark:text-ocean-200 mb-8">
                {{ __('Profitez de notre expertise pour une vente rapide et au meilleur prix') }}
            </p>
            <a href="#formulaire" class="inline-block bg-white hover:bg-ocean-50 text-ocean-900 px-10 py-5 rounded-2xl font-black text-lg transition-all shadow-2xl hover:shadow-xl transform hover:scale-105">
                <i class="fas fa-rocket mr-2"></i>
                {{ __('Estimation Gratuite') }}
            </a>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-16">

    <!-- Avantages -->
    <div class="mb-20">
        <h2 class="text-4xl font-black text-gray-900 dark:text-white mb-12 text-center">
            {{ __('Pourquoi Vendre avec Myboat-oi ?') }}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-8 hover:shadow-2xl transition-all transform hover:-translate-y-2 text-center border border-gray-100 dark:border-white/10">
                <div class="w-20 h-20 bg-gradient-to-br from-green-100 to-emerald-200 dark:from-green-950/30 dark:to-emerald-900/30 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-euro-sign text-green-600 dark:text-green-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 dark:text-white mb-3">{{ __('Estimation Gratuite') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    {{ __('Expertise professionnelle gratuite pour connaître la valeur réelle de votre bateau') }}
                </p>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-8 hover:shadow-2xl transition-all transform hover:-translate-y-2 text-center border border-gray-100 dark:border-white/10">
                <div class="w-20 h-20 bg-gradient-to-br from-ocean-100 to-ocean-200 dark:from-ocean-950/30 dark:to-ocean-900/30 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-camera text-ocean-600 dark:text-ocean-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 dark:text-white mb-3">{{ __('Photos Pro') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    {{ __('Reportage photo et vidéo de qualité pour valoriser votre bateau') }}
                </p>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-8 hover:shadow-2xl transition-all transform hover:-translate-y-2 text-center border border-gray-100 dark:border-white/10">
                <div class="w-20 h-20 bg-gradient-to-br from-purple-100 to-violet-200 dark:from-purple-950/30 dark:to-violet-900/30 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-bullhorn text-purple-600 dark:text-purple-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 dark:text-white mb-3">{{ __('Large Diffusion') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    {{ __('Visibilité maximale sur 3 îles de l\'océan Indien') }}
                </p>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-8 hover:shadow-2xl transition-all transform hover:-translate-y-2 text-center border border-gray-100 dark:border-white/10">
                <div class="w-20 h-20 bg-gradient-to-br from-orange-100 to-amber-200 dark:from-orange-950/30 dark:to-amber-900/30 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-handshake text-orange-600 dark:text-orange-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 dark:text-white mb-3">{{ __('Accompagnement 100%') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    {{ __('Conseiller dédié de l\'annonce jusqu\'à la signature') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Process en 4 Étapes -->
    <div class="mb-20">
        <h2 class="text-4xl font-black text-gray-900 dark:text-white mb-12 text-center">
            {{ __('Comment Ça Marche ?') }}
        </h2>
        <div class="max-w-4xl mx-auto space-y-6">
            <div class="flex items-start bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-8 hover:shadow-2xl transition-all border border-gray-100 dark:border-white/10">
                <div class="w-16 h-16 bg-gradient-to-br from-ocean-600 to-ocean-700 text-white rounded-2xl flex items-center justify-center font-black text-2xl flex-shrink-0 mr-6 shadow-lg">
                    1
                </div>
                <div class="flex-1">
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-3">{{ __('Demande d\'Estimation') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('Remplissez notre formulaire en ligne avec les informations de votre bateau. Nous vous recontactons sous 24h pour organiser une visite.') }}
                    </p>
                </div>
            </div>

            <div class="flex items-start bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-8 hover:shadow-2xl transition-all border border-gray-100 dark:border-white/10">
                <div class="w-16 h-16 bg-gradient-to-br from-ocean-600 to-ocean-700 text-white rounded-2xl flex items-center justify-center font-black text-2xl flex-shrink-0 mr-6 shadow-lg">
                    2
                </div>
                <div class="flex-1">
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-3">{{ __('Expertise et Estimation') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('Un expert maritime se déplace pour inspecter votre bateau et vous proposer une estimation réaliste basée sur le marché actuel.') }}
                    </p>
                </div>
            </div>

            <div class="flex items-start bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-8 hover:shadow-2xl transition-all border border-gray-100 dark:border-white/10">
                <div class="w-16 h-16 bg-gradient-to-br from-ocean-600 to-ocean-700 text-white rounded-2xl flex items-center justify-center font-black text-2xl flex-shrink-0 mr-6 shadow-lg">
                    3
                </div>
                <div class="flex-1">
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-3">{{ __('Création de l\'Annonce') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('Nous réalisons les photos et vidéos professionnelles, rédigeons une description attractive et publions votre annonce sur notre plateforme.') }}
                    </p>
                </div>
            </div>

            <div class="flex items-start bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-8 hover:shadow-2xl transition-all border border-gray-100 dark:border-white/10">
                <div class="w-16 h-16 bg-gradient-to-br from-green-600 to-emerald-700 text-white rounded-2xl flex items-center justify-center font-black text-2xl flex-shrink-0 mr-6 shadow-lg">
                    4
                </div>
                <div class="flex-1">
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-3">{{ __('Vente et Formalités') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('Nous organisons les visites, négocions pour vous et gérons toutes les formalités administratives jusqu\'à la signature de l\'acte de vente.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Nos Services Vendeur -->
    <div class="mb-20 bg-gradient-to-br from-ocean-50 via-cyan-50 to-ocean-100 dark:from-ocean-950/20 dark:via-cyan-950/20 dark:to-ocean-900/20 rounded-3xl p-10 md:p-12 border border-ocean-200 dark:border-ocean-800/30">
        <h2 class="text-4xl font-black text-gray-900 dark:text-white mb-12 text-center">
            {{ __('Nos Services Vendeur') }}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 max-w-4xl mx-auto">
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-2xl mr-4 mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-900 dark:text-white text-lg">{{ __('Estimation gratuite et sans engagement') }}</h4>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-2xl mr-4 mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-900 dark:text-white text-lg">{{ __('Reportage photo et vidéo professionnel') }}</h4>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-2xl mr-4 mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-900 dark:text-white text-lg">{{ __('Diffusion multi-canaux optimisée') }}</h4>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-2xl mr-4 mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-900 dark:text-white text-lg">{{ __('Gestion des visites et pré-qualification') }}</h4>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-2xl mr-4 mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-900 dark:text-white text-lg">{{ __('Négociation et conseil tarifaire') }}</h4>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-2xl mr-4 mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-900 dark:text-white text-lg">{{ __('Accompagnement juridique et administratif') }}</h4>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-2xl mr-4 mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-900 dark:text-white text-lg">{{ __('Suivi post-vente et conseils') }}</h4>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-2xl mr-4 mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-900 dark:text-white text-lg">{{ __('Commission transparente et compétitive') }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire d'Estimation -->
    <div id="formulaire" class="mb-20">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl p-10 md:p-12 border border-gray-100 dark:border-white/10">
                <div class="text-center mb-10">
                    <h2 class="text-4xl font-black text-gray-900 dark:text-white mb-4">{{ __('Demande d\'Estimation Gratuite') }}</h2>
                    <p class="text-gray-600 dark:text-gray-400 text-lg">{{ __('Remplissez ce formulaire et recevez une estimation sous 24h') }}</p>
                </div>

                @if(session('success'))
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-950/30 dark:to-emerald-950/30 border-l-4 border-green-500 dark:border-green-400 p-5 mb-6 rounded-xl shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-xl mr-3"></i>
                        <p class="text-green-800 dark:text-green-300 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="sujet" value="estimation">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Nom complet') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nom" required
                                   class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all"
                                   placeholder="{{ __('Votre nom') }}">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Email') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" required
                                   class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all"
                                   placeholder="{{ __('votre@email.com') }}">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Téléphone') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="telephone" required
                                   class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all"
                                   placeholder="+262 692 XX XX XX">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Type de bateau') }}
                            </label>
                            <select name="type_bateau"
                                    class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all">
                                <option value="">{{ __('Sélectionnez') }}</option>
                                <option value="Voilier">{{ __('Voilier') }}</option>
                                <option value="Catamaran">{{ __('Catamaran') }}</option>
                                <option value="Catamaran à moteur">{{ __('Catamaran à moteur') }}</option>
                                <option value="Trimaran">{{ __('Trimaran') }}</option>
                                <option value="Yacht à moteur">{{ __('Yacht à moteur') }}</option>
                                <option value="Semi-rigide">{{ __('Semi-rigide') }}</option>
                                <option value="Bateau de pêche">{{ __('Bateau de pêche') }}</option>
                                <option value="Autre">{{ __('Autre') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Marque / Chantier') }}
                            </label>
                            <input type="text" name="marque"
                                   class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all"
                                   placeholder="{{ __('Ex: Beneteau') }}">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Modèle') }}
                            </label>
                            <input type="text" name="modele"
                                   class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all"
                                   placeholder="{{ __('Ex: Oceanis 40') }}">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Année') }}
                            </label>
                            <input type="number" name="annee" min="1950" max="{{ date('Y') + 1 }}"
                                   class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all"
                                   placeholder="{{ date('Y') }}">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Longueur (m)') }}
                            </label>
                            <input type="number" name="longueur" step="0.01"
                                   class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all"
                                   placeholder="12.5">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Localisation') }}
                            </label>
                            <select name="localisation"
                                    class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all">
                                <option value="">{{ __('Sélectionnez') }}</option>
                                <option value="La Réunion">{{ __('La Réunion') }}</option>
                                <option value="Maurice">{{ __('Maurice') }}</option>
                                <option value="Madagascar">{{ __('Madagascar') }}</option>
                                <option value="Mayotte">{{ __('Mayotte') }}</option>
                                <option value="Seychelles">{{ __('Seychelles') }}</option>
                                <option value="Zanzibar">{{ __('Zanzibar') }}</option>
                                <option value="France">{{ __('France') }}</option>
                                <option value="Europe">{{ __('Europe') }}</option>
                                <option value="Autre">{{ __('Autre') }}</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Ville / Port') }}
                            </label>
                            <input type="text" name="ville"
                                   class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all"
                                   placeholder="{{ __('Ex: Saint-Gilles') }}">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Informations complémentaires') }} <span class="text-red-500">*</span>
                        </label>
                        <textarea name="message" rows="5" required
                                  placeholder="{{ __('Décrivez l\'état général du bateau, équipements, travaux récents, etc.') }}"
                                  class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all resize-none"></textarea>
                    </div>

                    <button type="submit"
                            class="w-full bg-gradient-to-r from-ocean-600 to-luxe-cyan hover:from-ocean-700 hover:to-ocean-600 text-white px-8 py-4 rounded-2xl font-black text-lg transition-all shadow-xl hover:shadow-2xl transform hover:scale-105 relative overflow-hidden group">
                        <span class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></span>
                        <span class="relative z-10">
                            <i class="fas fa-paper-plane mr-2"></i>
                            {{ __('Demander Mon Estimation Gratuite') }}
                        </span>
                    </button>

                    <p class="text-sm text-gray-500 dark:text-gray-400 text-center flex items-center justify-center">
                        <i class="fas fa-shield-alt mr-2"></i>
                        {{ __('Vos données sont sécurisées et ne seront jamais partagées') }}
                    </p>
                </form>
            </div>
        </div>
    </div>

    <!-- FAQ Vendeur -->
    <div class="mb-20">
        <h2 class="text-4xl font-black text-gray-900 dark:text-white mb-12 text-center">
            {{ __('Questions Fréquentes') }}
        </h2>
        <div class="max-w-4xl mx-auto space-y-5">
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-7 border border-gray-100 dark:border-white/10 hover:shadow-2xl transition-all">
                <h3 class="font-black text-gray-900 dark:text-white mb-3 flex items-start text-lg">
                    <i class="fas fa-question-circle text-ocean-600 dark:text-ocean-400 mr-3 mt-1 text-xl"></i>
                    {{ __('Combien coûte votre service de courtage ?') }}
                </h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm ml-10">
                    {{ __('Notre commission est fixée selon un barème transparent et compétitif. Elle est calculée uniquement si la vente aboutit (pas de frais cachés). Contactez-nous pour un devis personnalisé gratuit.') }}
                </p>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-7 border border-gray-100 dark:border-white/10 hover:shadow-2xl transition-all">
                <h3 class="font-black text-gray-900 dark:text-white mb-3 flex items-start text-lg">
                    <i class="fas fa-question-circle text-ocean-600 dark:text-ocean-400 mr-3 mt-1 text-xl"></i>
                    {{ __('Combien de temps pour vendre mon bateau ?') }}
                </h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm ml-10">
                    {{ __('Le délai moyen de vente est de 2 à 6 mois selon le marché et le type de bateau. Nos actions marketing ciblées et notre large réseau nous permettent d\'accélérer significativement le processus.') }}
                </p>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-7 border border-gray-100 dark:border-white/10 hover:shadow-2xl transition-all">
                <h3 class="font-black text-gray-900 dark:text-white mb-3 flex items-start text-lg">
                    <i class="fas fa-question-circle text-ocean-600 dark:text-ocean-400 mr-3 mt-1 text-xl"></i>
                    {{ __('Est-ce que je garde mon bateau pendant la vente ?') }}
                </h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm ml-10">
                    {{ __('Oui, absolument ! Votre bateau reste en votre possession jusqu\'à la signature de l\'acte de vente. Vous pouvez continuer à l\'utiliser pendant la période de commercialisation.') }}
                </p>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-7 border border-gray-100 dark:border-white/10 hover:shadow-2xl transition-all">
                <h3 class="font-black text-gray-900 dark:text-white mb-3 flex items-start text-lg">
                    <i class="fas fa-question-circle text-ocean-600 dark:text-ocean-400 mr-3 mt-1 text-xl"></i>
                    {{ __('Dois-je être présent pour les visites ?') }}
                </h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm ml-10">
                    {{ __('Non, pas nécessairement. Nous pouvons organiser et gérer les visites pour vous. Toutefois, certains vendeurs préfèrent être présents pour partager leur expérience avec les acheteurs potentiels.') }}
                </p>
            </div>
        </div>
    </div>

    <!-- CTA Final -->
    <div class="bg-gradient-to-br from-ocean-600 via-ocean-700 to-luxe-navy dark:from-luxe-navy dark:via-ocean-900 dark:to-black rounded-3xl shadow-2xl p-12 md:p-16 text-white text-center border border-ocean-500/30">
        <h2 class="text-4xl font-black mb-5">{{ __('Prêt à Vendre Votre Bateau ?') }}</h2>
        <p class="text-xl text-ocean-100 dark:text-ocean-200 mb-10">{{ __('Obtenez une estimation gratuite en moins de 24h') }}</p>
        <a href="#formulaire" class="inline-block bg-white hover:bg-ocean-50 text-ocean-900 px-10 py-5 rounded-2xl font-black text-lg transition-all shadow-xl hover:shadow-2xl transform hover:scale-105">
            <i class="fas fa-arrow-up mr-2"></i>
            {{ __('Remplir le Formulaire') }}
        </a>
    </div>

</div>

@endsection
