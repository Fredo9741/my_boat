<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActionController extends Controller
{
    public function index()
    {
        $actions = Action::withCount('bateaux')->orderBy('libelle')->get();
        return view('admin.actions.index', compact('actions'));
    }

    public function create()
    {
        return view('admin.actions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:100|unique:actions,libelle',
            'color' => 'required|string|in:red,green,yellow,blue,purple,pink,orange,gray',
        ]);

        $validated['slug'] = Str::slug($validated['libelle']);

        Action::create($validated);

        return redirect()->route('admin.actions.index')
            ->with('success', 'Badge promotionnel créé avec succès.');
    }

    public function edit(Action $action)
    {
        return view('admin.actions.edit', compact('action'));
    }

    public function update(Request $request, Action $action)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:100|unique:actions,libelle,' . $action->id,
            'color' => 'required|string|in:red,green,yellow,blue,purple,pink,orange,gray',
        ]);

        $validated['slug'] = Str::slug($validated['libelle']);

        $action->update($validated);

        return redirect()->route('admin.actions.index')
            ->with('success', 'Badge promotionnel modifié avec succès.');
    }

    public function destroy(Action $action)
    {
        $action->delete();

        return redirect()->route('admin.actions.index')
            ->with('success', 'Badge promotionnel supprimé avec succès.');
    }
}
