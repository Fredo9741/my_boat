<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::withCount('bateaux')->orderBy('libelle')->get();
        return view('admin.types.index', compact('types'));
    }

    public function create()
    {
        return view('admin.types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:100|unique:types,libelle',
            'icone' => 'nullable|string|max:50',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
        ]);

        $validated['slug'] = Str::slug($validated['libelle']);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('types', 'public');
            $validated['photo'] = $path;
        }

        Type::create($validated);

        return redirect()->route('admin.types.index')
            ->with('success', 'Type de bateau créé avec succès.');
    }

    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    public function update(Request $request, Type $type)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:100|unique:types,libelle,' . $type->id,
            'icone' => 'nullable|string|max:50',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
        ]);

        $validated['slug'] = Str::slug($validated['libelle']);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($type->photo && \Storage::disk('public')->exists($type->photo)) {
                \Storage::disk('public')->delete($type->photo);
            }

            $path = $request->file('photo')->store('types', 'public');
            $validated['photo'] = $path;
        }

        $type->update($validated);

        return redirect()->route('admin.types.index')
            ->with('success', 'Type de bateau modifié avec succès.');
    }

    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.types.index')
            ->with('success', 'Type de bateau supprimé avec succès.');
    }
}
