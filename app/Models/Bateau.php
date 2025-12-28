<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Bateau extends Model
{
    use SoftDeletes;

    protected $table = 'bateaux';

    protected $fillable = [
        'visible',
        'published_at',
        'featured',
        'occasion',
        'zone_id',
        'type_id',
        'slogan_id',
        'modele',
        'slug',
        'prix',
        'afficher_prix',
        'description',
        'symboles',
        'mots',
        'chantier',
        'architecte',
        'pavillon',
        'annee',
        'materiaux',
        'longueurht',
        'largeur',
        'tirantdeau',
        'poidslegeencharges',
        'surfaceaupres',
        'heuresmoteur',
        'puissance',
        'nombre_moteurs',
        'moteur',
        'systemeantiderive',
        'cabines',
        'passagers',
    ];

    protected $casts = [
        'visible' => 'boolean',
        'featured' => 'boolean',
        'published_at' => 'datetime',
        'occasion' => 'boolean',
        'afficher_prix' => 'boolean',
        'prix' => 'decimal:2',
        'annee' => 'integer',
        'longueurht' => 'decimal:2',
        'largeur' => 'decimal:2',
        'tirantdeau' => 'decimal:2',
        'poidslegeencharges' => 'decimal:2',
        'surfaceaupres' => 'decimal:2',
        'heuresmoteur' => 'integer',
        'puissance' => 'integer',
        'nombre_moteurs' => 'integer',
        'cabines' => 'integer',
        'passagers' => 'integer',
    ];

    /**
     * Get the type that owns the bateau
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    /**
     * Get the zone that owns the bateau
     */
    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    /**
     * Get all zones for this bateau (many-to-many)
     */
    public function zones(): BelongsToMany
    {
        return $this->belongsToMany(Zone::class, 'bateau_zone');
    }

    /**
     * Get the slogan/action that owns the bateau
     */
    public function slogan(): BelongsTo
    {
        return $this->belongsTo(Action::class, 'slogan_id');
    }

    /**
     * Get all medias for this bateau
     */
    public function medias(): HasMany
    {
        return $this->hasMany(Media::class, 'bateau_id')->orderBy('ordre');
    }

    /**
     * Get only image medias
     */
    public function images(): HasMany
    {
        return $this->hasMany(Media::class, 'bateau_id')
            ->where('type', 'image')
            ->orderBy('ordre');
    }

    /**
     * Get only video medias
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Media::class, 'bateau_id')
            ->where('type', 'video')
            ->orderBy('ordre');
    }

    /**
     * Get all equipements for this bateau
     */
    public function equipements(): BelongsToMany
    {
        return $this->belongsToMany(Equipement::class, 'bateau_equipement');
    }

    /**
     * Get the first/main image
     */
    public function getMainImageAttribute(): ?string
    {
        $firstImage = $this->images()->first();
        return $firstImage ? $firstImage->url : 'https://placehold.co/800x600/cccccc/666666?text=No+Image';
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute(): string
    {
        if (!$this->afficher_prix) {
            return 'Prix sur demande';
        }
        return number_format($this->prix, 0, ',', ' ') . ' €';
    }

    /**
     * Get full location string
     */
    public function getLocationAttribute(): string
    {
        return $this->zone ? $this->zone->libelle : 'Non spécifié';
    }

    /**
     * Get formatted length
     */
    public function getLengthAttribute(): string
    {
        return $this->longueurht ? $this->longueurht . 'm' : 'N/A';
    }

    /**
     * Get badge info for display
     */
    public function getBadgeAttribute(): ?array
    {
        if (!$this->slogan) {
            return null;
        }

        // Use the color from the Action model
        return [
            'label' => $this->slogan->libelle,
            'color' => $this->slogan->color ?? 'green'
        ];
    }

    /**
     * Scope for visible bateaux
     */
    public function scopeVisible($query)
    {
        return $query->where('visible', true);
    }

    /**
     * Scope for occasion bateaux
     */
    public function scopeOccasion($query)
    {
        return $query->where('occasion', true);
    }

    /**
     * Scope for neuf (new) bateaux
     */
    public function scopeNeuf($query)
    {
        return $query->where('occasion', false);
    }

    /**
     * Scope for filtering by type
     */
    public function scopeOfType($query, $typeId)
    {
        return $query->where('type_id', $typeId);
    }

    /**
     * Scope for filtering by zone
     */
    public function scopeInZone($query, $zoneId)
    {
        return $query->where('zone_id', $zoneId);
    }

    /**
     * Scope for filtering by price range
     */
    public function scopePriceBetween($query, $min, $max)
    {
        return $query->whereBetween('prix', [$min, $max]);
    }

    /**
     * Scope for filtering by year range
     */
    public function scopeYearBetween($query, $min, $max)
    {
        return $query->whereBetween('annee', [$min, $max]);
    }

    /**
     * Scope for search
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('modele', 'like', "%{$term}%")
              ->orWhere('description', 'like', "%{$term}%")
              ->orWhere('chantier', 'like', "%{$term}%")
              ->orWhere('mots', 'like', "%{$term}%");
        });
    }
}
