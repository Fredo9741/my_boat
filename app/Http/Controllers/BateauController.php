<?php

namespace App\Http\Controllers;

use App\Models\Bateau;
use App\Models\Type;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

        // Filter by type (support both type_id and type slug for SEO-friendly URLs)
        if ($request->filled('type_id')) {
            $typeIds = is_array($request->type_id)
                ? $request->type_id
                : [$request->type_id];
            $query->whereIn('type_id', $typeIds);
        } elseif ($request->filled('type')) {
            $typeSlugs = is_array($request->type)
                ? $request->type
                : [$request->type];
            $typeIds = Type::whereIn('slug', $typeSlugs)->pluck('id')->toArray();
            if (!empty($typeIds)) {
                $query->whereIn('type_id', $typeIds);
            }
        }

        // Filter by zone (support both zone_id and zone slug for SEO-friendly URLs)
        if ($request->filled('zone_id')) {
            $zoneIds = is_array($request->zone_id)
                ? $request->zone_id
                : [$request->zone_id];
            $query->whereIn('zone_id', $zoneIds);
        } elseif ($request->filled('zone')) {
            $zoneSlugs = is_array($request->zone)
                ? $request->zone
                : [$request->zone];
            $zoneIds = Zone::whereIn('slug', $zoneSlugs)->pluck('id')->toArray();
            if (!empty($zoneIds)) {
                $query->whereIn('zone_id', $zoneIds);
            }
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
        $sortBy = $request->get('sort_by', 'published_at');
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
            case 'published_at':
                $query->orderBy('published_at', 'desc');
                break;
            default:
                $query->orderBy('published_at', 'desc');
        }

        // Get all results (no pagination)
        $bateaux = $query->get();

        // Get filters data
        $types = Type::withCount(['bateaux' => function ($query) {
            $query->visible();
        }])->get();

        $zones = Zone::withCount(['bateaux' => function ($query) {
            $query->visible();
        }])->get();

        $totalCount = Bateau::visible()->count();

        // Get active filter labels for dynamic page title
        $activeTypeFilter = null;
        $activeZoneFilter = null;

        // Mapping for plural labels (used in page titles)
        $pluralLabels = [
            'voilier-monocoque' => 'Voiliers Monocoques',
            'catamaran-a-voile' => 'Catamarans à voile',
            'catamaran-a-moteur' => 'Catamarans à moteur',
            'bateau-moteur' => 'Bateaux à moteur',
            'trimaran' => 'Trimarans',
        ];

        // Check for type filter (by ID or slug)
        if ($request->filled('type_id')) {
            $typeIds = is_array($request->type_id) ? $request->type_id : [$request->type_id];
            if (count($typeIds) === 1) {
                $type = Type::find($typeIds[0]);
                if ($type) {
                    $pluralLabel = $pluralLabels[$type->slug] ?? $type->libelle;
                    $activeTypeFilter = (object) ['libelle' => $pluralLabel, 'slug' => $type->slug];
                }
            }
        } elseif ($request->filled('type')) {
            $typeSlugs = is_array($request->type) ? $request->type : [$request->type];
            if (count($typeSlugs) === 1) {
                $type = Type::where('slug', $typeSlugs[0])->first();
                if ($type) {
                    $pluralLabel = $pluralLabels[$type->slug] ?? $type->libelle;
                    $activeTypeFilter = (object) ['libelle' => $pluralLabel, 'slug' => $type->slug];
                }
            } elseif (count($typeSlugs) === 2) {
                // Special case for catamarans (voile + moteur)
                $cataSlugs = ['catamaran-a-voile', 'catamaran-a-moteur'];
                if (empty(array_diff($typeSlugs, $cataSlugs)) && empty(array_diff($cataSlugs, $typeSlugs))) {
                    $activeTypeFilter = (object) ['libelle' => 'Catamarans'];
                }
            }
        }

        // Check for zone filter (by ID or slug)
        if ($request->filled('zone_id')) {
            $zoneIds = is_array($request->zone_id) ? $request->zone_id : [$request->zone_id];
            if (count($zoneIds) === 1) {
                $activeZoneFilter = Zone::find($zoneIds[0]);
            }
        } elseif ($request->filled('zone')) {
            $zoneSlugs = is_array($request->zone) ? $request->zone : [$request->zone];
            if (count($zoneSlugs) === 1) {
                $activeZoneFilter = Zone::where('slug', $zoneSlugs[0])->first();
            }
        }

        return view('bateaux.index', compact(
            'bateaux',
            'types',
            'zones',
            'totalCount',
            'activeTypeFilter',
            'activeZoneFilter'
        ));
    }

    /**
     * Display the specified boat details
     */
    public function show(Request $request, string $slug): View|Response
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
        ->first();

        // If boat not found or not visible, show "sold" page
        if (!$bateau) {
            // Get some featured boats to suggest
            $suggestedBoats = Bateau::with(['type', 'zone', 'images'])
                ->visible()
                ->inRandomOrder()
                ->limit(4)
                ->get();

            return response()->view('bateaux.sold', compact('suggestedBoats', 'slug'), 410);
        }

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
