<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Bateau;
use App\Models\Type;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the home page with featured boats
     */
    public function index(): \Illuminate\Http\Response
    {
        // Données stables cachées 10 minutes (types, zones, stats)
        $staticData = Cache::remember('homepage_static', 600, function () {
            return [
                'stats' => [
                    'total_bateaux' => Bateau::visible()->count(),
                    'total_types'   => Type::has('bateaux')->count(),
                    'total_zones'   => Zone::has('bateaux')->count(),
                ],
                'types' => Type::all(),
                'zones' => Zone::all(),
            ];
        });

        // Annonces cachées 5 minutes
        $boatsData = Cache::remember('homepage_boats', 300, function () {
            $featuredBateaux = Bateau::with(['type', 'zone', 'slogan', 'images'])
                ->visible()
                ->where('featured', true)
                ->orderBy('published_at', 'desc')
                ->limit(4)
                ->get();

            if ($featuredBateaux->count() < 4) {
                $additional = Bateau::with(['type', 'zone', 'slogan', 'images'])
                    ->visible()
                    ->where('featured', false)
                    ->orderBy('published_at', 'desc')
                    ->limit(4 - $featuredBateaux->count())
                    ->get();
                $featuredBateaux = $featuredBateaux->merge($additional);
            }

            $recentBateaux = Bateau::with(['type', 'zone', 'images'])
                ->visible()
                ->orderBy('published_at', 'desc')
                ->limit(8)
                ->get();

            // inRandomOrder() = ORDER BY RAND() = full table scan, remplacé par latest
            $premiumBateaux = Bateau::with(['type', 'zone', 'slogan', 'images'])
                ->visible()
                ->whereNotNull('slogan_id')
                ->orderBy('published_at', 'desc')
                ->limit(6)
                ->get();

            $latestArticles = Article::published()
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();

            return compact('featuredBateaux', 'recentBateaux', 'premiumBateaux', 'latestArticles');
        });

        return response()
            ->view('welcome', array_merge($staticData, $boatsData))
            ->header('Cache-Control', 'public, s-maxage=120, stale-while-revalidate=60')
            ->header('Vary', 'Accept-Language');
    }
}
