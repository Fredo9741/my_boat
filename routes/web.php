<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BateauController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TypeController as AdminTypeController;
use App\Http\Controllers\Admin\ZoneController as AdminZoneController;
use App\Http\Controllers\Admin\ActionController as AdminActionController;
use App\Http\Controllers\Admin\BateauController as AdminBateauController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// a supprimer apres (erreur de creation admin railway)
Route::get('/force-seed', function () {
    try {
        // Cette commande lance tes seeders
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
        return "Seeders exécutés avec succès ! <br><pre>" . \Illuminate\Support\Facades\Artisan::output() . "</pre>";
    } catch (\Exception $e) {
        return "Erreur lors du seeding : " . $e->getMessage();
    }
});
// a supprimer apres test
Route::get('/test-simple', function() {
    return view('welcome', [
        'featuredBateaux' => collect(), 'recentBateaux' => collect(), 
        'premiumBateaux' => collect(), 'stats' => [], 
        'types' => collect(), 'zones' => collect()
    ]);
});
/* Localized routes
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function() {
    // Home page
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Bateaux routes
    Route::get('/bateaux', [BateauController::class, 'index'])->name('bateaux.index');
    Route::get('/bateaux/{slug}', [BateauController::class, 'show'])->name('bateaux.show');

    // Categories page
    Route::get('/categories', function () {
        $types = \App\Models\Type::withCount(['bateaux' => function ($query) {
            $query->visible();
        }])->get();
        return view('categories', compact('types'));
    })->name('categories');

    // Contact form
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

    // Pages statiques
    Route::get('/a-propos', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::get('/vendre', [PageController::class, 'sell'])->name('sell');
    Route::get('/mentions-legales', [PageController::class, 'mentionsLegales'])->name('mentions-legales');
    Route::get('/cgv', [PageController::class, 'cgv'])->name('cgv');
    Route::get('/confidentialite', [PageController::class, 'confidentialite'])->name('confidentialite');
});
*/
// --- ROUTES EN ACCÈS DIRECT (SANS /FR) ---

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Bateaux routes
Route::get('/bateaux', [BateauController::class, 'index'])->name('bateaux.index');
Route::get('/bateaux/{slug}', [BateauController::class, 'show'])->name('bateaux.show');

// Categories page
Route::get('/categories', function () {
    $types = \App\Models\Type::withCount(['bateaux' => function ($query) {
        $query->visible();
    }])->get();
    return view('categories', compact('types'));
})->name('categories');

// Contact form
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// Pages statiques
Route::get('/a-propos', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/vendre', [PageController::class, 'sell'])->name('sell');
Route::get('/mentions-legales', [PageController::class, 'mentionsLegales'])->name('mentions-legales');
Route::get('/cgv', [PageController::class, 'cgv'])->name('cgv');
Route::get('/confidentialite', [PageController::class, 'confidentialite'])->name('confidentialite');

// --- FIN DES ROUTES EN ACCÈS DIRECT ---

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

    // Media management
    Route::delete('/media/{media}', [AdminBateauController::class, 'deleteMedia'])->name('media.delete');
    Route::patch('/media/{media}/set-main', [AdminBateauController::class, 'setMainMedia'])->name('media.set-main');

    // Settings
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});
