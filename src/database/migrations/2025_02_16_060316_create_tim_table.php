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
        Schema::create('tim', function (Blueprint $table) {
            $table->id('tim_id');
            $table->foreignId('kontrak_id')
                ->constrained('kontrak', 'kontrak_id')
                ->cascadeOnDelete();
            $table->string('nama');
            $table->string('posisi');
            $table->enum('status_tenaga', ['Tenaga Ahli', 'Tenaga Penunjang']);
            $table->boolean('bulan_1')->default(false);
            $table->boolean('bulan_2')->default(false);
            $table->boolean('bulan_3')->default(false);
            $table->boolean('bulan_4')->default(false);
            $table->boolean('bulan_5')->default(false);
            $table->boolean('bulan_6')->default(false);
            $table->boolean('bulan_7')->default(false);
            $table->boolean('bulan_8')->default(false);
            $table->boolean('bulan_9')->default(false);
            $table->boolean('bulan_10')->default(false);
            $table->boolean('bulan_11')->default(false);
            $table->boolean('bulan_12')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tim');
    }
};
