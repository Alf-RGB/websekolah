<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    // Field yang boleh diisi secara massal (sudah sangat tepat!)
    protected $fillable = [
        'judul', 
        'slug', 
        'deskripsi', 
        'gambar', 
        'kategori', 
        'urutan', 
        'is_active'
    ];

    // OPTIMASI: Casting tipe data (Best Practice Laravel)
    // Ini membuat 'is_active' otomatis jadi true/false (boolean) 
    // dan 'urutan' otomatis jadi angka (integer) saat diambil dari database.
    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];
}