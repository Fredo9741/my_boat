<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index(Request $request)
    {
        // Last 20 active sessions — one row per visitor (latest page of each session)
        $recentVisits = Visit::with('boat')
            ->whereIn('id', function ($q) {
                $q->selectRaw('MAX(id)')
                  ->from('visits')
                  ->groupBy('session_id');
            })
            ->latest('created_at')
            ->limit(20)
            ->get();

        // Session journey: if a session_id is selected, show its full history
        $sessionVisits = collect();
        $selectedSession = $request->query('session');
        if ($selectedSession) {
            $sessionVisits = Visit::with('boat')
                ->where('session_id', $selectedSession)
                ->oldest('created_at')
                ->get();
        }

        // Top 10 most viewed boats (last 30 days)
        $topBoats = Visit::with('boat')
            ->whereNotNull('boat_id')
            ->where('created_at', '>=', now()->subDays(30))
            ->selectRaw('boat_id, COUNT(*) as views')
            ->groupBy('boat_id')
            ->orderByDesc('views')
            ->limit(10)
            ->get();

        // Stats totals
        $stats = [
            'today'   => Visit::whereDate('created_at', today())->count(),
            'week'    => Visit::where('created_at', '>=', now()->subDays(7))->count(),
            'month'   => Visit::where('created_at', '>=', now()->subDays(30))->count(),
            'total'   => Visit::count(),
        ];

        return view('admin.visits.index', compact(
            'recentVisits',
            'sessionVisits',
            'selectedSession',
            'topBoats',
            'stats',
        ));
    }

    public function destroy(Request $request)
    {
        $days = (int) $request->input('days', 30);
        $deleted = Visit::where('created_at', '<', now()->subDays($days))->delete();

        return back()->with('success', "{$deleted} visite(s) supprimée(s) (antérieures à {$days} jours).");
    }
}
