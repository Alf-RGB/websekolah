<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page; // <-- TAMBAHKAN INI (Best Practice)

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // MENGGUNAKAN ELOQUENT MODEL (Page::create)
        // Ini otomatis menangani timestamps (created_at/updated_at) 
        // dan menerapkan $casts (is_published jadi boolean)

        Page::create([
            'judul' => 'Sejarah Sekolah',
            'slug' => 'sejarah-sekolah',
            'konten' => 'Sekolah kita didirikan pada tahun 1980 oleh para tokoh masyarakat yang peduli dengan pendidikan. Berawal dari sebuah gedung sederhana dengan 3 ruang kelas, kini sekolah kita telah berkembang menjadi salah satu institusi pendidikan terdepan di daerah ini, dilengkapi dengan fasilitas modern dan tenaga pengajar yang profesional.',
            'is_published' => true,
        ]);

        Page::create([
            'judul' => 'Visi dan Misi',
            'slug' => 'visi-dan-misi',
            'konten' => '<strong>VISI:</strong><br>Menjadi sekolah unggulan yang melahirkan generasi cerdas, berkarakter, dan berdaya saing global.<br><br><strong>MISI:</strong><br>1. Menyelenggarakan pendidikan yang berkualitas dan inovatif.<br>2. Menanamkan nilai-nilai karakter dan akhlak mulia.<br>3. Mengembangkan potensi siswa di bidang akademik dan non-akademik.',
            'is_published' => true,
        ]);

        Page::create([
            'judul' => 'Sambutan Kepala Sekolah',
            'slug' => 'sambutan-kepala-sekolah',
            'konten' => 'Assalamu\'alaikum Wr. Wb. Selamat datang di website resmi sekolah kita. Website ini merupakan media informasi dan komunikasi antara sekolah dengan masyarakat. Melalui website ini, kami berharap dapat memberikan layanan informasi yang transparan dan akuntabel.',
            'is_published' => true,
        ]);
    }
}