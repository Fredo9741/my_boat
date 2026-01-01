<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $table = 'medias';

    protected $fillable = [
        'bateau_id',
        'type',
        'url',
        'description',
        'ordre',
        'is_youtube',
    ];

    protected $casts = [
        'ordre' => 'integer',
        'is_youtube' => 'boolean',
    ];

    /**
     * Boot the model and add event listeners
     */
    protected static function boot()
    {
        parent::boot();

        // When a media is deleted, delete the file from R2
        static::deleting(function ($media) {
            // Only delete files from R2, not YouTube videos
            if (!$media->is_youtube && $media->attributes['url']) {
                $path = $media->attributes['url'];

                // Only delete if it's a R2 path (not an external URL)
                if (!str_starts_with($path, 'http://') && !str_starts_with($path, 'https://')) {
                    try {
                        Storage::disk('cloudflare')->delete($path);
                    } catch (\Exception $e) {
                        // Log error but don't block deletion
                        \Log::warning("Failed to delete R2 file: {$path}", ['error' => $e->getMessage()]);
                    }
                }
            }
        });
    }

    /**
     * Get the bateau that owns the media
     */
    public function bateau(): BelongsTo
    {
        return $this->belongsTo(Bateau::class, 'bateau_id');
    }

    /**
     * Scope for images only
     */
    public function scopeImages($query)
    {
        return $query->where('type', 'image');
    }

    /**
     * Scope for videos only
     */
    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }

    /**
     * Get the full R2 URL for the media
     *
     * @return string
     */
    public function getUrlAttribute($value): string
    {
        // If it's a YouTube video, return the URL as is
        if ($this->is_youtube) {
            return $value;
        }

        // For images, use the r2_url helper
        return r2_url($value);
    }

    /**
     * Get YouTube video ID from URL
     *
     * @return string|null
     */
    public function getYoutubeIdAttribute(): ?string
    {
        if (!$this->is_youtube || !$this->attributes['url']) {
            return null;
        }

        $url = $this->attributes['url'];

        // Format: https://www.youtube.com/watch?v=VIDEO_ID
        if (preg_match('/[?&]v=([^&]+)/', $url, $matches)) {
            return $matches[1];
        }

        // Format: https://youtu.be/VIDEO_ID
        if (preg_match('/youtu\.be\/([^?]+)/', $url, $matches)) {
            return $matches[1];
        }

        // Format: https://www.youtube.com/embed/VIDEO_ID
        if (preg_match('/youtube\.com\/embed\/([^?]+)/', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
