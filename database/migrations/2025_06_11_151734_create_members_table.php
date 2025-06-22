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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('no_kartu')->unique();
            $table->string('nama');
            $table->enum('jk', ['L', 'P']);
            $table->text('alamat');
            $table->date('tgl_lahir');
            $table->date('tgl_mulai');
            $table->date('tgl_akhir');
            $table->string('no_hp');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};