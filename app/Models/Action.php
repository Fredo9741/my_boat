<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Action extends Model
{
    protected $table = 'actions';

    protected $fillable = [
        'libelle',
        'slug',
        'color',
    ];

    /**
     * Get all bateaux with this slogan/action
     */
    public function bateaux(): HasMany
    {
        return $this->hasMany(Bateau::class, 'slogan_id');
    }
}
