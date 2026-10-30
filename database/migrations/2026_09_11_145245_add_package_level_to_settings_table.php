   <?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;

   return new class extends Migration
   {
       public function up(): void
       {
           Schema::table('settings', function (Blueprint $table) {
               // Default 'full' agar fitur tidak hilang saat pertama kali setup
               $table->string('package_level')->default('full')->after('id'); 
           });
       }

       public function down(): void
       {
           Schema::table('settings', function (Blueprint $table) {
               $table->dropColumn('package_level');
           });
       }
   };