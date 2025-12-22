@extends('layouts.app')

@section('title', 'My Boat - Marketplace de Bateaux | Océan Indien')
@section('description', 'La première marketplace de vente de bateaux dans l\'océan Indien. Trouvez votre bateau idéal à La Réunion, Maurice et Madagascar.')

@section('content')

    <!-- Hero Section avec Recherche -->
    <section class="relative bg-blue-900 text-white">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1542397284385-6010376c5337?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/30 to-black/50"></div>

        <div class="relative container mx-auto px-4 py-20 md:py-32">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl md:text-6xl font-bold mb-6">
                    Trouvez votre bateau de rêve
                </h2>
                <p class="text-xl md:text-2xl mb-10 text-blue-100">
                    Votre courtier maritime de confiance dans l'océan Indien
                </p>

                <!-- Barre de Recherche Avancée -->
                <div class="bg-white rounded-xl shadow-2xl p-6">
                    <form action="{{ route('bateaux.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Type de bateau -->
                        <div class="text-left">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Type de bateau</label>
                            <select name="type_id" class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Tous les types</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->libelle }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Localisation -->
                        <div class="text-left">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Localisation</label>
                            <select name="zone_id" class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Toutes les îles</option>
                                @foreach($zones as $zone)
                                    <option value="{{ $zone->id }}">{{ $zone->libelle }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Prix max -->
                        <div class="text-left">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Prix maximum</label>
                            <select name="prix_max" class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Tous les prix</option>
                                <option value="10000">10 000 €</option>
                                <option value="25000">25 000 €</option>
                                <option value="50000">50 000 €</option>
                                <option value="100000">100 000 €</option>
                                <option value="250000">250 000 €</option>
                                <option value="500000">500 000 €+</option>
                            </select>
                        </div>

                        <!-- Bouton Rechercher -->
                        <div class="text-left">
                            <label class="block text-sm font-medium text-gray-700 mb-2 invisible">Rechercher</label>
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition transform hover:scale-105">
                                <i class="fas fa-search mr-2"></i> Rechercher
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="bg-white py-12 border-b">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold text-blue-600 mb-2">{{ number_format($stats['total_bateaux']) }}</div>
                    <div class="text-gray-600">Annonces actives</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-blue-600 mb-2">{{ $stats['total_types'] }}</div>
                    <div class="text-gray-600">Types de bateaux</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-blue-600 mb-2">{{ $stats['total_zones'] }}</div>
                    <div class="text-gray-600">Zones disponibles</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-blue-600 mb-2">{{ $zones->count() }}</div>
                    <div class="text-gray-600">Îles couvertes</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Catégories -->
    <section id="categories" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h3 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Explorer par catégorie</h3>
                <p class="text-gray-600 text-lg">Trouvez le type de bateau qui vous correspond</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($types->take(6) as $type)
                    @php
                        // Use type's icon if available, otherwise default
                        $typeIcon = $type->icone ?? 'fa-ship';
                    @endphp
                    <a href="{{ route('bateaux.index', ['type_id' => $type->id]) }}" class="group">
                        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-6 text-center">
                            <div class="w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center group-hover:bg-blue-600 transition">
                                <i class="fas {{ $typeIcon }} text-3xl text-blue-600 group-hover:text-white transition"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800 group-hover:text-blue-600 transition">{{ $type->libelle }}</h4>
                            <p class="text-sm text-gray-500 mt-1">{{ $type->bateaux_count }} annonce{{ $type->bateaux_count > 1 ? 's' : '' }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Annonces à la Une -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-12">
                <div>
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Annonces à la une</h3>
                    <p class="text-gray-600">Les meilleures offres du moment</p>
                </div>
                <a href="{{ route('bateaux.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold flex items-center">
                    Voir tout <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($featuredBateaux->take(4) as $bateau)
                    <x-boat-card
                        :slug="$bateau->slug"
                        :title="$bateau->modele"
                        :image="$bateau->main_image"
                        :price="$bateau->prix"
                        :location="$bateau->location"
                        :length="$bateau->length"
                        :year="$bateau->annee"
                        :badge="$bateau->badge['label'] ?? null"
                        :badge-color="$bateau->badge['color'] ?? 'green'"
                    />
                @empty
                    <div class="col-span-4 text-center py-12 text-gray-500">
                        <i class="fas fa-anchor text-6xl mb-4 opacity-30"></i>
                        <p class="text-xl">Aucune annonce disponible pour le moment</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Pourquoi nous choisir -->
    <section class="py-16 bg-gradient-to-br from-blue-50 to-blue-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h3 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Pourquoi My Boat ?</h3>
                <p class="text-gray-600 text-lg">La plateforme de confiance pour l'océan Indien</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Avantage 1 -->
                <div class="bg-white rounded-xl p-8 text-center shadow-md hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-3xl text-blue-600"></i>
                    </div>
                    <h4 class="font-bold text-xl text-gray-800 mb-3">Sécurisé</h4>
                    <p class="text-gray-600">Paiements sécurisés et vérification des vendeurs pour votre tranquillité</p>
                </div>

                <!-- Avantage 2 -->
                <div class="bg-white rounded-xl p-8 text-center shadow-md hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-3xl text-blue-600"></i>
                    </div>
                    <h4 class="font-bold text-xl text-gray-800 mb-3">Large choix</h4>
                    <p class="text-gray-600">Des milliers d'annonces pour tous les budgets et tous les besoins</p>
                </div>

                <!-- Avantage 3 -->
                <div class="bg-white rounded-xl p-8 text-center shadow-md hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-3xl text-blue-600"></i>
                    </div>
                    <h4 class="font-bold text-xl text-gray-800 mb-3">Support 7j/7</h4>
                    <p class="text-gray-600">Notre équipe vous accompagne à chaque étape de votre achat</p>
                </div>

                <!-- Avantage 4 -->
                <div class="bg-white rounded-xl p-8 text-center shadow-md hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-chart-line text-3xl text-blue-600"></i>
                    </div>
                    <h4 class="font-bold text-xl text-gray-800 mb-3">Prix justes</h4>
                    <p class="text-gray-600">Estimation gratuite et transparence sur les prix du marché</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section id="contact" class="py-16 bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h3 class="text-3xl md:text-4xl font-bold mb-4">Vous souhaitez vendre votre bateau ?</h3>
                    <p class="text-xl text-blue-100">Confiez la vente de votre bateau à notre équipe d'experts</p>
                </div>

                <div class="bg-white rounded-xl p-8 text-gray-800">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 text-2xl mr-4 mt-1"></i>
                            <div>
                                <h4 class="font-bold text-lg mb-2">Estimation gratuite</h4>
                                <p class="text-gray-600">Nous évaluons votre bateau au meilleur prix du marché</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 text-2xl mr-4 mt-1"></i>
                            <div>
                                <h4 class="font-bold text-lg mb-2">Gestion complète</h4>
                                <p class="text-gray-600">Photos professionnelles, annonces et visites</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 text-2xl mr-4 mt-1"></i>
                            <div>
                                <h4 class="font-bold text-lg mb-2">Réseau d'acheteurs</h4>
                                <p class="text-gray-600">Accès à notre base de clients qualifiés</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 text-2xl mr-4 mt-1"></i>
                            <div>
                                <h4 class="font-bold text-lg mb-2">Accompagnement juridique</h4>
                                <p class="text-gray-600">Sécurisation de la transaction de A à Z</p>
                            </div>
                        </div>
                    </div>

                    <form class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" placeholder="Votre nom" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        <input type="email" placeholder="Votre email" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        <input type="tel" placeholder="Votre téléphone" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        <select class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            <option value="">Type de bateau</option>
                            <option>Voilier</option>
                            <option>Catamaran</option>
                            <option>Yacht</option>
                            <option>Bateau à moteur</option>
                            <option>Semi-rigide</option>
                            <option>Bateau de pêche</option>
                        </select>
                        <textarea rows="4" placeholder="Description de votre bateau (marque, modèle, année, prix souhaité...)" class="md:col-span-2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required></textarea>
                        <button type="submit" class="md:col-span-2 bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg font-bold text-lg transition transform hover:scale-105">
                            <i class="fas fa-paper-plane mr-2"></i> Demander une estimation gratuite
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
