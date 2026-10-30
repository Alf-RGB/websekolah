<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftar; // <-- TAMBAHKAN INI (Best Practice)

class PendaftarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // MENGGUNAKAN ELOQUENT MODEL (Pendaftar::create)
        // Ini otomatis menangani timestamps dan $casts (nisn jadi string agar 0 di depan tidak hilang)

        Pendaftar::create([
            'kode_tracking' => 'TRK-S-' . date('Ymd') . '-DUM1', // <-- WAJIB: Kode tracking dummy
            'nama_lengkap' => 'Budi Santoso',
            'nisn' => '0012345678', // Berkat $casts di Model, angka 0 di depan TIDAK akan hilang
            'asal_sekolah' => 'SMP N 1 Medan',
            'alamat' => 'Jl. Gatot Subroto No. 10, Medan',
            'no_hp' => '081234567890',
            'nama_ortu' => 'Agus Santoso',
            'alasan' => 'Ingin melanjutkan pendidikan di sekolah yang berkualitas.',
            'status' => 'Menunggu',
        ]);

        Pendaftar::create([
            'kode_tracking' => 'TRK-S-' . date('Ymd') . '-DUM2', // <-- WAJIB: Kode tracking dummy
            'nama_lengkap' => 'Siti Aminah',
            'nisn' => '0087654321',
            'asal_sekolah' => 'MTs N 2 Medan',
            'alamat' => 'Jl. Sisingamangaraja No. 5, Medan',
            'no_hp' => '089876543210',
            'nama_ortu' => 'Rahmat Hidayat',
            'alasan' => 'Tertarik dengan program keahlian yang ditawarkan.',
            'status' => 'Diterima',
        ]);
    }
}