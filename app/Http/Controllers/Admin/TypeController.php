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
            $disk = config('filesystems.default');
            $path = $request->file('photo')->store('types', $disk);

            // Generate full URL for Cloudflare R2
            if ($disk === 'cloudflare') {
                $validated['photo'] = config('filesystems.disks.cloudflare.url') . '/' . $path;
            } else {
                $validated['photo'] = $path;
            }
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
            $disk = config('filesystems.default');

            // Delete old photo if exists
            if ($type->photo) {
                if ($disk === 'cloudflare') {
                    $cloudflareUrl = config('filesystems.disks.cloudflare.url');
                    $oldPath = str_replace($cloudflareUrl . '/', '', $type->photo);
                    if (\Storage::disk($disk)->exists($oldPath)) {
                        \Storage::disk($disk)->delete($oldPath);
                    }
                } else {
                    if (\Storage::disk($disk)->exists($type->photo)) {
                        \Storage::disk($disk)->delete($type->photo);
                    }
                }
            }

            $path = $request->file('photo')->store('types', $disk);

            // Generate full URL for Cloudflare R2
            if ($disk === 'cloudflare') {
                $validated['photo'] = config('filesystems.disks.cloudflare.url') . '/' . $path;
            } else {
                $validated['photo'] = $path;
            }
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
