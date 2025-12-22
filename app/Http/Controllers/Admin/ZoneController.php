<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ZoneController extends Controller
{
    public function index()
    {
        $zones = Zone::withCount('bateaux')->orderBy('libelle')->get();
        return view('admin.zones.index', compact('zones'));
    }

    public function create()
    {
        return view('admin.zones.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:100|unique:zones,libelle',
        ]);

        $validated['slug'] = Str::slug($validated['libelle']);

        Zone::create($validated);

        return redirect()->route('admin.zones.index')
            ->with('success', 'Zone géographique créée avec succès.');
    }

    public function edit(Zone $zone)
    {
        return view('admin.zones.edit', compact('zone'));
    }

    public function update(Request $request, Zone $zone)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:100|unique:zones,libelle,' . $zone->id,
        ]);

        $validated['slug'] = Str::slug($validated['libelle']);

        $zone->update($validated);

        return redirect()->route('admin.zones.index')
            ->with('success', 'Zone géographique modifiée avec succès.');
    }

    public function destroy(Zone $zone)
    {
        $zone->delete();

        return redirect()->route('admin.zones.index')
            ->with('success', 'Zone géographique supprimée avec succès.');
    }
}
