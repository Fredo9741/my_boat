@extends('layouts.admin')

@section('title', 'Tableau de bord - Myboat-oi')

@section('content')

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <!-- Sidebar -->
            @include('components.admin-sidebar')

            <!-- Contenu principal -->
            <main class="lg:col-span-3">

                <!-- Bienvenue -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl p-8 text-white mb-6">
                    <h2 class="text-3xl font-bold mb-2">Tableau de bord administrateur</h2>
                    <p class="text-blue-100">Vue d'ensemble de votre activité de courtage</p>
                </div>

                <!-- Statistiques -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    @php
                        $stats = [
                            ['icon' => 'ship', 'color' => 'blue', 'value' => '8', 'label' => 'Annonces actives', 'badge' => '+2', 'badgeColor' => 'green'],
                            ['icon' => 'eye', 'color' => 'purple', 'value' => '3,247', 'label' => 'Vues ce mois', 'badge' => '+12%', 'badgeColor' => 'green'],
                            ['icon' => 'inbox', 'color' => 'orange', 'value' => '12', 'label' => 'Demandes vendeurs', 'badge' => 'À traiter', 'badgeColor' => 'red'],
                            ['icon' => 'comments', 'color' => 'green', 'value' => '42', 'label' => 'Messages clients', 'badge' => '5 non lus', 'badgeColor' => 'red'],
                        ];
                    @endphp

                    @foreach($stats as $stat)
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-{{ $stat['color'] }}-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-{{ $stat['icon'] }} text-{{ $stat['color'] }}-600 text-xl"></i>
                                </div>
                                <span class="text-{{ $stat['badgeColor'] }}-600 text-sm font-semibold">{{ $stat['badge'] }}</span>
                            </div>
                            <div class="text-3xl font-bold text-gray-800 mb-1">{{ $stat['value'] }}</div>
                            <div class="text-gray-600 text-sm">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>

                <!-- Annonces récentes -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-800">Annonces récentes</h3>
                        <a href="/dashboard/annonces" class="text-blue-600 hover:text-blue-700 font-semibold">
                            Voir tout <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>

                    <div class="space-y-4">
                        @php
                            $boats = [
                                ['image' => 'https://images.unsplash.com/photo-1504198453319-5ce911bafcde?auto=format&fit=crop&w=200&q=80', 'title' => 'Voilier Bavaria 46', 'location' => 'La Réunion, Saint-Gilles', 'price' => 285000, 'status' => 'Publié', 'statusColor' => 'green', 'views' => 247, 'favorites' => 12, 'messages' => 3],
                                ['image' => 'https://images.unsplash.com/photo-1567899378494-47b22a2ae96a?auto=format&fit=crop&w=200&q=80', 'title' => 'Semi-rigide Zodiac Pro 650', 'location' => 'La Réunion, Saint-Paul', 'price' => 42000, 'status' => 'Publié', 'statusColor' => 'green', 'views' => 189, 'favorites' => 8, 'messages' => 5],
                                ['image' => 'https://images.unsplash.com/photo-1519112232437-3f9c2e9a4f24?auto=format&fit=crop&w=200&q=80', 'title' => 'Catamaran Lagoon 42', 'location' => 'Madagascar, Nosy Be', 'price' => 425000, 'status' => 'En attente', 'statusColor' => 'yellow', 'pending' => true],
                            ];
                        @endphp

                        @foreach($boats as $boat)
                            <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:shadow-md transition {{ isset($boat['pending']) ? 'opacity-60' : '' }}">
                                <img src="{{ $boat['image'] }}" class="w-24 h-24 object-cover rounded-lg mr-4" alt="{{ $boat['title'] }}">
                                <div class="flex-1">
                                    <div class="flex items-start justify-between mb-2">
                                        <div>
                                            <h4 class="font-bold text-lg text-gray-800">{{ $boat['title'] }}</h4>
                                            <p class="text-gray-600 text-sm">
                                                <i class="fas fa-map-marker-alt text-blue-600 mr-1"></i>
                                                {{ $boat['location'] }}
                                            </p>
                                        </div>
                                        <span class="bg-{{ $boat['statusColor'] }}-100 text-{{ $boat['statusColor'] }}-800 px-3 py-1 rounded-full text-sm font-semibold">
                                            {{ $boat['status'] }}
                                        </span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="text-blue-600 font-bold text-xl">{{ number_format($boat['price'], 0, ',', ' ') }} €</div>
                                        @if(isset($boat['views']))
                                            <div class="flex items-center space-x-4 text-sm text-gray-600">
                                                <span><i class="fas fa-eye mr-1"></i> {{ $boat['views'] }} vues</span>
                                                <span><i class="fas fa-heart mr-1"></i> {{ $boat['favorites'] }} favoris</span>
                                                <span><i class="fas fa-comments mr-1"></i> {{ $boat['messages'] }} messages</span>
                                            </div>
                                        @else
                                            <div class="flex items-center space-x-4 text-sm text-gray-600">
                                                <span><i class="fas fa-clock mr-1"></i> En cours de validation</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="ml-4 flex flex-col gap-2">
                                    <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition">
                                        <i class="fas fa-edit mr-1"></i> Modifier
                                    </button>
                                    @if(isset($boat['pending']))
                                        <button class="px-4 py-2 border border-red-300 hover:bg-red-50 text-red-600 rounded-lg text-sm font-medium transition">
                                            <i class="fas fa-trash mr-1"></i> Supprimer
                                        </button>
                                    @else
                                        <button class="px-4 py-2 border border-gray-300 hover:bg-gray-50 text-gray-700 rounded-lg text-sm font-medium transition">
                                            <i class="fas fa-eye mr-1"></i> Voir
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Activité récente -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <!-- Messages récents -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800">Messages récents</h3>
                            <a href="/dashboard/messages" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">
                                Voir tout
                            </a>
                        </div>

                        @php
                            $messages = [
                                ['initials' => 'MP', 'name' => 'Marie Payet', 'time' => 'Il y a 2h', 'message' => 'Bonjour, je suis intéressée par votre Bavaria 46...', 'new' => true, 'color' => 'blue'],
                                ['initials' => 'LC', 'name' => 'Luc Caron', 'time' => 'Hier', 'message' => 'Le bateau est-il toujours disponible ?', 'color' => 'green'],
                                ['initials' => 'SB', 'name' => 'Sophie Bernard', 'time' => 'Il y a 2j', 'message' => 'Merci pour les informations complémentaires', 'color' => 'purple'],
                            ];
                        @endphp

                        <div class="space-y-4">
                            @foreach($messages as $message)
                                <div class="flex items-start p-3 hover:bg-gray-50 rounded-lg cursor-pointer transition">
                                    <div class="w-12 h-12 bg-{{ $message['color'] }}-600 rounded-full flex items-center justify-center text-white font-bold mr-3 flex-shrink-0">
                                        {{ $message['initials'] }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex justify-between items-start mb-1">
                                            <p class="font-semibold text-gray-800">{{ $message['name'] }}</p>
                                            <span class="text-xs text-gray-500">{{ $message['time'] }}</span>
                                        </div>
                                        <p class="text-sm text-gray-600 truncate">{{ $message['message'] }}</p>
                                        @if(isset($message['new']))
                                            <span class="inline-block mt-1 bg-blue-500 text-white text-xs px-2 py-1 rounded">Nouveau</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Activités -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Activités récentes</h3>

                        @php
                            $activities = [
                                ['icon' => 'check', 'color' => 'green', 'title' => 'Annonce publiée', 'description' => 'Voilier Bavaria 46', 'time' => 'Il y a 3 heures'],
                                ['icon' => 'heart', 'color' => 'blue', 'title' => 'Nouveau favori', 'description' => 'Votre annonce a été ajoutée aux favoris', 'time' => 'Il y a 5 heures'],
                                ['icon' => 'eye', 'color' => 'purple', 'title' => 'Nouveau record de vues', 'description' => '247 vues aujourd\'hui', 'time' => 'Aujourd\'hui'],
                                ['icon' => 'edit', 'color' => 'yellow', 'title' => 'Annonce modifiée', 'description' => 'Semi-rigide Zodiac Pro 650', 'time' => 'Hier'],
                            ];
                        @endphp

                        <div class="space-y-4">
                            @foreach($activities as $activity)
                                <div class="flex items-start">
                                    <div class="w-10 h-10 bg-{{ $activity['color'] }}-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                        <i class="fas fa-{{ $activity['icon'] }} text-{{ $activity['color'] }}-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-800 font-medium">{{ $activity['title'] }}</p>
                                        <p class="text-sm text-gray-600">{{ $activity['description'] }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $activity['time'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

            </main>

        </div>
    </div>

@endsection
