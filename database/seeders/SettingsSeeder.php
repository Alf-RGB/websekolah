<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting; // <-- TAMBAHKAN INI (Best Practice)

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // MENGGUNAKAN ELOQUENT MODEL (Setting::create)
        // Data sudah disesuaikan dengan konteks SMK Multi Karya Medan

        Setting::create([
            'key' => 'nama_sekolah',
            'value' => 'SMK Multi Karya Medan',
        ]);

        Setting::create([
            'key' => 'alamat_sekolah',
            'value' => 'Jl. Multi Karya No. 123, Medan, Sumatera Utara',
        ]);

        Setting::create([
            'key' => 'telepon_sekolah',
            'value' => '(061) 1234567',
        ]);

        Setting::create([
            'key' => 'email_sekolah',
            'value' => 'info@smkmultikaryamedan.sch.id',
        ]);

        Setting::create([
            'key' => 'nomor_whatsapp', // <-- WAJIB: Agar field WhatsApp di form settings tidak kosong
            'value' => '6281234567890',
        ]);

        Setting::create([
            'key' => 'logo_sekolah',
            'value' => 'logo-default.png',
        ]);
    }
}