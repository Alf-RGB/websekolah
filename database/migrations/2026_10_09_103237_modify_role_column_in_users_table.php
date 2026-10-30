<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ubah kolom role menjadi VARCHAR(50) agar bisa menerima 'guru'
            $table->string('role', 50)->default('user')->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kembalikan ke tipe data sebelumnya jika perlu rollback
            $table->string('role', 20)->default('user')->change();
        });
    }
};