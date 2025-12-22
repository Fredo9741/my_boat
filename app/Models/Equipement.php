<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Equipement extends Model
{
    protected $table = 'equipements';

    protected $fillable = [
        'libelle',
        'categorie',
        'icone',
        'ordre',
    ];

    /**
     * Get all bateaux with this equipement
     */
    public function bateaux(): BelongsToMany
    {
        return $this->belongsToMany(Bateau::class, 'bateau_equipement');
    }
}
