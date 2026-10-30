<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil SEMUA seeder secara berurutan
        $this->call([
            SuperAdminSeeder::class,   // 1. Wajib paling awal agar ada akun untuk login
            SettingsSeeder::class,     // 2. Data identitas sekolah
            MenusSeeder::class,        // 3. Data menu navigasi
            PagesSeeder::class,        // 4. Data halaman statis (Profil, Visi Misi, dll)
            PostsSeeder::class,        // 5. Data berita/artikel
            GalleriesSeeder::class,    // 6. Data galeri kegiatan
            PendaftarSeeder::class,    // 7. Data dummy pendaftar (opsional, untuk testing)
        ]);
    }
}