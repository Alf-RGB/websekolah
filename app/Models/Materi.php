<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    // Field yang boleh diisi secara massal (Udah pas banget sama controller!)
    protected $fillable = [
        'guru_id', 
        'judul', 
        'deskripsi', 
        'file_path'
    ];

    // OPTIMASI: Casting tipe data
    // Memastikan guru_id selalu dianggap sebagai angka (integer)
    protected $casts = [
        'guru_id' => 'integer',
    ];

    // Relasi: Satu Materi dimiliki oleh satu Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}