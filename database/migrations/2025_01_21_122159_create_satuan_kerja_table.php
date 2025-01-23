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
        Schema::create('satuan_kerja', function (Blueprint $table) {
            $table->id('satker_id');
            $table->string('nip');
            $table->string('nama_pimpinan');
            $table->string('jabatan');
            $table->string('website');
            $table->string('email');
            $table->string('telp');
            $table->string('klpd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satuan_kerja');
    }
};
