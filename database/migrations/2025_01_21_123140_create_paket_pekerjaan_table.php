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
            $table->foreignId('sub_kegiatan_id')
                ->constrained('sub_kegiatan', 'sub_kegiatan_id')
                ->cascadeOnDelete();
            $table->string('sumber_dana');
            $table->smallInteger('tahun_anggaran');
            $table->foreignId('satker_id')
                ->constrained('satuan_kerja', 'satker_id')
                ->cascadeOnDelete();
            $table->string('nama_pekerjaan');
            $table->smallInteger('waktu_paket');
            $table->string('metode_pemilihan');
            $table->string('jenis_pengadaan');
            $table->integer('nilai_pagu');
            $table->integer('nilai_hps');
            $table->foreignId('ppkom_id')
                ->constrained('ppkom', 'ppkom_id')
                ->cascadeOnDelete();

            $table->unsignedBigInteger('daskum_id');
            $table->foreign('daskum_id')
                ->references('daskum_id')
                ->on('dasar_hukum')
                ->onDelete('cascade');
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
