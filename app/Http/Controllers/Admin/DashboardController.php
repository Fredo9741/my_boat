<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bateau;
use App\Models\Type;
use App\Models\Zone;
use App\Models\Action;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_bateaux' => Bateau::count(),
            'bateaux_visibles' => Bateau::where('visible', true)->count(),
            'total_types' => Type::count(),
            'total_zones' => Zone::count(),
            'total_actions' => Action::count(),
            'valeur_totale' => Bateau::sum('prix'),
        ];

        $recentBateaux = Bateau::with(['type', 'zone'])
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBateaux'));
    }
}
