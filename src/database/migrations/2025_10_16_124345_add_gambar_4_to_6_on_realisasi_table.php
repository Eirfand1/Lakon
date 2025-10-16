<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('realisasi', function (Blueprint $table) {
            $table->string('gambar4')->nullable()->after('gambar3');
            $table->string('gambar5')->nullable()->after('gambar4');
            $table->string('gambar6')->nullable()->after('gambar5');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('realisasi', function (Blueprint $table) {
            $table->dropColumn('gambar4');
            $table->dropColumn('gambar5');
            $table->dropColumn('gambar6');
        });
    }
};
