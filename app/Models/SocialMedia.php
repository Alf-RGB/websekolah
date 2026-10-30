<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    // TAMBAHKAN BARIS INI AGAR TIDAK ERROR PLURALIZATION
    protected $table = 'social_medias';

    protected $fillable = [
        'platform',
        'name',
        'url',
        'icon',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}