@extends('layouts.admin')

@section('title', 'Modifier l\'article - Administration')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        @include('components.admin-sidebar')

        <main class="lg:col-span-3">
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Modifier l'article</h1>
                        <p class="text-gray-600 mt-2">{{ $article->title }}</p>
                    </div>
                    <a href="{{ route('admin.articles.index') }}" class="text-gray-600 hover:text-gray-800 transition">
                        <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
                    </a>
                </div>
            </div>

            @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-circle text-red-500 mr-2 mt-0.5"></i>
                    <div>
                        <p class="text-red-700 font-semibold">Erreurs de validation :</p>
                        <ul class="list-disc list-inside text-red-600 mt-2">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">
                            <i class="fas fa-info-circle mr-2 text-blue-600"></i>Informations générales
                        </h2>

                        <!-- Titre -->
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Titre <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="title"
                                   id="title"
                                   value="{{ old('title', $article->title) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                   placeholder="Titre de l'article"
                                   required>
                        </div>

                        <!-- Slug -->
                        <div class="mb-6">
                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                                Slug <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="slug"
                                   id="slug"
                                   value="{{ old('slug', $article->slug) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition font-mono"
                                   placeholder="slug-de-l-article"
                                   required>
                            <p class="text-sm text-gray-500 mt-1">URL de l'article. Modifiez avec précaution si l'article est déjà publié.</p>
                        </div>

                        <!-- Statut -->
                        <div class="mb-6">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Statut <span class="text-red-500">*</span>
                            </label>
                            <select name="status"
                                    id="status"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="draft" {{ old('status', $article->status) === 'draft' ? 'selected' : '' }}>Brouillon</option>
                                <option value="published" {{ old('status', $article->status) === 'published' ? 'selected' : '' }}>Publié</option>
                            </select>
                        </div>

                        <!-- Image à la une -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Image à la une
                            </label>

                            @if($article->featured_image)
                            <div class="mb-4 relative inline-block">
                                <img src="{{ $article->featured_image_url }}" alt="Image actuelle" class="max-h-48 rounded-lg border">
                                <form action="{{ route('admin.articles.remove-featured-image', $article) }}" method="POST" class="absolute top-2 right-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white p-2 rounded-full shadow-lg transition"
                                            onclick="return confirm('Supprimer cette image ?')"
                                            title="Supprimer l'image">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </div>
                            @endif

                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition cursor-pointer" id="featured-image-dropzone">
                                <input type="file"
                                       name="featured_image"
                                       id="featured_image"
                                       accept="image/jpeg,image/jpg,image/png,image/webp"
                                       class="hidden">
                                <div id="featured-image-preview" class="hidden mb-4">
                                    <img src="" alt="Prévisualisation" class="max-h-48 mx-auto rounded-lg">
                                </div>
                                <div id="featured-image-placeholder">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                    <p class="text-gray-600">{{ $article->featured_image ? 'Remplacer l\'image' : 'Cliquez ou glissez une image ici' }}</p>
                                    <p class="text-sm text-gray-500 mt-1">JPEG, PNG, WebP - Max 5Mo</p>
                                </div>
                            </div>
                        </div>

                        <!-- Métadonnées -->
                        @if($article->published_at)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-calendar-check mr-2"></i>
                                Publié le {{ $article->published_at->format('d/m/Y à H:i') }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Contenu avec CKEditor -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">
                            <i class="fas fa-edit mr-2 text-blue-600"></i>Contenu de l'article
                        </h2>

                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                                Contenu
                            </label>
                            <textarea name="content"
                                      id="content"
                                      class="w-full"
                                      rows="20">{{ old('content', $article->content) }}</textarea>
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h3 class="font-semibold text-blue-800 mb-2">
                                <i class="fas fa-lightbulb mr-1"></i>Astuces
                            </h3>
                            <ul class="text-sm text-blue-700 space-y-1">
                                <li><i class="fas fa-image mr-1"></i> Insérez des images directement dans l'éditeur (stockées sur Cloudflare)</li>
                                <li><i class="fab fa-youtube mr-1"></i> Collez un lien YouTube pour intégrer automatiquement la vidéo</li>
                                <li><i class="fas fa-heading mr-1"></i> Utilisez les titres (H2, H3) pour structurer votre contenu</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="flex items-center justify-between">
                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                            <i class="fas fa-trash mr-2"></i>Supprimer
                        </button>
                    </form>

                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.articles.index') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-semibold transition">
                            Annuler
                        </a>
                        <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition">
                            <i class="fas fa-save mr-2"></i>Enregistrer les modifications
                        </button>
                    </div>
                </div>
            </form>
        </main>
    </div>
</div>
@endsection

@push('styles')
<style>
    .ck-editor__editable {
        min-height: 400px;
    }
    .ck-content .image {
        max-width: 100%;
    }
    .ck-content .image img {
        max-width: 100%;
        height: auto;
    }
    .ck-content .media {
        max-width: 100%;
    }
    .ck-content iframe {
        max-width: 100%;
    }
</style>
@endpush

@push('scripts')
<!-- CKEditor 5 CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Featured image preview
    const dropzone = document.getElementById('featured-image-dropzone');
    const input = document.getElementById('featured_image');
    const preview = document.getElementById('featured-image-preview');
    const placeholder = document.getElementById('featured-image-placeholder');

    dropzone.addEventListener('click', () => input.click());

    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.classList.add('border-blue-500', 'bg-blue-50');
    });

    dropzone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        dropzone.classList.remove('border-blue-500', 'bg-blue-50');
    });

    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.classList.remove('border-blue-500', 'bg-blue-50');
        if (e.dataTransfer.files.length) {
            input.files = e.dataTransfer.files;
            showPreview(e.dataTransfer.files[0]);
        }
    });

    input.addEventListener('change', (e) => {
        if (e.target.files.length) {
            showPreview(e.target.files[0]);
        }
    });

    function showPreview(file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            preview.querySelector('img').src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }

    // CKEditor 5 initialization
    CKEDITOR.ClassicEditor.create(document.getElementById('content'), {
        toolbar: {
            items: [
                'heading', '|',
                'bold', 'italic', 'underline', 'strikethrough', '|',
                'link', 'uploadImage', 'mediaEmbed', 'blockQuote', '|',
                'bulletedList', 'numberedList', 'outdent', 'indent', '|',
                'alignment', '|',
                'insertTable', 'horizontalLine', '|',
                'undo', 'redo', '|',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraphe', class: 'ck-heading_paragraph' },
                { model: 'heading2', view: 'h2', title: 'Titre 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Titre 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Titre 4', class: 'ck-heading_heading4' }
            ]
        },
        image: {
            toolbar: [
                'imageTextAlternative', 'toggleImageCaption', '|',
                'imageStyle:inline', 'imageStyle:block', 'imageStyle:side', '|',
                'linkImage'
            ],
            upload: {
                types: ['jpeg', 'png', 'gif', 'webp']
            }
        },
        simpleUpload: {
            uploadUrl: '{{ route('admin.articles.upload-image') }}',
            withCredentials: true,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        mediaEmbed: {
            previewsInData: true,
            providers: [
                {
                    name: 'youtube',
                    url: [
                        /^(?:m\.)?youtube\.com\/watch\?v=([\w-]+)(?:&t=(\d+))?/,
                        /^(?:m\.)?youtube\.com\/v\/([\w-]+)(?:\?t=(\d+))?/,
                        /^youtube\.com\/embed\/([\w-]+)(?:\?start=(\d+))?/,
                        /^youtu\.be\/([\w-]+)(?:\?t=(\d+))?/
                    ],
                    html: match => {
                        const id = match[1];
                        const time = match[2] || 0;
                        return `<div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                            <iframe src="https://www.youtube.com/embed/${id}${time ? '?start=' + time : ''}"
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>`;
                    }
                },
                {
                    name: 'vimeo',
                    url: /^vimeo\.com\/(\d+)/,
                    html: match => {
                        const id = match[1];
                        return `<div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                            <iframe src="https://player.vimeo.com/video/${id}"
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                                frameborder="0"
                                allow="autoplay; fullscreen; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>`;
                    }
                }
            ]
        },
        table: {
            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
        },
        language: 'fr',
        placeholder: 'Commencez à rédiger votre article...',
        removePlugins: [
            'CKBox',
            'CKFinder',
            'EasyImage',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            'MathType',
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents',
            'PasteFromOfficeEnhanced',
            'CaseChange'
        ]
    }).catch(error => {
        console.error('CKEditor error:', error);
    });
});
</script>
@endpush
