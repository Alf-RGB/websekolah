<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    // Paksa Laravel pakai nama tabel 'pendaftar' (bukan 'pendaftars')
    protected $table = 'pendaftar';
    
    // Field yang boleh diisi secara massal (Sudah lengkap & sinkron dengan controller)
    protected $fillable = [
        'kode_tracking', 
        'nama_lengkap', 
        'nisn', 
        'asal_sekolah', 
        'alamat', 
        'no_hp', 
        'nama_ortu', 
        'alasan', 
        'status'
    ];

    // OPTIMASI: Casting tipe data (Best Practice Laravel)
    // NISN sering dimulai dengan 0, jadi wajib dikunci sebagai string agar 0-nya tidak hilang
    protected $casts = [
        'nisn' => 'string',
        'status' => 'string',
    ];
}