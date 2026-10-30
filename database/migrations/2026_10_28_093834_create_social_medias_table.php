<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('social_medias', function (Blueprint $table) {
            $table->id();
            $table->string('platform'); // facebook, instagram, youtube, tiktok, twitter
            $table->string('name'); // Nama platform (Facebook, Instagram, dll)
            $table->string('url'); // URL lengkap
            $table->string('icon')->nullable(); // Icon class atau emoji
            $table->integer('order')->default(0); // Urutan tampilan
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_medias');
    }
};