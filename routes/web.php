<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BateauController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TypeController as AdminTypeController;
use App\Http\Controllers\Admin\ZoneController as AdminZoneController;
use App\Http\Controllers\Admin\ActionController as AdminActionController;
use App\Http\Controllers\Admin\BateauController as AdminBateauController;
use Illuminate\Support\Facades\Route;

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
Route::get('/partenaires', [PartnerController::class, 'index'])->name('partners');
Route::get('/mentions-legales', [PageController::class, 'mentionsLegales'])->name('mentions-legales');
Route::get('/cgv', [PageController::class, 'cgv'])->name('cgv');
Route::get('/confidentialite', [PageController::class, 'confidentialite'])->name('confidentialite');

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

    // Settings
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    Route::put('/settings/password', [\App\Http\Controllers\Admin\SettingController::class, 'updatePassword'])->name('settings.password.update');
});
