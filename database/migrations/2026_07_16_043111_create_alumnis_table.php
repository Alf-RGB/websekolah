<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->year('tahun_lulus');
            $table->string('jurusan')->nullable(); // Jurusan waktu di sekolah
            $table->string('email');
            $table->string('no_hp');
            $table->string('status_sekarang'); // Contoh: Kuliah, Kerja, Wirausaha
            $table->string('nama_instansi')->nullable(); // Nama Kampus/Perusahaan
            $table->string('jabatan')->nullable(); // Contoh: Mahasiswa / Staff IT
            $table->string('foto')->nullable(); // Foto alumni
            $table->text('testimoni')->nullable(); // Pesan untuk adik kelas
            $table->boolean('is_featured')->default(false); // Pilihan Admin: Tampilkan di website atau tidak
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};