@extends('layouts.admin')

@section('title', 'Modifier un badge - Administration')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        @include('components.admin-sidebar')

        <main class="lg:col-span-3">
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Modifier un badge promotionnel</h1>
                        <p class="text-gray-600 mt-2">{{ $action->libelle }}</p>
                    </div>
                    <a href="{{ route('admin.actions.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
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
                <form action="{{ route('admin.actions.update', $action) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Texte du badge *
                        </label>
                        <input type="text"
                               name="libelle"
                               value="{{ old('libelle', $action->libelle) }}"
                               required
                               placeholder="Ex: Prix en baisse, Nouveau sur le marché..."
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-lg">
                        <p class="text-xs text-gray-500 mt-1">Le slug sera mis à jour automatiquement si vous modifiez le texte</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Couleur du badge *
                        </label>
                        <div class="grid grid-cols-4 gap-3">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="color" value="red" {{ old('color', $action->color) == 'red' ? 'checked' : '' }} required class="peer sr-only">
                                <div class="px-4 py-3 border-2 border-gray-300 rounded-lg text-center peer-checked:border-red-500 peer-checked:bg-red-50 hover:border-red-300 transition">
                                    <div class="w-full h-8 bg-red-500 rounded mb-2"></div>
                                    <span class="text-sm font-medium">Rouge</span>
                                </div>
                            </label>

                            <label class="relative cursor-pointer">
                                <input type="radio" name="color" value="green" {{ old('color', $action->color) == 'green' ? 'checked' : '' }} class="peer sr-only">
                                <div class="px-4 py-3 border-2 border-gray-300 rounded-lg text-center peer-checked:border-green-500 peer-checked:bg-green-50 hover:border-green-300 transition">
                                    <div class="w-full h-8 bg-green-500 rounded mb-2"></div>
                                    <span class="text-sm font-medium">Vert</span>
                                </div>
                            </label>

                            <label class="relative cursor-pointer">
                                <input type="radio" name="color" value="yellow" {{ old('color', $action->color) == 'yellow' ? 'checked' : '' }} class="peer sr-only">
                                <div class="px-4 py-3 border-2 border-gray-300 rounded-lg text-center peer-checked:border-yellow-500 peer-checked:bg-yellow-50 hover:border-yellow-300 transition">
                                    <div class="w-full h-8 bg-yellow-500 rounded mb-2"></div>
                                    <span class="text-sm font-medium">Jaune</span>
                                </div>
                            </label>

                            <label class="relative cursor-pointer">
                                <input type="radio" name="color" value="blue" {{ old('color', $action->color) == 'blue' ? 'checked' : '' }} class="peer sr-only">
                                <div class="px-4 py-3 border-2 border-gray-300 rounded-lg text-center peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-blue-300 transition">
                                    <div class="w-full h-8 bg-blue-500 rounded mb-2"></div>
                                    <span class="text-sm font-medium">Bleu</span>
                                </div>
                            </label>

                            <label class="relative cursor-pointer">
                                <input type="radio" name="color" value="purple" {{ old('color', $action->color) == 'purple' ? 'checked' : '' }} class="peer sr-only">
                                <div class="px-4 py-3 border-2 border-gray-300 rounded-lg text-center peer-checked:border-purple-500 peer-checked:bg-purple-50 hover:border-purple-300 transition">
                                    <div class="w-full h-8 bg-purple-500 rounded mb-2"></div>
                                    <span class="text-sm font-medium">Violet</span>
                                </div>
                            </label>

                            <label class="relative cursor-pointer">
                                <input type="radio" name="color" value="pink" {{ old('color', $action->color) == 'pink' ? 'checked' : '' }} class="peer sr-only">
                                <div class="px-4 py-3 border-2 border-gray-300 rounded-lg text-center peer-checked:border-pink-500 peer-checked:bg-pink-50 hover:border-pink-300 transition">
                                    <div class="w-full h-8 bg-pink-500 rounded mb-2"></div>
                                    <span class="text-sm font-medium">Rose</span>
                                </div>
                            </label>

                            <label class="relative cursor-pointer">
                                <input type="radio" name="color" value="orange" {{ old('color', $action->color) == 'orange' ? 'checked' : '' }} class="peer sr-only">
                                <div class="px-4 py-3 border-2 border-gray-300 rounded-lg text-center peer-checked:border-orange-500 peer-checked:bg-orange-50 hover:border-orange-300 transition">
                                    <div class="w-full h-8 bg-orange-500 rounded mb-2"></div>
                                    <span class="text-sm font-medium">Orange</span>
                                </div>
                            </label>

                            <label class="relative cursor-pointer">
                                <input type="radio" name="color" value="gray" {{ old('color', $action->color) == 'gray' ? 'checked' : '' }} class="peer sr-only">
                                <div class="px-4 py-3 border-2 border-gray-300 rounded-lg text-center peer-checked:border-gray-500 peer-checked:bg-gray-50 hover:border-gray-400 transition">
                                    <div class="w-full h-8 bg-gray-500 rounded mb-2"></div>
                                    <span class="text-sm font-medium">Gris</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg mb-6">
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-info-circle mr-2"></i>
                            <strong>Slug actuel :</strong> <span class="font-mono">{{ $action->slug ?? 'N/A' }}</span>
                        </p>
                    </div>

                    <!-- Aperçu du badge actuel -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-6">
                        <h4 class="font-semibold text-gray-700 mb-3">Aperçu actuel :</h4>
                        <span class="px-4 py-2 text-sm font-bold rounded-full text-white bg-{{ $action->color ?? 'gray' }}-500">
                            {{ $action->libelle }}
                        </span>
                    </div>

                    <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                        <a href="{{ route('admin.actions.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition">
                            Annuler
                        </a>
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                            <i class="fas fa-save mr-2"></i>Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection
