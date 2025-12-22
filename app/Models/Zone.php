<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Zone extends Model
{
    protected $table = 'zones';

    protected $fillable = [
        'libelle',
        'slug',
    ];

    /**
     * Get all bateaux for this zone
     */
    public function bateaux(): HasMany
    {
        return $this->hasMany(Bateau::class, 'zone_id');
    }

    /**
     * Get count of visible bateaux
     */
    public function getBateauxCountAttribute(): int
    {
        return $this->bateaux()->where('visible', true)->count();
    }
}
