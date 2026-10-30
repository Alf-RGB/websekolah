<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('pendaftar', function (Blueprint $table) {
        $table->id();
        $table->string('nama_lengkap');
        $table->string('nisn')->unique();
        $table->string('asal_sekolah');
        $table->text('alamat');
        $table->string('no_hp');
        $table->string('nama_ortu');
        $table->string('status')->default('Menunggu'); // Nanti bisa diubah jadi Diterima/Ditolak
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftar');
    }
};
