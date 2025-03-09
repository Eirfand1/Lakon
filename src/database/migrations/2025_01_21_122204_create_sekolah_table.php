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
        Schema::create('sekolah', function (Blueprint $table) {
            $table->id('sekolah_id');
            $table->char('npsn', 8)->unique();
            $table->string('nama_sekolah', 150);
            $table->enum('jenjang', ['SD', 'SMP', 'PAUD'])->nullable(); 
            $table->string('status'); 
            $table->string('kepala_sekolah');
            $table->integer('nip_kepala_sekolah');
            $table->string('alamat', 255); 
            $table->string('desa', 100); 
            $table->string('kecamatan', 100); 
            $table->point('koordinat')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolah');
    }
};
