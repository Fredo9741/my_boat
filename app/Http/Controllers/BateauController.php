<?php

namespace App\Http\Controllers;

use App\Models\Bateau;
use App\Models\Type;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BateauController extends Controller
{
    /**
     * Display a listing of all boats with filters
     */
    public function index(Request $request): View
    {
        // Start query with relations
        $query = Bateau::with(['type', 'zone', 'slogan', 'images'])
            ->visible();

        // Filter by type
        if ($request->filled('type_id')) {
            $typeIds = is_array($request->type_id)
                ? $request->type_id
                : [$request->type_id];
            $query->whereIn('type_id', $typeIds);
        }

        // Filter by zone
        if ($request->filled('zone_id')) {
            $zoneIds = is_array($request->zone_id)
                ? $request->zone_id
                : [$request->zone_id];
            $query->whereIn('zone_id', $zoneIds);
        }

        // Filter by price range
        if ($request->filled('prix_min')) {
            $query->where('prix', '>=', $request->prix_min);
        }
        if ($request->filled('prix_max')) {
            $query->where('prix', '<=', $request->prix_max);
        }

        // Filter by year range
        if ($request->filled('annee_min')) {
            $query->where('annee', '>=', $request->annee_min);
        }
        if ($request->filled('annee_max')) {
            $query->where('annee', '<=', $request->annee_max);
        }

        // Filter by condition (neuf/occasion)
        if ($request->filled('etat')) {
            if ($request->etat === 'neuf') {
                $query->neuf();
            } elseif ($request->etat === 'occasion') {
                $query->occasion();
            }
        }

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        switch ($sortBy) {
            case 'prix_asc':
                $query->orderBy('prix', 'asc');
                break;
            case 'prix_desc':
                $query->orderBy('prix', 'desc');
                break;
            case 'annee_desc':
                $query->orderBy('annee', 'desc');
                break;
            case 'annee_asc':
                $query->orderBy('annee', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        // Paginate results
        $bateaux = $query->paginate(12)->withQueryString();

        // Get filters data
        $types = Type::withCount(['bateaux' => function ($query) {
            $query->visible();
        }])->get();

        $zones = Zone::withCount(['bateaux' => function ($query) {
            $query->visible();
        }])->get();

        $totalCount = Bateau::visible()->count();

        return view('bateaux.index', compact(
            'bateaux',
            'types',
            'zones',
            'totalCount'
        ));
    }

    /**
     * Display the specified boat details
     */
    public function show(Request $request, string $slug): View
    {
        // Find boat by slug with all relations
        $bateau = Bateau::with([
            'type',
            'zone',
            'slogan',
            'equipements',
            'medias' => function ($query) {
                $query->orderBy('ordre');
            }
        ])
        ->where('slug', $slug)
        ->where('visible', true)
        ->firstOrFail();

        // Get similar boats (same type, different id)
        $similaires = Bateau::with(['type', 'zone', 'images'])
            ->visible()
            ->where('type_id', $bateau->type_id)
            ->where('id', '!=', $bateau->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('bateaux.show', compact('bateau', 'similaires'));
    }
}
