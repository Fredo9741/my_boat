<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bateau;
use App\Models\Type;
use App\Models\Zone;
use App\Models\Action;
use App\Models\Media;
use App\Models\Equipement;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BateauController extends Controller
{
    protected $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function index()
    {
        $bateaux = Bateau::with(['type', 'zone', 'slogan', 'medias'])
            ->latest()
            ->paginate(20);

        return view('admin.bateaux.index', compact('bateaux'));
    }

    public function create()
    {
        $types = Type::orderBy('libelle')->get();
        $zones = Zone::orderBy('libelle')->get();
        $actions = Action::orderBy('libelle')->get();
        $equipements = Equipement::orderBy('categorie')->orderBy('ordre')->get();

        return view('admin.bateaux.create', compact('types', 'zones', 'actions', 'equipements'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'modele' => 'required|string|max:255',
            'type_id' => 'required|exists:types,id',
            'zone_id' => 'nullable|exists:zones,id',
            'slogan_id' => 'nullable|exists:actions,id',
            'prix' => 'required|numeric|min:0',
            'afficher_prix' => 'boolean',
            'occasion' => 'boolean',
            'visible' => 'boolean',
            'description' => 'nullable|string',
            'symboles' => 'nullable|string',
            'mots' => 'nullable|string',
            'chantier' => 'nullable|string|max:255',
            'architecte' => 'nullable|string|max:255',
            'pavillon' => 'nullable|string|max:100',
            'annee' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'materiaux' => 'nullable|string|max:255',
            'longueurht' => 'nullable|numeric',
            'largeur' => 'nullable|numeric',
            'tirantdeau' => 'nullable|numeric',
            'poidslegeencharges' => 'nullable|numeric',
            'surfaceaupres' => 'nullable|numeric',
            'heuresmoteur' => 'nullable|integer',
            'puissance' => 'nullable|integer',
            'nombre_moteurs' => 'nullable|integer|min:0',
            'moteur' => 'nullable|string|max:255',
            'systemeantiderive' => 'nullable|string|max:255',
            'cabines' => 'nullable|integer',
            'passagers' => 'nullable|integer',
            'images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10240',
            'youtube_links.*' => 'nullable|url',
        ]);

        // Handle checkboxes
        $validated['visible'] = $request->has('visible');
        $validated['occasion'] = $request->has('occasion');
        $validated['afficher_prix'] = $request->has('afficher_prix');

        // Convert empty strings to null for foreign keys
        if (empty($validated['slogan_id'])) {
            $validated['slogan_id'] = null;
        }
        if (empty($validated['zone_id'])) {
            $validated['zone_id'] = null;
        }

        // Generate slug
        $validated['slug'] = Str::slug($validated['modele'] . '-' . uniqid());

        // Create bateau
        $bateau = Bateau::create($validated);

        // Sync equipements
        if ($request->has('equipements')) {
            $bateau->equipements()->sync($request->equipements);
        }

        // Handle image uploads
        if ($request->hasFile('images')) {
            $this->mediaService->uploadMultipleMedia($bateau, $request->file('images'), 'image');
        }

        // Handle YouTube links
        if ($request->has('youtube_links')) {
            $ordre = $bateau->medias()->max('ordre') ?? 0;
            foreach ($request->youtube_links as $link) {
                if (!empty($link)) {
                    $ordre++;
                    Media::create([
                        'bateau_id' => $bateau->id,
                        'type' => 'video',
                        'url' => $link,
                        'is_youtube' => true,
                        'ordre' => $ordre,
                    ]);
                }
            }
        }

        return redirect()->route('admin.bateaux.index')
            ->with('success', 'Bateau créé avec succès.');
    }

    public function edit(Bateau $bateau)
    {
        $bateau->load(['medias', 'type', 'zone', 'slogan', 'equipements']);
        $types = Type::orderBy('libelle')->get();
        $zones = Zone::orderBy('libelle')->get();
        $actions = Action::orderBy('libelle')->get();
        $equipements = Equipement::orderBy('categorie')->orderBy('ordre')->get();

        return view('admin.bateaux.edit', compact('bateau', 'types', 'zones', 'actions', 'equipements'));
    }

    public function update(Request $request, Bateau $bateau)
    {
        $validated = $request->validate([
            'modele' => 'required|string|max:255',
            'type_id' => 'required|exists:types,id',
            'zone_id' => 'nullable|exists:zones,id',
            'slogan_id' => 'nullable|exists:actions,id',
            'prix' => 'required|numeric|min:0',
            'afficher_prix' => 'boolean',
            'occasion' => 'boolean',
            'visible' => 'boolean',
            'description' => 'nullable|string',
            'symboles' => 'nullable|string',
            'mots' => 'nullable|string',
            'chantier' => 'nullable|string|max:255',
            'architecte' => 'nullable|string|max:255',
            'pavillon' => 'nullable|string|max:100',
            'annee' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'materiaux' => 'nullable|string|max:255',
            'longueurht' => 'nullable|numeric',
            'largeur' => 'nullable|numeric',
            'tirantdeau' => 'nullable|numeric',
            'poidslegeencharges' => 'nullable|numeric',
            'surfaceaupres' => 'nullable|numeric',
            'heuresmoteur' => 'nullable|integer',
            'puissance' => 'nullable|integer',
            'nombre_moteurs' => 'nullable|integer|min:0',
            'moteur' => 'nullable|string|max:255',
            'systemeantiderive' => 'nullable|string|max:255',
            'cabines' => 'nullable|integer',
            'passagers' => 'nullable|integer',
            'images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10240',
            'youtube_links.*' => 'nullable|url',
        ]);

        // Handle checkboxes
        $validated['visible'] = $request->has('visible');
        $validated['occasion'] = $request->has('occasion');
        $validated['afficher_prix'] = $request->has('afficher_prix');

        // Convert empty strings to null for foreign keys
        if (empty($validated['slogan_id'])) {
            $validated['slogan_id'] = null;
        }
        if (empty($validated['zone_id'])) {
            $validated['zone_id'] = null;
        }

        // Update bateau
        $bateau->update($validated);

        // Sync equipements
        if ($request->has('equipements')) {
            $bateau->equipements()->sync($request->equipements);
        } else {
            $bateau->equipements()->sync([]);
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $this->mediaService->uploadMultipleMedia($bateau, $request->file('images'), 'image');
        }

        // Handle YouTube links
        if ($request->has('youtube_links')) {
            $ordre = $bateau->medias()->max('ordre') ?? 0;
            foreach ($request->youtube_links as $link) {
                if (!empty($link)) {
                    $ordre++;
                    Media::create([
                        'bateau_id' => $bateau->id,
                        'type' => 'video',
                        'url' => $link,
                        'is_youtube' => true,
                        'ordre' => $ordre,
                    ]);
                }
            }
        }

        return redirect()->route('admin.bateaux.edit', $bateau)
            ->with('success', 'Bateau modifié avec succès.');
    }

    public function destroy(Bateau $bateau)
    {
        // Delete all associated media files
        foreach ($bateau->medias as $media) {
            $this->mediaService->deleteMedia($media);
        }

        $bateau->delete();

        return redirect()->route('admin.bateaux.index')
            ->with('success', 'Bateau supprimé avec succès.');
    }

    /**
     * Delete a specific media
     */
    public function deleteMedia(Media $media)
    {
        $bateauId = $media->bateau_id;
        $this->mediaService->deleteMedia($media);

        return redirect()->route('admin.bateaux.edit', $bateauId)
            ->with('success', 'Média supprimé avec succès.');
    }

    /**
     * Delete multiple media at once
     */
    public function bulkDeleteMedia(Request $request)
    {
        $mediaIds = $request->input('media_ids', []);

        if (empty($mediaIds)) {
            return redirect()->back()->with('error', 'Aucun média sélectionné.');
        }

        // Get the first media to retrieve bateau_id for redirect
        $firstMedia = Media::find($mediaIds[0]);
        $bateauId = $firstMedia ? $firstMedia->bateau_id : null;

        $count = 0;
        foreach ($mediaIds as $mediaId) {
            $media = Media::find($mediaId);
            if ($media) {
                $this->mediaService->deleteMedia($media);
                $count++;
            }
        }

        if ($bateauId) {
            return redirect()->route('admin.bateaux.edit', $bateauId)
                ->with('success', "$count média(s) supprimé(s) avec succès.");
        }

        return redirect()->back()->with('success', "$count média(s) supprimé(s) avec succès.");
    }

    /**
     * Set a media as main/principal
     */
    public function setMainMedia(Media $media)
    {
        if ($media->type !== 'image') {
            return redirect()->back()->with('error', 'Seules les images peuvent être définies comme photo principale.');
        }

        $bateau = $media->bateau;

        // Get the current main image (ordre = 0)
        $currentMain = $bateau->medias()->where('type', 'image')->where('ordre', 0)->first();

        if ($currentMain && $currentMain->id !== $media->id) {
            // Swap orders: current main gets the new image's order
            $tempOrdre = $media->ordre;
            $media->update(['ordre' => 0]);
            $currentMain->update(['ordre' => $tempOrdre]);
        } else {
            // No current main, just set this one to 0
            $media->update(['ordre' => 0]);
        }

        return redirect()->route('admin.bateaux.edit', $bateau)
            ->with('success', 'Photo principale mise à jour avec succès.');
    }
}
