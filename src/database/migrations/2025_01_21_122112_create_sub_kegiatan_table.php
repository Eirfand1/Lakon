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
        Schema::create('sub_kegiatan', function (Blueprint $table) {
            $table->id('sub_kegiatan_id');
            $table->string('no_rekening', 30);
            $table->string('nama_sub_kegiatan');
            $table->string('gabungan');
            $table->string('pendidikan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_kegiatan');
    }
};
