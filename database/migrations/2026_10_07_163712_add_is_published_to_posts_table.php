<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Cek dulu agar tidak error jika kolom sudah ada
            if (!Schema::hasColumn('posts', 'is_published')) {
                $table->boolean('is_published')->default(0)->after('kategori');
            }
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('is_published');
        });
    }
};