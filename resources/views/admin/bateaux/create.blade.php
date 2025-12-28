@extends('layouts.admin')

@section('title', 'Ajouter un bateau - Administration')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        @include('components.admin-sidebar')

        <main class="lg:col-span-3">
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Ajouter un bateau</h1>
                        <p class="text-gray-600 mt-2">Créez une nouvelle annonce de bateau</p>
                    </div>
                    <a href="{{ route('admin.bateaux.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
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

            <form action="{{ route('admin.bateaux.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Informations générales -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                        Informations générales
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Modèle *</label>
                            <input type="text" name="modele" value="{{ old('modele') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Type de bateau *</label>
                            <select name="type_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Sélectionner un type</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->libelle }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Zone géographique</label>
                            <select name="zone_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Sélectionner une zone</option>
                                @foreach($zones as $zone)
                                    <option value="{{ $zone->id }}" {{ old('zone_id') == $zone->id ? 'selected' : '' }}>
                                        {{ $zone->libelle }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Prix (€) *</label>
                            <input type="number" name="prix" value="{{ old('prix') }}" required min="0" step="0.01"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Badge promotionnel</label>
                            <select name="slogan_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Aucun badge</option>
                                @foreach($actions as $action)
                                    <option value="{{ $action->id }}" {{ old('slogan_id') == $action->id ? 'selected' : '' }}>
                                        {{ $action->libelle }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date de publication</label>
                            <input type="datetime-local" name="published_at" value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Laissez vide pour utiliser la date actuelle automatiquement</p>
                        </div>

                        <div class="md:col-span-2">
                            <div class="flex items-center space-x-6">
                                <label class="flex items-center">
                                    <input type="checkbox" name="visible" value="1" {{ old('visible', true) ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Visible sur le site</span>
                                </label>

                                <label class="flex items-center">
                                    <input type="checkbox" name="occasion" value="1" {{ old('occasion') ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Bateau d'occasion</span>
                                </label>

                                <label class="flex items-center">
                                    <input type="checkbox" name="afficher_prix" value="1" {{ old('afficher_prix', true) ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Afficher le prix</span>
                                </label>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Caractéristiques techniques -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-cog text-blue-600 mr-2"></i>
                        Caractéristiques techniques
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Chantier</label>
                            <input type="text" name="chantier" value="{{ old('chantier') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Architecte</label>
                            <input type="text" name="architecte" value="{{ old('architecte') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Année</label>
                            <input type="number" name="annee" value="{{ old('annee') }}" min="1900" max="{{ date('Y') + 1 }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pavillon</label>
                            <input type="text" name="pavillon" value="{{ old('pavillon') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Matériaux</label>
                            <input type="text" name="materiaux" value="{{ old('materiaux') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Longueur HT (m)</label>
                            <input type="number" name="longueurht" value="{{ old('longueurht') }}" step="0.01"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Largeur (m)</label>
                            <input type="number" name="largeur" value="{{ old('largeur') }}" step="0.01"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tirant d'eau (m)</label>
                            <input type="number" name="tirantdeau" value="{{ old('tirantdeau') }}" step="0.01"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Poids lège (kg)</label>
                            <input type="number" name="poidslegeencharges" value="{{ old('poidslegeencharges') }}" step="0.01"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Surface au près (m²)</label>
                            <input type="number" name="surfaceaupres" value="{{ old('surfaceaupres') }}" step="0.01"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Moteur</label>
                            <input type="text" name="moteur" value="{{ old('moteur') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Puissance (CV)</label>
                            <input type="number" name="puissance" value="{{ old('puissance') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre de moteurs</label>
                            <input type="number" name="nombre_moteurs" value="{{ old('nombre_moteurs') }}" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Heures moteur</label>
                            <input type="number" name="heuresmoteur" value="{{ old('heuresmoteur') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Système antidérive</label>
                            <input type="text" name="systemeantiderive" value="{{ old('systemeantiderive') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cabines</label>
                            <input type="number" name="cabines" value="{{ old('cabines') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Passagers</label>
                            <input type="number" name="passagers" value="{{ old('passagers') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mots-clés (SEO)</label>
                            <input type="text" name="mots" value="{{ old('mots') }}" placeholder="bateau, voilier, catamaran..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Symboles/Équipements</label>
                            <textarea name="symboles" rows="2" placeholder="GPS, pilote automatique, guindeau électrique..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('symboles') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Équipements -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-list-check text-blue-600 mr-2"></i>
                            Équipements
                        </h2>
                        <button type="button"
                                onclick="openEquipmentModal()"
                                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-semibold transition text-sm">
                            <i class="fas fa-plus mr-2"></i>Nouvel équipement
                        </button>
                    </div>

                    @php
                        $categories = [
                            'navigation' => 'Navigation',
                            'confort' => 'Confort',
                            'securite' => 'Sécurité',
                            'electronique' => 'Électronique',
                            'manoeuvre' => 'Manœuvre',
                            'loisirs' => 'Loisirs'
                        ];
                    @endphp

                    @foreach($categories as $categorieKey => $categorieLabel)
                        @php
                            $equipementsCat = $equipements->where('categorie', $categorieKey);
                        @endphp
                        @if($equipementsCat->count() > 0)
                            <div class="mb-6">
                                <h3 class="font-bold text-gray-800 mb-3 text-lg">{{ $categorieLabel }}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                    @foreach($equipementsCat as $equipement)
                                        <label class="flex items-center cursor-pointer p-3 border border-gray-300 rounded-lg hover:bg-blue-50 transition">
                                            <input type="checkbox" name="equipements[]" value="{{ $equipement->id }}"
                                                   class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                                   {{ in_array($equipement->id, old('equipements', [])) ? 'checked' : '' }}>
                                            <i class="fas {{ $equipement->icone }} text-gray-600 ml-2 mr-2"></i>
                                            <span class="text-gray-700">{{ $equipement->libelle }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Médias -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-images text-blue-600 mr-2"></i>
                        Photos et vidéos
                    </h2>

                    <div class="space-y-6">
                        <!-- Upload Photos -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Photos du bateau</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition cursor-pointer"
                                 id="imageDropZone">
                                <input type="file"
                                       name="images[]"
                                       id="imageInput"
                                       multiple
                                       accept="image/jpeg,image/jpg,image/png,image/gif,image/webp"
                                       class="hidden">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                <p class="text-gray-600 mb-1">Cliquez pour sélectionner ou glissez-déposez vos photos</p>
                                <p class="text-xs text-gray-500">JPG, PNG, GIF, WEBP - Max 10 Mo par fichier</p>
                            </div>

                            <!-- Image Preview Grid -->
                            <div id="imagePreviewGrid" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4"></div>
                        </div>

                        <!-- Vidéos YouTube -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fab fa-youtube text-red-600 mr-2"></i>Vidéos YouTube
                            </label>
                            <p class="text-sm text-gray-600 mb-3">
                                Ajoutez vos vidéos en collant les liens YouTube (ex: https://www.youtube.com/watch?v=xxxxx ou https://youtu.be/xxxxx)
                            </p>
                            <div id="youtubeLinksContainer" class="space-y-2">
                                <div class="flex gap-2">
                                    <input type="url"
                                           name="youtube_links[]"
                                           placeholder="https://www.youtube.com/watch?v=..."
                                           class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <button type="button"
                                            onclick="addYouTubeLink()"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition flex items-center">
                                        <i class="fas fa-plus mr-1"></i> Ajouter
                                    </button>
                                </div>
                            </div>
                            <div class="mt-2 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                                <p class="text-xs text-blue-800">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    <strong>Astuce:</strong> Pour ajouter plusieurs vidéos, cliquez sur le bouton "Ajouter" pour créer de nouveaux champs.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end space-x-4">
                    <a href="{{ route('admin.bateaux.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition">
                        Annuler
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                        <i class="fas fa-save mr-2"></i>Créer le bateau
                    </button>
                </div>
            </form>
        </main>
    </div>
</div>

<!-- Modal Nouvel Équipement -->
<div id="equipmentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-xl font-bold text-gray-800">Ajouter un équipement</h3>
            <button type="button" onclick="closeEquipmentModal()" class="text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>

        <form id="quickEquipmentForm" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nom de l'équipement *</label>
                <input type="text" id="equipmentLibelle" name="libelle" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Ex: Radar couleur">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Catégorie *</label>
                <select id="equipmentCategorie" name="categorie" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">-- Sélectionner une catégorie --</option>
                    <option value="Navigation">Navigation</option>
                    <option value="Confort">Confort</option>
                    <option value="Sécurité">Sécurité</option>
                    <option value="Électronique">Électronique</option>
                    <option value="Manœuvre">Manœuvre</option>
                    <option value="Loisirs">Loisirs</option>
                </select>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-4">
                <button type="button" onclick="closeEquipmentModal()"
                        class="px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg font-semibold transition">
                    Annuler
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg font-semibold transition">
                    <i class="fas fa-check mr-2"></i>Ajouter
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Fonctions pour le modal d'équipement
window.openEquipmentModal = function() {
    document.getElementById('equipmentModal').classList.remove('hidden');
    document.getElementById('equipmentLibelle').value = '';
    document.getElementById('equipmentCategorie').value = '';
    document.getElementById('equipmentLibelle').focus();
};

window.closeEquipmentModal = function() {
    document.getElementById('equipmentModal').classList.add('hidden');
};

// Soumission du formulaire d'ajout d'équipement
document.addEventListener('DOMContentLoaded', function() {
    const equipmentForm = document.getElementById('quickEquipmentForm');
    if (equipmentForm) {
        equipmentForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const libelle = document.getElementById('equipmentLibelle').value;
            const categorie = document.getElementById('equipmentCategorie').value;

            if (!libelle || !categorie) {
                alert('Veuillez remplir tous les champs obligatoires');
                return;
            }

            // Envoyer la requête AJAX
            fetch('/admin/equipements/quick-create', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    libelle: libelle,
                    categorie: categorie
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Recharger la page pour afficher le nouvel équipement
                    window.location.reload();
                } else {
                    alert('Erreur: ' + (data.message || 'Impossible de créer l\'équipement'));
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur lors de la création de l\'équipement');
            });
        });
    }
});
</script>
@endpush

@push('scripts')
<script>
// Gestion de l'upload d'images avec preview
(function() {
    const imageInput = document.getElementById('imageInput');
    const imageDropZone = document.getElementById('imageDropZone');
    const imagePreviewGrid = document.getElementById('imagePreviewGrid');

    let selectedImages = [];

    // Click to upload images
    imageDropZone.addEventListener('click', () => imageInput.click());

    // Handle image selection
    imageInput.addEventListener('change', function(e) {
        handleImageFiles(Array.from(e.target.files));
    });

    // Drag & drop images
    imageDropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        imageDropZone.classList.add('border-blue-500', 'bg-blue-50');
    });

    imageDropZone.addEventListener('dragleave', () => {
        imageDropZone.classList.remove('border-blue-500', 'bg-blue-50');
    });

    imageDropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        imageDropZone.classList.remove('border-blue-500', 'bg-blue-50');
        const files = Array.from(e.dataTransfer.files).filter(file => file.type.startsWith('image/'));
        handleImageFiles(files);
    });

    function handleImageFiles(files) {
        files.forEach(file => {
            if (file.size > 10 * 1024 * 1024) {
                alert(`Le fichier ${file.name} dépasse 10 Mo`);
                return;
            }
            selectedImages.push(file);
        });
        updateImagePreview();
        updateImageInput();
    }

    function updateImagePreview() {
        imagePreviewGrid.innerHTML = '';
        selectedImages.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative group';
                div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg border-2 border-gray-200">
                    <button type="button" onclick="removeImage(${index})"
                            class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="absolute bottom-2 left-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                        ${(file.size / 1024).toFixed(0)} Ko
                    </div>
                `;
                imagePreviewGrid.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    }

    window.removeImage = function(index) {
        selectedImages.splice(index, 1);
        updateImagePreview();
        updateImageInput();
    };

    function updateImageInput() {
        const dataTransfer = new DataTransfer();
        selectedImages.forEach(file => dataTransfer.items.add(file));
        imageInput.files = dataTransfer.files;
    }

    // ===== YOUTUBE LINKS MANAGEMENT =====
    window.addYouTubeLink = function() {
        const container = document.getElementById('youtubeLinksContainer');
        const newField = document.createElement('div');
        newField.className = 'flex gap-2';
        newField.innerHTML = `
            <input type="url"
                   name="youtube_links[]"
                   placeholder="https://www.youtube.com/watch?v=..."
                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <button type="button"
                    onclick="this.parentElement.remove()"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition flex items-center">
                <i class="fas fa-trash"></i>
            </button>
        `;
        container.appendChild(newField);
    };
})();
</script>
@endpush
