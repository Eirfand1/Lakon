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
            $table->string('jenis_kontrak')->nullable();
            $table->decimal('nilai_kontrak')->nullable();
            $table->date('tgl_kontrak')->nullable();
            $table->date('waktu_kontrak')->nullable();
            $table->foreignId('paket_id')
                ->constrained('paket_pekerjaan', 'paket_id')
                ->cascadeOnDelete();
            $table->date('tgl_pembuatan')->nullable();
            $table->foreignId('satker_id')
                ->constrained('satuan_kerja', 'satker_id')
                ->cascadeOnDelete();
            $table->foreignId('sub_kegiatan_id')->nullable()
                ->constrained('sub_kegiatan', 'sub_kegiatan_id')
                ->cascadeOnDelete();
            $table->foreignId('penyedia_id')
                ->constrained('penyedia', 'penyedia_id')
                ->cascadeOnDelete();
            $table->string('nomor_dppl')->nullable();
            $table->date('tgl_dppl')->nullable();
            $table->string('nomor_bahpl')->nullable();
            $table->date('tgl_bahpl')->nullable();
            $table->foreignId('verifikator_id')->nullable()
                ->constrained('verifikator', 'verifikator_id')
                ->cascadeOnDelete();
            $table->boolean('is_verificated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tahun = now()->year;
        $penyediaId = auth()->user()->penyedia->penyedia_id;
        $nomorKontrak = "KONTRAK/{$penyediaId}/P4/{$tahun}";

        Schema::dropIfExists('kontrak');
    }
};
