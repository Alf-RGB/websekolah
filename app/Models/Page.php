<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'is_published',
        'foto', // ✅ PENTING: TAMBAHKAN INI!
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}