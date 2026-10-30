<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lamaran_gurus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('no_hp');
            $table->string('pendidikan_terakhir');
            $table->string('jurusan');
            $table->string('mata_pelajaran_diinginkan');
            $table->text('pengalaman_mengajar')->nullable();
            $table->text('alasan_melamar');
            $table->string('file_cv')->nullable(); // Untuk upload CV (PDF)
            $table->enum('status', ['pending', 'diproses', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lamaran_gurus');
    }
};