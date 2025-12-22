<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    protected $table = 'types';

    protected $fillable = [
        'libelle',
        'slug',
        'photo',
        'icone',
    ];

    /**
     * Get all bateaux for this type
     */
    public function bateaux(): HasMany
    {
        return $this->hasMany(Bateau::class, 'type_id');
    }

    /**
     * Get count of visible bateaux
     */
    public function getBateauxCountAttribute(): int
    {
        return $this->bateaux()->where('visible', true)->count();
    }
}
