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
        Schema::create('ppkom', function (Blueprint $table) {
            $table->id('ppkom_id');
            $table->string('nip')->unique();
            $table->string('nama');
            $table->string('pangkat')->nullable();
            $table->string('jabatan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppkom');
    }
};
