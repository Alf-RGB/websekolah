<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    // Field yang boleh diisi secara massal (sudah benar semua)
    protected $fillable = [
        'nama_lengkap',
        'tahun_lulus',
        'jurusan',
        'email',
        'no_hp',
        'status_sekarang',
        'nama_instansi',
        'jabatan',
        'foto',
        'testimoni',
        'is_featured',
    ];

    // OPTIMASI: Casting tipe data
    // Ini membuat 'is_featured' otomatis jadi true/false (boolean) 
    // dan 'tahun_lulus' otomatis jadi angka (integer) saat diambil dari database.
    protected $casts = [
        'is_featured' => 'boolean',
        'tahun_lulus' => 'integer',
    ];
}