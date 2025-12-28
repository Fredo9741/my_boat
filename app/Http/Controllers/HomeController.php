<?php

namespace App\Http\Controllers;

use App\Models\Bateau;
use App\Models\Type;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the home page with featured boats
     */
    public function index(): View
    {
        // Get featured boats (4 boats marked as featured by admin)
        $featuredBateaux = Bateau::with(['type', 'zone', 'slogan', 'images'])
            ->visible()
            ->where('featured', true)
            ->orderBy('published_at', 'desc')
            ->limit(4)
            ->get();

        // If less than 4 featured boats, fill with newest boats
        if ($featuredBateaux->count() < 4) {
            $additionalBateaux = Bateau::with(['type', 'zone', 'slogan', 'images'])
                ->visible()
                ->where('featured', false)
                ->orderBy('published_at', 'desc')
                ->limit(4 - $featuredBateaux->count())
                ->get();
            $featuredBateaux = $featuredBateaux->merge($additionalBateaux);
        }

        // Get recent boats
        $recentBateaux = Bateau::with(['type', 'zone', 'images'])
            ->visible()
            ->orderBy('published_at', 'desc')
            ->limit(8)
            ->get();

        // Get premium boats (with slogans)
        $premiumBateaux = Bateau::with(['type', 'zone', 'slogan', 'images'])
            ->visible()
            ->whereNotNull('slogan_id')
            ->inRandomOrder()
            ->limit(6)
            ->get();

        // Get statistics
        $stats = [
            'total_bateaux' => Bateau::visible()->count(),
            'total_types' => Type::has('bateaux')->count(),
            'total_zones' => Zone::has('bateaux')->count(),
        ];

        // Get all types for search form
        $types = Type::all();

        // Get all zones for search form
        $zones = Zone::all();

        return view('welcome', compact(
            'featuredBateaux',
            'recentBateaux',
            'premiumBateaux',
            'stats',
            'types',
            'zones'
        ));
    }
}
