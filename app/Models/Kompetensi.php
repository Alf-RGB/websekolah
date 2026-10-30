<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kompetensi extends Model
{
    // Field yang boleh diisi secara massal
    protected $fillable = [
        'nama_jurusan',
        'slug',
        'singkatan',
        'deskripsi',  // Pastikan kolom ini ada di database (jika tidak, bisa dihapus)
        'prospek_karir',
        'icon',       // Pastikan kolom ini ada di database (jika tidak, bisa dihapus)
        'logo',       // <-- PENTING: Ditambahkan agar sesuai dengan upload di KompetensiController
        'urutan',
        'is_active',
    ];

    // OPTIMASI: Casting tipe data (Best Practice Laravel)
    // Ini membuat 'is_active' otomatis jadi true/false (boolean) 
    // dan 'urutan' otomatis jadi angka (integer) saat diambil dari database.
    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];
}