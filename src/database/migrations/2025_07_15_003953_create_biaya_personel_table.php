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
        Schema::create('biaya_personel', function (Blueprint $table) {
            $table->id('biaya_personel_id');
            $table->foreignId('kontrak_id')
                ->constrained('kontrak', 'kontrak_id')
                ->cascadeOnDelete();
            $table->string('jenis_biaya');
            $table->string('uraian_biaya');
            $table->string('satuan');
            $table->integer('qty');
            $table->integer('harga');
            $table->integer('jumlah')->virtualAs('qty * harga');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biaya_personel');
    }
};
