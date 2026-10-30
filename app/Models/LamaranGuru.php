<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LamaranGuru extends Model
{
    // Field yang boleh diisi secara massal
    protected $fillable = [
        'kode_tracking', 
        'nama_lengkap',
        'email',
        'no_hp',
        'pendidikan_terakhir',
        'jurusan',
        'mata_pelajaran',          // <-- PENTING: Ini yang dipakai di database & controller
        'mata_pelajaran_diinginkan', // <-- Opsional: Hapus ini jika kolom di database hanya 'mata_pelajaran'
        'pengalaman_mengajar',
        'alasan_melamar',
        'file_cv',
        'status',
    ];

    // OPTIMASI: Casting tipe data (Opsional tapi rapi)
    // Memastikan data yang diambil sesuai tipe yang diharapkan
    protected $casts = [
        'pengalaman_mengajar' => 'string',
        'alasan_melamar' => 'string',
    ];
}