<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            if (!Schema::hasColumn('posts', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('is_published');
            }
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('published_at');
        });
    }
};