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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('no_kartu');
            $table->enum('jenis_langganan', ['harian', 'mingguan', 'bulanan']);
            $table->decimal('harga', 10, 2);
            $table->enum('status', ['pending', 'completed', 'failed'])->default('completed');
            $table->date('tanggal_pembayaran'); 
            $table->timestamps();

            $table->foreign('no_kartu')->references('no_kartu')->on('members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};