<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'session_id',
        'ip_hash',
        'user_agent',
        'url',
        'method',
        'referer',
        'boat_id',
        'city',
        'country',
        'country_code',
        'response_time',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function boat(): BelongsTo
    {
        return $this->belongsTo(Bateau::class, 'boat_id');
    }

    /**
     * Country code → flag emoji (Unicode Regional Indicator)
     */
    public function getFlagAttribute(): string
    {
        $code = strtoupper($this->country_code ?? '');
        if (strlen($code) !== 2) {
            return '🌍';
        }
        return mb_chr(0x1F1E6 + ord($code[0]) - 65) . mb_chr(0x1F1E6 + ord($code[1]) - 65);
    }

    /**
     * Shorten URL for display
     */
    public function getShortUrlAttribute(): string
    {
        $path = parse_url($this->url, PHP_URL_PATH) ?? '';
        if ($path === '' || $path === '/') {
            $path = '/';
        }
        $query = parse_url($this->url, PHP_URL_QUERY);
        if ($query) {
            $path .= '?' . $query;
        }
        return strlen($path) > 55 ? substr($path, 0, 52) . '...' : $path;
    }
}
