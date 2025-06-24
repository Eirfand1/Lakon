<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paket_pekerjaan', function (Blueprint $table) {
            $table->id('paket_id');
            $table->string('nomor_matrik');
            $table->string('nomor_kontrak');
            $table->integer('kode_sirup')->unique();
            $table->string('sumber_dana');
            $table->smallInteger('tahun_anggaran');
            $table->foreignId('satker_id')
                ->nullable()
                ->constrained('satuan_kerja', 'satker_id')
                ->nullOnDelete();
            $table->string('nama_pekerjaan');
            $table->date('waktu_paket');
            $table->string('metode_pemilihan');
            $table->string('jenis_pengadaan');
            $table->integer('nilai_pagu_paket');
            $table->integer('nilai_pagu_anggaran');
            $table->integer('nilai_hps');
            $table->foreignId('ppkom_id')
                ->nullable()
                ->constrained('ppkom', 'ppkom_id')
                ->nullOnDelete();
            $table->unsignedBigInteger('daskum_id')->nullable();
            $table->foreign('daskum_id')
                ->references('daskum_id')
                ->on('dasar_hukum')
                ->nullOnDelete();
            $table->foreignId('sekolah_id')
                ->nullable()
                ->references('sekolah_id')
                ->on('sekolah')
                ->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_pekerjaan');
    }
};
