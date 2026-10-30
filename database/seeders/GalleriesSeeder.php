<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GalleriesSeeder extends Seeder
{
    public function run(): void
    {
        Gallery::create([
            'judul' => 'Foto Gedung Utama',
            'deskripsi' => 'Gedung utama sekolah kami yang megah dan modern.',
            'gambar' => 'placeholder.jpg',
            'kategori' => 'fasilitas',
            'urutan' => 1,
            'is_active' => true,
        ]);

        Gallery::create([
            'judul' => 'Kegiatan Pramuka',
            'deskripsi' => 'Dokumentasi kegiatan pramuka wajib kelas 7.',
            'gambar' => 'placeholder.jpg',
            'kategori' => 'kegiatan',
            'urutan' => 2,
            'is_active' => true,
        ]);

        Gallery::create([
            'judul' => 'Juara 1 Basket',
            'deskripsi' => 'Tim basket kami saat menerima piala juara 1 antar sekolah.',
            'gambar' => 'placeholder.jpg',
            'kategori' => 'prestasi',
            'urutan' => 3,
            'is_active' => true,
        ]);
    }
}