<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Super Admin (Akses penuh ke semua fitur, termasuk manajemen user)
        if (!User::where('username', 'SuperAdmin')->exists()) {
            User::create([
                'name' => 'Super Admin',
                'username' => 'SuperAdmin',
                'email' => 'superadmin@sekolah.com',
                'password' => Hash::make('@bangapihh123'), // ⚠️ CATATAN: Ganti password ini setelah login pertama!
                'role' => 'super_admin',
            ]);
        }

        // 2. Buat Admin Standar (Akses ke konten, tapi tidak bisa mengelola user lain)
        if (!User::where('username', 'AdminSekolah')->exists()) {
            User::create([
                'name' => 'Admin Sekolah',
                'username' => 'AdminSekolah',
                'email' => 'admin@sekolah.com',
                'password' => Hash::make('@bangapihh123'), // ⚠️ CATATAN: Ganti password ini setelah login pertama!
                'role' => 'admin',
            ]);
        }
    }
}