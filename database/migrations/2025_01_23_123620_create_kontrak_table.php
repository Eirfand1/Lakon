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
        Schema::create('kontrak', function (Blueprint $table) {
            $table->id('kontrak_id');
            $table->string('no_kontrak');
            $table->string('jenis_kontrak');
            $table->decimal('nilai_kontrak');
            $table->date('tgl_kontrak');
            $table->date('waktu_kontrak');
            $table->foreignId('paket_id')
                ->constrained('paket_pekerjaan', 'paket_id')
                ->cascadeOnDelete();
            $table->date('tgl_pembuatan');
            $table->foreignId('satker_id')
                ->constrained('satuan_kerja', 'satker_id')
                ->cascadeOnDelete();
            $table->foreignId('sub_kegiatan_id')
                ->constrained('sub_kegiatan', 'sub_kegiatan_id')
                ->cascadeOnDelete();
            $table->foreignId('penyedia_id')
                ->constrained('penyedia', 'penyedia_id')
                ->cascadeOnDelete();
            $table->string('nomor_dppl');
            $table->date('tgl_dppl');
            $table->string('nomor_bahpl');
            $table->date('tgl_bahpl');
            $table->foreignId('verifikator_id')
                ->constrained('verifikator', 'verifikator_id')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontrak');
    }
};
