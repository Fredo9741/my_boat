@extends('layouts.admin')

@section('title', 'Réseaux sociaux & Contact - Administration')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        @include('components.admin-sidebar')

        <main class="lg:col-span-3">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Réseaux sociaux & Contact</h1>
                <p class="text-gray-600 mt-2">Configurez vos informations de contact et réseaux sociaux</p>
            </div>

            @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                    <p class="text-green-800">{{ session('success') }}</p>
                </div>
            </div>
            @endif

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
                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Contact -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-envelope text-blue-600 mr-2"></i>
                            Contact
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Email de contact *
                                </label>
                                <input type="email"
                                       name="contact_email"
                                       value="{{ old('contact_email', $settings['contact_email']) }}"
                                       placeholder="contact@myboat.re"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <p class="text-xs text-gray-500 mt-1">Les demandes des clients seront envoyées à cette adresse</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Numéro de téléphone
                                </label>
                                <input type="text"
                                       name="phone_number"
                                       value="{{ old('phone_number', $settings['phone_number']) }}"
                                       placeholder="+262 692 XX XX XX"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <p class="text-xs text-gray-500 mt-1">Affiché sur le site pour que les clients vous contactent</p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-8">

                    <!-- Réseaux sociaux -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-share-alt text-blue-600 mr-2"></i>
                            Réseaux sociaux
                        </h2>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fab fa-facebook text-blue-600 mr-2"></i>
                                    Page Facebook
                                </label>
                                <input type="url"
                                       name="facebook_url"
                                       value="{{ old('facebook_url', $settings['facebook_url']) }}"
                                       placeholder="https://www.facebook.com/votre-page"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <p class="text-xs text-gray-500 mt-1">URL complète de votre page Facebook (utilisée pour le partage des annonces)</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fab fa-instagram text-pink-600 mr-2"></i>
                                    Instagram
                                </label>
                                <input type="url"
                                       name="instagram_url"
                                       value="{{ old('instagram_url', $settings['instagram_url']) }}"
                                       placeholder="https://www.instagram.com/votre-compte"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <p class="text-xs text-gray-500 mt-1">URL complète de votre compte Instagram</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fab fa-whatsapp text-green-600 mr-2"></i>
                                    WhatsApp
                                </label>
                                <input type="text"
                                       name="whatsapp_number"
                                       value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}"
                                       placeholder="262692XXXXXX"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <p class="text-xs text-gray-500 mt-1">Numéro au format international sans + ni espaces (ex: 262692123456)</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                            <i class="fas fa-save mr-2"></i>Enregistrer les paramètres
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection
