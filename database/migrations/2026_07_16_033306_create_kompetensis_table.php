<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kompetensis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jurusan'); // Contoh: Rekayasa Perangkat Lunak (RPL)
            $table->string('slug')->unique(); // Untuk URL yang rapi (contoh: rpl)
            $table->string('singkatan')->nullable(); // Contoh: RPL, TKJ
            $table->text('deskripsi')->nullable(); // Penjelasan jurusan
            $table->text('prospek_karir')->nullable(); // Lulusan bisa kerja jadi apa
            $table->string('icon')->nullable(); // Nama file gambar/icon jurusan
            $table->integer('urutan')->default(0); // Untuk mengatur tampilan di depan
            $table->boolean('is_active')->default(true); // Aktif/Nonaktifkan jurusan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kompetensis');
    }
};