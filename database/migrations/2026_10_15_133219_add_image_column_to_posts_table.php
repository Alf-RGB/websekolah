<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Menambahkan kolom image yang boleh kosong (nullable)
            $table->string('image')->nullable()->after('konten');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};