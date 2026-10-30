<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // Field yang boleh diisi secara massal (Sudah tepat!)
    protected $fillable = [
        'key',
        'value',
    ];

    // ⚠️ CATATAN PENTING TENTANG TIMESTAMPS:
    // Secara default, Laravel akan mencari kolom 'created_at' dan 'updated_at'.
    // Jika di tabel 'settings' database kamu TIDAK ADA kedua kolom tersebut,
    // HAPUS tanda komentar (//) pada baris di bawah ini agar tidak terjadi error SQL.
    
    // public $timestamps = false;
}