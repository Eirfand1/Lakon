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
        Schema::create('penyedia', function (Blueprint $table) {
            $table->id('penyedia_id'); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['konsultan','biasa'])->default(null)->nullable();
            $table->char('NIK', 16); 
            $table->string('nama_pemilik', 100); 
            $table->string('alamat_pemilik', 255); 
            $table->string('nama_perusahaan_lengkap', 150); 
            $table->string('nama_perusahaan_singkat', 100)->nullable();
            $table->string('akta_notaris_no', 50); 
            $table->string('akta_notaris_nama', 100); 
            $table->date('akta_notaris_tanggal'); 
            $table->string('alamat_perusahaan', 255); 
            $table->string('kontak_hp', 15); 
            $table->string('kontak_email', 100)->unique(); 
            $table->string('rekening_norek', 30); 
            $table->string('rekening_nama', 100); 
            $table->string('rekening_bank', 50); 
            $table->string('npwp_perusahaan', 20); 
            $table->string('logo_perusahaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyedia');
    }
};
