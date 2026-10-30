<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kompetensis', function (Blueprint $table) {
            // Cek dulu apakah kolom sudah ada
            if (!Schema::hasColumn('kompetensis', 'status')) {
                $table->string('status')->default('aktif')->after('prospek_karir');
            }
        });
    }

    public function down()
    {
        Schema::table('kompetensis', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};