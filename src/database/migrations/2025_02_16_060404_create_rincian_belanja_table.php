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
        Schema::create('rincian_belanja', function (Blueprint $table) {
            $table->id('rincian_belanja_id');
            $table->foreignId('kontrak_id')
                ->constrained('kontrak', 'kontrak_id')
                ->cascadeOnDelete();
            $table->string('jenis');
            $table->string('uraian')->nullable();
            $table->integer('qty');
            $table->string('satuan');
            $table->integer('harga_satuan');
            $table->integer('total_harga')->virtualAs('qty * harga_satuan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rincian_belanja');
    }
};
