<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post; // <-- TAMBAHKAN INI (Best Practice)

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // MENGGUNAKAN ELOQUENT MODEL (Post::create)
        // Ini otomatis menangani timestamps (created_at/updated_at) 
        // dan menghormati $fillable di Model Post

        Post::create([
            'judul' => 'Pendaftaran Siswa Baru Tahun Ajaran 2026/2027 Dibuka!',
            'slug' => 'ppdb-2026-2027-dibuka',
            'konten' => 'Kami informasikan bahwa pendaftaran peserta didik baru untuk tahun ajaran 2026/2027 telah resmi dibuka. Segera daftarkan putra-putri Anda sebelum kuota terpenuhi. Untuk informasi lebih lanjut, silakan hubungi bagian administrasi sekolah.',
            'thumbnail' => null,
            'kategori' => 'pengumuman',
        ]);

        Post::create([
            'judul' => 'Siswa Kami Meraih Juara 1 Olimpiade Matematika Nasional',
            'slug' => 'juara-1-olimpiade-matematika',
            'konten' => 'Dengan bangga kami sampaikan bahwa siswa kami, Ahmad Fauzi dari kelas XI IPA 1, berhasil meraih Juara 1 dalam Olimpiade Matematika Nasional 2026 yang diselenggarakan di Jakarta. Prestasi ini membuktikan kualitas pendidikan di sekolah kami.',
            'thumbnail' => null,
            'kategori' => 'berita',
        ]);

        Post::create([
            'judul' => 'Kegiatan Pentas Seni Akhir Tahun 2026',
            'slug' => 'pentas-seni-akhir-tahun-2026',
            'konten' => 'Dalam rangka memeriahkan akhir tahun ajaran 2025/2026, sekolah akan mengadakan Pentas Seni pada tanggal 25 Juli 2026. Semua siswa diharapkan berpartisipasi aktif. Pendaftaran peserta dapat dilakukan melalui wali kelas masing-masing.',
            'thumbnail' => null,
            'kategori' => 'kegiatan',
        ]);
    }
}