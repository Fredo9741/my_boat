@extends('layouts.app')

@section('title', __('Contact - Myboat-oi | Courtage Maritime'))
@section('description', __('Contactez Myboat-oi pour tous vos projets d\'achat ou de vente de bateaux dans l\'océan Indien. Notre équipe d\'experts est à votre écoute.'))

@section('content')

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-ocean-600 via-ocean-700 to-luxe-navy dark:from-luxe-navy dark:via-ocean-950 dark:to-black text-white py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-96 h-96 bg-luxe-cyan rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-ocean-400 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-5xl md:text-6xl font-black mb-6">{{ __('Contactez-nous') }}</h1>
            <p class="text-xl md:text-2xl text-ocean-100 dark:text-ocean-200">{{ __('Notre équipe d\'experts maritimes est à votre écoute') }}</p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Formulaire de contact -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl p-8 border border-gray-100 dark:border-white/10">
                <h2 class="text-3xl font-black text-gray-900 dark:text-white mb-6">{{ __('Envoyez-nous un message') }}</h2>

                @if(session('success'))
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-950/30 dark:to-emerald-950/30 border-l-4 border-green-500 dark:border-green-400 p-5 mb-6 rounded-xl shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-xl mr-3"></i>
                        <p class="text-green-800 dark:text-green-300 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
                @endif

                @if($errors->any())
                <div class="bg-gradient-to-r from-red-50 to-rose-50 dark:from-red-950/30 dark:to-rose-950/30 border-l-4 border-red-500 dark:border-red-400 p-5 mb-6 rounded-xl shadow-sm">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-exclamation-circle text-red-600 dark:text-red-400 text-xl mr-3"></i>
                        <h3 class="text-red-900 dark:text-red-300 font-bold">{{ __('Erreurs de validation') }}</h3>
                    </div>
                    <ul class="list-disc list-inside text-red-800 dark:text-red-300 text-sm space-y-1 ml-8">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nom" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Nom complet') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="nom"
                                   id="nom"
                                   value="{{ old('nom') }}"
                                   required
                                   class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all @error('nom') ring-2 ring-red-500 @enderror"
                                   placeholder="{{ __('Votre nom') }}">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Email') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   value="{{ old('email') }}"
                                   required
                                   class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all @error('email') ring-2 ring-red-500 @enderror"
                                   placeholder="{{ __('Votre email') }}">
                        </div>
                    </div>

                    <div>
                        <label for="telephone" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Téléphone') }}
                        </label>
                        <input type="tel"
                               name="telephone"
                               id="telephone"
                               value="{{ old('telephone') }}"
                               class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all @error('telephone') ring-2 ring-red-500 @enderror"
                               placeholder="+262 692 XX XX XX">
                    </div>

                    <div>
                        <label for="sujet" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Sujet') }} <span class="text-red-500">*</span>
                        </label>
                        <select name="sujet"
                                id="sujet"
                                required
                                class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all">
                            <option value="">{{ __('Sélectionnez un sujet') }}</option>
                            <option value="achat" {{ old('sujet') == 'achat' ? 'selected' : '' }}>{{ __('Acheter un bateau') }}</option>
                            <option value="vente" {{ old('sujet') == 'vente' ? 'selected' : '' }}>{{ __('Vendre mon bateau') }}</option>
                            <option value="estimation" {{ old('sujet') == 'estimation' ? 'selected' : '' }}>{{ __('Demande d\'estimation') }}</option>
                            <option value="info" {{ old('sujet') == 'info' ? 'selected' : '' }}>{{ __('Informations générales') }}</option>
                            <option value="autre" {{ old('sujet') == 'autre' ? 'selected' : '' }}>{{ __('Autre') }}</option>
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Message') }} <span class="text-red-500">*</span>
                        </label>
                        <textarea name="message"
                                  id="message"
                                  rows="6"
                                  required
                                  placeholder="{{ __('Décrivez votre projet ou votre demande...') }}"
                                  class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-slate-800 border-0 focus:ring-2 focus:ring-ocean-500 text-gray-900 dark:text-white transition-all resize-none @error('message') ring-2 ring-red-500 @enderror">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit"
                            class="w-full bg-gradient-to-r from-ocean-600 to-luxe-cyan hover:from-ocean-700 hover:to-ocean-600 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all shadow-xl hover:shadow-2xl transform hover:scale-105 relative overflow-hidden group">
                        <span class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></span>
                        <span class="relative z-10">
                            <i class="fas fa-paper-plane mr-2"></i>
                            {{ __('Envoyer le message') }}
                        </span>
                    </button>

                    <p class="text-sm text-gray-500 dark:text-gray-400 text-center mt-4 flex items-center justify-center">
                        <i class="fas fa-lock mr-2"></i>
                        {{ __('Vos données sont protégées et ne seront jamais partagées') }}
                    </p>
                </form>
            </div>
        </div>

        <!-- Informations de contact -->
        <div class="space-y-6">
            <!-- Coordonnées -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl p-6 border border-gray-100 dark:border-white/10">
                <h3 class="text-xl font-black text-gray-900 dark:text-white mb-6 flex items-center">
                    <i class="fas fa-info-circle text-ocean-600 dark:text-ocean-400 mr-2"></i>
                    {{ __('Nos coordonnées') }}
                </h3>
                <div class="space-y-5">
                    <div class="flex items-start group">
                        <div class="w-12 h-12 bg-ocean-100 dark:bg-ocean-950/30 rounded-xl flex items-center justify-center flex-shrink-0 transition-transform group-hover:scale-110">
                            <i class="fas fa-user text-ocean-600 dark:text-ocean-400 text-lg"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-900 dark:text-white mb-1">{{ __('Contact') }}</h4>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Ghislain PAILLOT</p>
                        </div>
                    </div>

                    <div class="flex items-start group">
                        <div class="w-12 h-12 bg-ocean-100 dark:bg-ocean-950/30 rounded-xl flex items-center justify-center flex-shrink-0 transition-transform group-hover:scale-110">
                            <i class="fas fa-phone text-ocean-600 dark:text-ocean-400 text-lg"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-900 dark:text-white mb-1">{{ __('Téléphone') }}</h4>
                            <a href="tel:+262692706610" class="text-ocean-600 dark:text-ocean-400 hover:underline font-medium">+262 692 706 610</a>
                        </div>
                    </div>

                    <div class="flex items-start group">
                        <div class="w-12 h-12 bg-ocean-100 dark:bg-ocean-950/30 rounded-xl flex items-center justify-center flex-shrink-0 transition-transform group-hover:scale-110">
                            <i class="fas fa-map-marker-alt text-ocean-600 dark:text-ocean-400 text-lg"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-900 dark:text-white mb-1">{{ __('Adresse') }}</h4>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">
                                {{ __('La Darse du Port') }}<br>
                                97407 {{ __('La Réunion') }}<br>
                                {{ __('Océan Indien') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start group">
                        <div class="w-12 h-12 bg-ocean-100 dark:bg-ocean-950/30 rounded-xl flex items-center justify-center flex-shrink-0 transition-transform group-hover:scale-110">
                            <i class="fab fa-whatsapp text-ocean-600 dark:text-ocean-400 text-lg"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-900 dark:text-white mb-1">WhatsApp</h4>
                            <a href="https://wa.me/262692706610" target="_blank" class="text-ocean-600 dark:text-ocean-400 hover:underline font-medium text-sm">{{ __('Discuter sur WhatsApp') }}</a>
                        </div>
                    </div>

                    <div class="flex items-start group">
                        <div class="w-12 h-12 bg-ocean-100 dark:bg-ocean-950/30 rounded-xl flex items-center justify-center flex-shrink-0 transition-transform group-hover:scale-110">
                            <i class="fas fa-envelope text-ocean-600 dark:text-ocean-400 text-lg"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-900 dark:text-white mb-1">{{ __('Email') }}</h4>
                            <a href="mailto:contact@myboat-oi.com" class="text-ocean-600 dark:text-ocean-400 hover:underline font-medium text-sm">contact@myboat-oi.com</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Horaires -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl p-6 border border-gray-100 dark:border-white/10">
                <h3 class="text-xl font-black text-gray-900 dark:text-white mb-6 flex items-center">
                    <i class="fas fa-clock text-ocean-600 dark:text-ocean-400 mr-2"></i>
                    {{ __('Horaires d\'ouverture') }}
                </h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between py-2 border-b border-gray-200 dark:border-white/10">
                        <span class="font-semibold text-gray-900 dark:text-white">{{ __('Lundi - Vendredi') }}</span>
                        <span class="text-gray-600 dark:text-gray-400">9h00 - 18h00</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-200 dark:border-white/10">
                        <span class="font-semibold text-gray-900 dark:text-white">{{ __('Samedi') }}</span>
                        <span class="text-gray-600 dark:text-gray-400">9h00 - 13h00</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="font-semibold text-gray-900 dark:text-white">{{ __('Dimanche') }}</span>
                        <span class="text-red-600 dark:text-red-400 font-semibold">{{ __('Fermé') }}</span>
                    </div>
                </div>
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-5 p-4 bg-ocean-50 dark:bg-ocean-950/20 rounded-xl border border-ocean-100 dark:border-ocean-900/30">
                    <i class="fas fa-calendar-alt mr-2 text-ocean-600 dark:text-ocean-400"></i>
                    {{ __('Sur rendez-vous en dehors de ces horaires') }}
                </p>
            </div>

            <!-- Urgence -->
            <div class="bg-gradient-to-br from-ocean-600 via-ocean-700 to-luxe-navy dark:from-luxe-navy dark:via-ocean-900 dark:to-black rounded-3xl shadow-2xl p-6 text-white border border-ocean-500/30">
                <h3 class="text-xl font-black mb-3 flex items-center">
                    <i class="fas fa-bolt mr-2"></i>
                    {{ __('Besoin urgent ?') }}
                </h3>
                <p class="text-ocean-100 dark:text-ocean-200 text-sm mb-5">
                    {{ __('Pour les demandes urgentes, contactez-nous directement par téléphone ou WhatsApp.') }}
                </p>
                <a href="tel:+262692706610"
                   class="block w-full bg-white hover:bg-ocean-50 text-ocean-900 text-center px-4 py-3 rounded-xl font-bold transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                    <i class="fas fa-phone mr-2"></i>
                    {{ __('Contacter maintenant') }}
                </a>
            </div>
        </div>
    </div>

    <!-- FAQ Rapide -->
    <div class="mt-16">
        <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl p-8 md:p-12 border border-gray-100 dark:border-white/10">
            <h2 class="text-3xl font-black text-gray-900 dark:text-white mb-10 text-center">{{ __('Questions fréquentes') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-6 bg-gradient-to-br from-ocean-50 to-cyan-50 dark:from-ocean-950/20 dark:to-cyan-950/20 rounded-2xl border border-ocean-100 dark:border-ocean-900/30">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-3 flex items-start">
                        <i class="fas fa-question-circle text-ocean-600 dark:text-ocean-400 mr-3 mt-1"></i>
                        {{ __('Combien de temps pour vendre mon bateau ?') }}
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300 text-sm">
                        {{ __('Le délai varie selon le marché, mais en moyenne entre 2 et 6 mois. Nous optimisons votre annonce pour accélérer la vente.') }}
                    </p>
                </div>

                <div class="p-6 bg-gradient-to-br from-ocean-50 to-cyan-50 dark:from-ocean-950/20 dark:to-cyan-950/20 rounded-2xl border border-ocean-100 dark:border-ocean-900/30">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-3 flex items-start">
                        <i class="fas fa-question-circle text-ocean-600 dark:text-ocean-400 mr-3 mt-1"></i>
                        {{ __('Proposez-vous un service d\'expertise ?') }}
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300 text-sm">
                        {{ __('Oui ! Nous réalisons nous-mêmes les expertises de bateaux. Notre équipe d\'experts qualifiés effectue une évaluation complète et professionnelle de votre embarcation pour garantir sa valeur sur le marché.') }}
                    </p>
                </div>

                <div class="p-6 bg-gradient-to-br from-ocean-50 to-cyan-50 dark:from-ocean-950/20 dark:to-cyan-950/20 rounded-2xl border border-ocean-100 dark:border-ocean-900/30">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-3 flex items-start">
                        <i class="fas fa-question-circle text-ocean-600 dark:text-ocean-400 mr-3 mt-1"></i>
                        {{ __('Quels sont vos frais de courtage ?') }}
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300 text-sm">
                        {{ __('Nos commissions sont transparentes et compétitives. Contactez-nous pour un devis personnalisé.') }}
                    </p>
                </div>

                <div class="p-6 bg-gradient-to-br from-ocean-50 to-cyan-50 dark:from-ocean-950/20 dark:to-cyan-950/20 rounded-2xl border border-ocean-100 dark:border-ocean-900/30">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-3 flex items-start">
                        <i class="fas fa-question-circle text-ocean-600 dark:text-ocean-400 mr-3 mt-1"></i>
                        {{ __('Puis-je visiter les bateaux ?') }}
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300 text-sm">
                        {{ __('Absolument ! Nous organisons des visites accompagnées pour tous nos bateaux. Prenez rendez-vous avec nous.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
