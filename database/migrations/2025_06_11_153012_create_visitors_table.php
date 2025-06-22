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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('no_kartu');
            $table->string('nama');
            $table->string('photo')->nullable();
            $table->enum('status', ['in', 'out']);
            $table->datetime('waktu_masuk');
            $table->datetime('waktu_keluar')->nullable();
            $table->timestamps();
            
            $table->foreign('no_kartu')->references('no_kartu')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
