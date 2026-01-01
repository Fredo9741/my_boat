<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
