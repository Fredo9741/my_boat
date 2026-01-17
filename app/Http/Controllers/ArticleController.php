<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of published articles.
     */
    public function index()
    {
        $articles = Article::published()
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        return view('articles.index', compact('articles'));
    }

    /**
     * Display the specified article.
     */
    public function show(string $slug)
    {
        $article = Article::where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Get related articles (latest 3 excluding current)
        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
