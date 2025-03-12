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
            $table->string('nomor_spk')->nullable();
            $table->integer('nilai_kontrak')->nullable();
            $table->string('terbilang_nilai_kontrak')->nullable();
            $table->date('tanggal_awal')->nullable();
            $table->date('tanggal_akhir')->nullable();
            $table->integer('waktu_kontrak')->virtualAs('DATEDIFF(tanggal_akhir, tanggal_awal) + 1')->nullable();
            $table->string('waktu_penyelesaian')->nullable();
            $table->string('cara_pembayaran')->nullable();
            $table->integer('uang_muka')->nullable();
            $table->date('tgl_kontrak')->nullable();
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
            $table->string('nomor_sppbj')->nullable();
            $table->date('tgl_sppbj')->nullable();
            $table->string('nomor_penetapan_pemenang')->nullable();
            $table->date('tgl_penetapan_pemenang')->nullable();
            $table->string('berkas_penawaran')->nullable();
            $table->foreignId('verifikator_id')->nullable()
                ->constrained('verifikator', 'verifikator_id')
                ->cascadeOnDelete();
            $table->boolean('is_verificated')->default(false);
            $table->boolean('is_layangkan')->default(false);
            $table->boolean('data_dasar_done')->default(false);
            $table->boolean('spk_done')->default(false);
            $table->boolean('lampiran_done')->default(false);
            $table->boolean('spp_done')->default(false);
            $table->boolean('sskk_done')->default(false);
            $table->string('template')->nullable();
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
