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
        Schema::create('no_kontrak_tracker', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kontrak_last_year')->default(0);
            $table->integer('this_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('no_kontrak_tracker');
    }
};
