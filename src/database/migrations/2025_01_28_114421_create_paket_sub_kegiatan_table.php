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
        Schema::create('paket_sub_kegiatan', function (Blueprint $table) {
            $table->id('paket_sub_kegiatan_id');
            $table->foreignId('paket_id')->nullable()
                ->constrained('paket_pekerjaan', 'paket_id')
                ->nullOnDelete();
            $table->foreignId('sub_kegiatan_id')->nullable()
                ->constrained('sub_kegiatan', 'sub_kegiatan_id')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_sub_kegiatan');
    }
};
