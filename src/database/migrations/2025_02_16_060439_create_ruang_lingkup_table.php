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
        Schema::create('ruang_lingkup', function (Blueprint $table) {
            $table->id('ruang_lingkup_id');
            $table->foreignId('kontrak_id')
                ->constrained('kontrak', 'kontrak_id')
                ->cascadeOnDelete();
            $table->string('ruang_lingkup');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruang_lingkup');
    }
};
