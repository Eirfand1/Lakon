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
            $table->integer('kode_sirup');
            $table->enum('sumber_dana', ['APBN', 'DAK', 'BANKEU', 'APBD Perubahan', 'APBD Perubahan Biasa', 'BANKEU Perubahan', 'SG', 'Bantuan Pemerintah']);
            $table->smallInteger('tahun_anggaran');
            $table->foreignId('satker_id')
                ->constrained('satuan_kerja', 'satker_id')
                ->cascadeOnDelete();
            $table->string('nama_pekerjaan');
            $table->date('waktu_paket');
            $table->enum('metode_pemilihan', ['Jasa Konsultasi Pengawasan', 'Jasa Konsultasi Perencanaan', 'Pekerjaan Konstruksi', 'Pengadaan Barang']);
            $table->enum('jenis_pengadaan', ['Tender', 'Non Tender', 'E-Katalog', 'Swakelola']);
            $table->integer('nilai_pagu_paket');
            $table->integer('nilai_pagu_anggaran');
            $table->integer('nilai_hps');
            $table->foreignId('ppkom_id')
                ->constrained('ppkom', 'ppkom_id')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('daskum_id');
            $table->foreign('daskum_id')
                ->references('daskum_id')
                ->on('dasar_hukum')
                ->onDelete('cascade');
            $table->integer('rup');
            $table->foreignId('sekolah_id')
                ->references('sekolah_id')
                ->on('sekolah')
                ->onDelete('cascade')
                ->nullable();
            $table->timestamps();
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
