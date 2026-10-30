<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guru extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nama',
        'slug',
        'nip',
        'mata_pelajaran',
        'pendidikan',
        'foto',
        'username',
        'password',
        'remember_token',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     * (PASSWORD DIHAPUS DARI CASTS AGAR HASH::MAKE DI CONTROLLER BEKERJA NORMAL)
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relasi: Guru memiliki banyak materi ajar.
     */
    public function materis(): HasMany
    {
        return $this->hasMany(Materi::class, 'guru_id'); 
    }
}