<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('gurus', function (Blueprint $table) {
            // Cek dulu agar tidak error jika kolom sudah ada
            if (!Schema::hasColumn('gurus', 'is_active')) {
                $table->boolean('is_active')->default(1)->after('mata_pelajaran');
            }
        });
    }

    public function down()
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};