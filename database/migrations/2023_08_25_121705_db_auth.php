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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('nohp')->unique();
            $table->string('password');
            $table->datetime('email_verified_at')->nullable();
            $table->boolean('is_dewa')->default(0);
            $table->string('tgl_pembuatan');
            $table->string('apikey')->unique();
            $table->string('wlip')->nullable();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
