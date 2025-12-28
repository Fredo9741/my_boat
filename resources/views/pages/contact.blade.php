@extends('layouts.app')

@section('title', 'Contact - Myboat-oi | Courtage Maritime')
@section('description', 'Contactez Myboat-oi pour tous vos projets d\'achat ou de vente de bateaux dans l\'océan Indien. Notre équipe d\'experts est à votre écoute.')

@section('content')

<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Contactez-nous</h1>
            <p class="text-xl text-blue-100">Notre équipe d'experts maritimes est à votre écoute</p>
        </div>
    </div>
</div>

<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'Accueil', 'url' => route('home')],
    ['label' => 'Contact', 'url' => '#']
]" />

<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Formulaire de contact -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Envoyez-nous un message</h2>

                @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <p class="text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
                @endif

                @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                        <h3 class="text-red-800 font-semibold">Erreurs de validation</h3>
                    </div>
                    <ul class="list-disc list-inside text-red-700 text-sm">
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
                            <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">
                                Nom complet <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="nom"
                                   id="nom"
                                   value="{{ old('nom') }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nom') border-red-500 @enderror">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   value="{{ old('email') }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror">
                        </div>
                    </div>

                    <div>
                        <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">
                            Téléphone
                        </label>
                        <input type="tel"
                               name="telephone"
                               id="telephone"
                               value="{{ old('telephone') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('telephone') border-red-500 @enderror">
                    </div>

                    <div>
                        <label for="sujet" class="block text-sm font-medium text-gray-700 mb-2">
                            Sujet <span class="text-red-500">*</span>
                        </label>
                        <select name="sujet"
                                id="sujet"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Sélectionnez un sujet</option>
                            <option value="achat" {{ old('sujet') == 'achat' ? 'selected' : '' }}>Acheter un bateau</option>
                            <option value="vente" {{ old('sujet') == 'vente' ? 'selected' : '' }}>Vendre mon bateau</option>
                            <option value="estimation" {{ old('sujet') == 'estimation' ? 'selected' : '' }}>Demande d'estimation</option>
                            <option value="info" {{ old('sujet') == 'info' ? 'selected' : '' }}>Informations générales</option>
                            <option value="autre" {{ old('sujet') == 'autre' ? 'selected' : '' }}>Autre</option>
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                            Message <span class="text-red-500">*</span>
                        </label>
                        <textarea name="message"
                                  id="message"
                                  rows="6"
                                  required
                                  placeholder="Décrivez votre projet ou votre demande..."
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg font-semibold text-lg transition shadow-lg hover:shadow-xl">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Envoyer le message
                    </button>

                    <p class="text-sm text-gray-500 text-center mt-4">
                        <i class="fas fa-lock mr-1"></i>
                        Vos données sont protégées et ne seront jamais partagées
                    </p>
                </form>
            </div>
        </div>

        <!-- Informations de contact -->
        <div class="space-y-6">
            <!-- Coordonnées -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                    Nos coordonnées
                </h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-map-marker-alt text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">Adresse</h4>
                            <p class="text-gray-600 text-sm">
                                Port de Saint-Gilles<br>
                                97434 La Réunion<br>
                                Océan Indien
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-phone text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">Téléphone</h4>
                            <a href="tel:+262692000000" class="text-blue-600 hover:underline">+262 692 XX XX XX</a>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fab fa-whatsapp text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">WhatsApp</h4>
                            <a href="https://wa.me/262692000000" target="_blank" class="text-blue-600 hover:underline">Discuter sur WhatsApp</a>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-envelope text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">Email</h4>
                            <a href="mailto:contact@myboat.re" class="text-blue-600 hover:underline text-sm">contact@myboat.re</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Horaires -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-clock text-blue-600 mr-2"></i>
                    Horaires d'ouverture
                </h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between py-2 border-b">
                        <span class="font-medium">Lundi - Vendredi</span>
                        <span class="text-gray-600">9h00 - 18h00</span>
                    </div>
                    <div class="flex justify-between py-2 border-b">
                        <span class="font-medium">Samedi</span>
                        <span class="text-gray-600">9h00 - 13h00</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="font-medium">Dimanche</span>
                        <span class="text-red-600">Fermé</span>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-4 p-3 bg-blue-50 rounded-lg">
                    <i class="fas fa-calendar-alt mr-1"></i>
                    Sur rendez-vous en dehors de ces horaires
                </p>
            </div>

            <!-- Urgence -->
            <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl shadow-lg p-6 text-white">
                <h3 class="text-lg font-bold mb-2">
                    <i class="fas fa-bolt mr-2"></i>
                    Besoin urgent ?
                </h3>
                <p class="text-blue-100 text-sm mb-4">
                    Pour les demandes urgentes, contactez-nous directement par téléphone ou WhatsApp.
                </p>
                <a href="https://wa.me/262692000000"
                   target="_blank"
                   class="block w-full bg-white text-blue-600 text-center px-4 py-3 rounded-lg font-semibold hover:bg-blue-50 transition">
                    <i class="fab fa-whatsapp mr-2"></i>
                    Contacter maintenant
                </a>
            </div>
        </div>
    </div>

    <!-- Carte Google Maps -->
    <div class="mt-12">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                <i class="fas fa-map-marked-alt text-blue-600 mr-2"></i>
                Comment nous trouver
            </h2>
            <div class="bg-gray-200 h-96 rounded-lg flex items-center justify-center text-gray-500">
                <div class="text-center">
                    <i class="fas fa-map-marked-alt text-6xl mb-4"></i>
                    <p class="text-lg">Carte interactive - Port de Saint-Gilles, La Réunion</p>
                    <p class="text-sm text-gray-400 mt-2">Intégration Google Maps à venir</p>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Rapide -->
    <div class="mt-12">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Questions fréquentes</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-6 bg-blue-50 rounded-lg">
                    <h3 class="font-bold text-gray-800 mb-2 flex items-start">
                        <i class="fas fa-question-circle text-blue-600 mr-2 mt-1"></i>
                        Combien de temps pour vendre mon bateau ?
                    </h3>
                    <p class="text-gray-600 text-sm">
                        Le délai varie selon le marché, mais en moyenne entre 2 et 6 mois. Nous optimisons votre annonce pour accélérer la vente.
                    </p>
                </div>

                <div class="p-6 bg-blue-50 rounded-lg">
                    <h3 class="font-bold text-gray-800 mb-2 flex items-start">
                        <i class="fas fa-question-circle text-blue-600 mr-2 mt-1"></i>
                        Proposez-vous un service d'expertise ?
                    </h3>
                    <p class="text-gray-600 text-sm">
                        Oui ! Nous pouvons faire expertiser votre bateau par des professionnels certifiés pour garantir sa valeur.
                    </p>
                </div>

                <div class="p-6 bg-blue-50 rounded-lg">
                    <h3 class="font-bold text-gray-800 mb-2 flex items-start">
                        <i class="fas fa-question-circle text-blue-600 mr-2 mt-1"></i>
                        Quels sont vos frais de courtage ?
                    </h3>
                    <p class="text-gray-600 text-sm">
                        Nos commissions sont transparentes et compétitives. Contactez-nous pour un devis personnalisé.
                    </p>
                </div>

                <div class="p-6 bg-blue-50 rounded-lg">
                    <h3 class="font-bold text-gray-800 mb-2 flex items-start">
                        <i class="fas fa-question-circle text-blue-600 mr-2 mt-1"></i>
                        Puis-je visiter les bateaux ?
                    </h3>
                    <p class="text-gray-600 text-sm">
                        Absolument ! Nous organisons des visites accompagnées pour tous nos bateaux. Prenez rendez-vous avec nous.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
