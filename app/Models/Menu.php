<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    // Field yang boleh diisi secara massal (Sudah sinkron 100% dengan MenuController)
    protected $fillable = [
        'judul_menu',
        'url',
        'parent_id',
        'urutan',
        'is_active',
    ];

    // OPTIMASI: Casting tipe data (Best Practice Laravel)
    // Memastikan data selalu dalam tipe yang benar saat diambil dari database
    protected $casts = [
        'parent_id' => 'integer',
        'urutan'    => 'integer',
        'is_active' => 'boolean',
    ];

    // ==========================================
    // RELASI ELOQUENT UNTUK MENU BERTINGKAT (DROPDOWN)
    // ==========================================
    
    /**
     * Menu ini adalah anak dari menu lain (Parent)
     */
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    /**
     * Menu ini memiliki anak-anak (Children/Sub-menu)
     * Diurutkan berdasarkan 'urutan' agar tampil rapi di dropdown
     */
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('urutan', 'asc');
    }
}