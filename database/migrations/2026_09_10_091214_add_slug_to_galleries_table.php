<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Gallery;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('judul');
        });

        // Generate slug untuk data yang sudah ada
        Gallery::whereNull('slug')->orWhere('slug', '')->get()->each(function ($gallery) {
            $gallery->slug = Str::slug($gallery->judul);
            $gallery->save();
        });
    }

    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};