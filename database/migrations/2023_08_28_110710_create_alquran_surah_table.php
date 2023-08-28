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
        Schema::create('alquran_surah', function (Blueprint $table) {
            $table->id();
            $table->string('arti');
            $table->string('asma');
            $table->string('ayat');
            $table->string('nama');
            $table->string('type');
            $table->string('urut');
            $table->string('audio');
            $table->string('nomor');
            $table->string('rukuk');
            $table->longText('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alquran_surah');
    }
};
