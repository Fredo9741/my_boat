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
}
