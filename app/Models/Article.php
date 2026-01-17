<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'featured_image',
        'status',
        'user_id',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Boot the model and add event listeners
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug from title on creating
        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = static::generateUniqueSlug($article->title);
            }
        });

        // Update slug when title changes
        static::updating(function ($article) {
            if ($article->isDirty('title') && !$article->isDirty('slug')) {
                $article->slug = static::generateUniqueSlug($article->title, $article->id);
            }
        });

        // Delete featured image from storage when article is deleted
        static::deleting(function ($article) {
            if ($article->featured_image) {
                $disk = config('filesystems.default');
                Storage::disk($disk)->delete($article->featured_image);
            }
        });
    }

    /**
     * Generate a unique slug
     */
    public static function generateUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        $query = static::where('slug', $slug);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
            $query = static::where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }

        return $slug;
    }

    /**
     * Get the author of the article
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the featured image URL
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        if (!$this->featured_image) {
            return null;
        }

        return r2_url($this->featured_image);
    }

    /**
     * Check if article is published
     */
    public function getIsPublishedAttribute(): bool
    {
        return $this->status === 'published';
    }

    /**
     * Get formatted date for display
     */
    public function getFormattedDateAttribute(): string
    {
        $date = $this->published_at ?? $this->created_at;
        return $date->format('d/m/Y');
    }

    /**
     * Get excerpt from content
     */
    public function getExcerptAttribute(): string
    {
        // First decode HTML entities, then strip tags
        $text = html_entity_decode(strip_tags($this->content), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        // Remove extra whitespace and normalize spaces
        $text = preg_replace('/\s+/', ' ', trim($text));
        return Str::limit($text, 200);
    }

    /**
     * Scope for published articles
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope for draft articles
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope for ordering by most recent
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
