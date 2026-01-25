<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BateauController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TypeController as AdminTypeController;
use App\Http\Controllers\Admin\ZoneController as AdminZoneController;
use App\Http\Controllers\Admin\ActionController as AdminActionController;
use App\Http\Controllers\Admin\BateauController as AdminBateauController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Routes multilingues (public)
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    // Home page
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Bateaux routes
    Route::get(LaravelLocalization::transRoute('routes.bateaux'), [BateauController::class, 'index'])->name('bateaux.index');
    Route::get(LaravelLocalization::transRoute('routes.bateaux') . '/{slug}', [BateauController::class, 'show'])->name('bateaux.show');

    // Categories page
    Route::get(LaravelLocalization::transRoute('routes.categories'), function () {
        $types = \App\Models\Type::withCount(['bateaux' => function ($query) {
            $query->visible();
        }])->get();
        return view('categories', compact('types'));
    })->name('categories');

    // Contact form
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

    // Pages statiques
    Route::get(LaravelLocalization::transRoute('routes.about'), [PageController::class, 'about'])->name('about');
    Route::get(LaravelLocalization::transRoute('routes.contact'), [PageController::class, 'contact'])->name('contact');
    Route::get(LaravelLocalization::transRoute('routes.sell'), [PageController::class, 'sell'])->name('sell');
    Route::get(LaravelLocalization::transRoute('routes.partners'), [PartnerController::class, 'index'])->name('partners');
    Route::get(LaravelLocalization::transRoute('routes.legal'), [PageController::class, 'mentionsLegales'])->name('mentions-legales');
    Route::get(LaravelLocalization::transRoute('routes.terms'), [PageController::class, 'cgv'])->name('cgv');
    Route::get(LaravelLocalization::transRoute('routes.privacy'), [PageController::class, 'confidentialite'])->name('confidentialite');

    // Articles (blog)
    Route::get(LaravelLocalization::transRoute('routes.articles'), [ArticleController::class, 'index'])->name('articles.index');
    Route::get(LaravelLocalization::transRoute('routes.articles') . '/{slug}', [ArticleController::class, 'show'])->name('articles.show');

    // Demo Design Page (Test)
    Route::get('/demo-design', function () {
        // Get featured boats
        $featuredBateaux = \App\Models\Bateau::with(['type', 'zone', 'slogan', 'images'])
            ->visible()
            ->where('featured', true)
            ->orderBy('published_at', 'desc')
            ->limit(4)
            ->get();

        // Get all types with boat count
        $types = \App\Models\Type::withCount(['bateaux' => function ($query) {
            $query->visible();
        }])->get();

        // Get all zones
        $zones = \App\Models\Zone::all();

        // Get statistics
        $stats = [
            'total_bateaux' => \App\Models\Bateau::visible()->count(),
            'total_types' => \App\Models\Type::has('bateaux')->count(),
            'total_zones' => \App\Models\Zone::has('bateaux')->count(),
        ];

        return view('demo-design', compact('featuredBateaux', 'types', 'zones', 'stats'));
    })->name('demo-design');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin routes (protected by auth middleware)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Types CRUD
    Route::resource('types', AdminTypeController::class);

    // Zones CRUD
    Route::resource('zones', AdminZoneController::class);

    // Actions (slogans) CRUD
    Route::resource('actions', AdminActionController::class);

    // Bateaux CRUD
    Route::resource('bateaux', AdminBateauController::class)->parameters([
        'bateaux' => 'bateau'
    ]);

    // Toggle featured status
    Route::post('/bateaux/{bateau}/toggle-featured', [AdminBateauController::class, 'toggleFeatured'])->name('bateaux.toggle-featured');

    // Media management
    Route::delete('/media/bulk-delete', [AdminBateauController::class, 'bulkDeleteMedia'])->name('media.bulk-delete');
    Route::delete('/media/{media}', [AdminBateauController::class, 'deleteMedia'])->name('media.delete');
    Route::patch('/media/{media}/set-main', [AdminBateauController::class, 'setMainMedia'])->name('media.set-main');

    // Equipment quick create
    Route::post('/equipements/quick-create', [AdminBateauController::class, 'quickCreateEquipement'])->name('equipements.quick-create');

    // Articles CRUD
    Route::resource('articles', AdminArticleController::class);
    Route::delete('/articles/{article}/remove-featured-image', [AdminArticleController::class, 'removeFeaturedImage'])->name('articles.remove-featured-image');
    Route::post('/articles/upload-image', [AdminArticleController::class, 'uploadImage'])->name('articles.upload-image');

    // Settings
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    Route::put('/settings/password', [\App\Http\Controllers\Admin\SettingController::class, 'updatePassword'])->name('settings.password.update');
});

// ==========================================
// REDIRECTIONS 301 - Migration Symfony -> Laravel
// IMPORTANT: Charger APRÈS les routes multilingues pour éviter les conflits
// ==========================================
require __DIR__ . '/redirects.php';
