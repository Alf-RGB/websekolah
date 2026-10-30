<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            // Hubungkan materi dengan guru (Foreign Key)
            $table->foreignId('guru_id')->constrained('gurus')->onDelete('cascade');
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('file_path'); // Untuk menyimpan nama file PDF
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materis');
    }
};