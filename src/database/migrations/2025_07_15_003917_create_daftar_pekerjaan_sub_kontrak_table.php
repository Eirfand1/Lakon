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
        Schema::create('daftar_pekerjaan_sub_kontrak', function (Blueprint $table) {
            $table->id('daftar_pekerjaan_sub_kontrak_id');
            $table->foreignId('kontrak_id')
                ->constrained('kontrak', 'kontrak_id')
                ->cascadeOnDelete();
            $table->string('bagian_pekerjaan');
            $table->string('nama_sub_penyedia');
            $table->string('alamat_sub_penyedia');
            $table->string('kualifikasi_sub_penyedia');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_pekerjaan_sub_kontrak');
    }
};
