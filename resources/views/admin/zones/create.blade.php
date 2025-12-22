@extends('layouts.admin')

@section('title', 'Ajouter une zone - Administration')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        @include('components.admin-sidebar')

        <main class="lg:col-span-3">
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Ajouter une zone géographique</h1>
                        <p class="text-gray-600 mt-2">Créez une nouvelle zone géographique</p>
                    </div>
                    <a href="{{ route('admin.zones.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
                        <i class="fas fa-arrow-left mr-2"></i>Retour
                    </a>
                </div>
            </div>

            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                <div class="flex items-center mb-2">
                    <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                    <h3 class="text-red-800 font-semibold">Erreurs de validation</h3>
                </div>
                <ul class="list-disc list-inside text-red-700 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="bg-white rounded-xl shadow-md p-8">
                <form action="{{ route('admin.zones.store') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nom de la zone géographique *
                        </label>
                        <input type="text"
                               name="libelle"
                               value="{{ old('libelle') }}"
                               required
                               placeholder="Ex: La Réunion, Maurice, Madagascar..."
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-lg">
                        <p class="text-xs text-gray-500 mt-1">Le slug sera généré automatiquement à partir du nom</p>
                    </div>

                    <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                        <a href="{{ route('admin.zones.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition">
                            Annuler
                        </a>
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                            <i class="fas fa-save mr-2"></i>Créer la zone
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection
