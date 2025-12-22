@extends('layouts.admin')

@section('title', 'Tableau de bord - Administration')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        @include('components.admin-sidebar')
        
        <main class="lg:col-span-3">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Tableau de bord</h1>
                <p class="text-gray-600 mt-2">Vue d'ensemble de votre marketplace</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm">Total Bateaux</p>
                            <p class="text-3xl font-bold mt-2">{{ $stats['total_bateaux'] }}</p>
                        </div>
                        <i class="fas fa-ship text-4xl opacity-50"></i>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm">Valeur totale</p>
                            <p class="text-3xl font-bold mt-2">{{ number_format($stats['valeur_totale']/1000000, 1) }}M €</p>
                        </div>
                        <i class="fas fa-euro-sign text-4xl opacity-50"></i>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm">Types</p>
                            <p class="text-3xl font-bold mt-2">{{ $stats['total_types'] }}</p>
                        </div>
                        <i class="fas fa-tags text-4xl opacity-50"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b flex justify-between items-center">
                    <h2 class="text-xl font-bold">Bateaux récents</h2>
                    <a href="{{ route('admin.bateaux.index') }}" class="text-blue-600 hover:text-blue-700">Voir tout →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Modèle</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prix</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentBateaux as $bateau)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $bateau->modele }}</td>
                                <td class="px-6 py-4">{{ $bateau->type->libelle }}</td>
                                <td class="px-6 py-4 font-semibold">{{ number_format($bateau->prix, 0, ',', ' ') }} €</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.bateaux.edit', $bateau) }}" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
