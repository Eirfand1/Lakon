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
        Schema::create('realisasi', function (Blueprint $table) {
            $table->id('realisasi_id');
            $table->foreignId('kontrak_id')
                ->constrained('kontrak', 'kontrak_id')
                ->cascadeOnDelete();
            $table->integer('bulan');
            $table->integer('tahun');
            $table->string('target');
            $table->string('realisasi');
            $table->string('gambar1');
            $table->string('gambar2');
            $table->string('gambar3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisasi');
    }
};
