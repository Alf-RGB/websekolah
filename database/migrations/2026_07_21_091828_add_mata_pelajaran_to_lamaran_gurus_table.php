<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lamaran_gurus', function (Blueprint $table) {
            if (!Schema::hasColumn('lamaran_gurus', 'mata_pelajaran')) {
                $table->string('mata_pelajaran')->nullable()->after('jurusan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('lamaran_gurus', function (Blueprint $table) {
            $table->dropColumn('mata_pelajaran');
        });
    }
};