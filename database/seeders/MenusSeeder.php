<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu; // <-- TAMBAHKAN INI (Best Practice)

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // MENGGUNAKAN ELOQUENT MODEL (Menu::create)
        // Ini otomatis menangani timestamps (created_at/updated_at) 
        // dan menerapkan $casts (is_active jadi boolean, urutan jadi integer)

        Menu::create([
            'judul_menu' => 'Beranda',
            'url' => '/',
            'parent_id' => null,
            'urutan' => 1,
            'is_active' => true,
        ]);

        Menu::create([
            'judul_menu' => 'Profil',
            'url' => '/profil',
            'parent_id' => null,
            'urutan' => 2,
            'is_active' => true,
        ]);

        Menu::create([
            'judul_menu' => 'Berita',
            'url' => '/berita',
            'parent_id' => null,
            'urutan' => 3,
            'is_active' => true,
        ]);

        Menu::create([
            'judul_menu' => 'Galeri',
            'url' => '/galeri',
            'parent_id' => null,
            'urutan' => 4,
            'is_active' => true,
        ]);

        Menu::create([
            'judul_menu' => 'Kontak',
            'url' => '/kontak',
            'parent_id' => null,
            'urutan' => 5,
            'is_active' => true,
        ]);
    }
}