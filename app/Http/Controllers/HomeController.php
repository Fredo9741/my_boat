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
        // Get featured boats (newest and premium)
        $featuredBateaux = Bateau::with(['type', 'zone', 'slogan', 'images'])
            ->visible()
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // Get recent boats
        $recentBateaux = Bateau::with(['type', 'zone', 'images'])
            ->visible()
            ->orderBy('created_at', 'desc')
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
