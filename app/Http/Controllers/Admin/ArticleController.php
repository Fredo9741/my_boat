<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
            'status' => 'required|in:draft,published',
        ]);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $disk = config('filesystems.default');
            $path = $file->storeAs('articles/featured', $filename, $disk);
            $validated['featured_image'] = $path;
        }

        // Set user and published_at
        $validated['user_id'] = Auth::id();
        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article créé avec succès.');
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:articles,slug,' . $article->id,
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
            'status' => 'required|in:draft,published',
        ]);

        // Handle featured image upload
        $disk = config('filesystems.default');
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($article->featured_image) {
                Storage::disk($disk)->delete($article->featured_image);
            }

            $file = $request->file('featured_image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('articles/featured', $filename, $disk);
            $validated['featured_image'] = $path;
        }

        // Handle published_at
        if ($validated['status'] === 'published' && !$article->published_at) {
            $validated['published_at'] = now();
        } elseif ($validated['status'] === 'draft') {
            $validated['published_at'] = null;
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article modifié avec succès.');
    }

    public function destroy(Article $article)
    {
        // Delete featured image from storage
        $disk = config('filesystems.default');
        if ($article->featured_image) {
            Storage::disk($disk)->delete($article->featured_image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article supprimé avec succès.');
    }

    /**
     * Remove the featured image
     */
    public function removeFeaturedImage(Article $article)
    {
        $disk = config('filesystems.default');
        if ($article->featured_image) {
            Storage::disk($disk)->delete($article->featured_image);
            $article->update(['featured_image' => null]);
        }

        return redirect()->route('admin.articles.edit', $article)
            ->with('success', 'Image à la une supprimée.');
    }

    /**
     * Upload image from CKEditor
     * Returns JSON with URL for CKEditor
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,jpg,png,webp,gif|max:5120',
        ]);

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $disk = config('filesystems.default');
            $path = $file->storeAs('articles/content', $filename, $disk);
            $url = r2_url($path);

            // CKEditor 5 expects this response format
            return response()->json([
                'url' => $url,
            ]);
        }

        return response()->json([
            'error' => [
                'message' => 'Échec du téléchargement de l\'image.'
            ]
        ], 400);
    }
}
