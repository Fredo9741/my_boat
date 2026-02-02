<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Bateau;
use App\Models\Type;
use App\Models\Zone;
use Illuminate\Http\Response;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SitemapController extends Controller
{
    /**
     * Generate the sitemap.xml
     */
    public function index(): Response
    {
        // Get all boats (visible and non-visible for SEO continuity)
        $visibleBoats = Bateau::where('visible', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        $soldBoats = Bateau::where('visible', false)
            ->orderBy('updated_at', 'desc')
            ->get();

        // Get published articles
        $articles = Article::where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->get();

        // Get types and zones for category pages
        $types = Type::all();
        $zones = Zone::all();

        // Get supported locales
        $locales = array_keys(LaravelLocalization::getSupportedLocales());
        $defaultLocale = config('app.locale', 'fr');

        // Static pages with their routes
        $staticPages = [
            'home' => ['priority' => '1.0', 'changefreq' => 'daily'],
            'bateaux.index' => ['priority' => '0.9', 'changefreq' => 'daily'],
            'about' => ['priority' => '0.6', 'changefreq' => 'monthly'],
            'contact' => ['priority' => '0.6', 'changefreq' => 'monthly'],
            'sell' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            'partners' => ['priority' => '0.5', 'changefreq' => 'monthly'],
            'articles.index' => ['priority' => '0.7', 'changefreq' => 'weekly'],
            'categories' => ['priority' => '0.6', 'changefreq' => 'weekly'],
        ];

        $content = view('sitemap', compact(
            'visibleBoats',
            'soldBoats',
            'articles',
            'types',
            'zones',
            'locales',
            'defaultLocale',
            'staticPages'
        ))->render();

        return response($content, 200)
            ->header('Content-Type', 'text/xml; charset=utf-8');
    }
}
