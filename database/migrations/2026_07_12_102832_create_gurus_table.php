<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip')->nullable(); // NIP opsional
            $table->string('mata_pelajaran');
            $table->text('bio')->nullable(); // Deskripsi singkat guru
            $table->string('foto')->nullable(); // Nama file foto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};