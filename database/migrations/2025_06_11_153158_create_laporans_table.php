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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('no_kartu');
            $table->date('tanggal');
            $table->enum('jenis_pemasukan', ['pendaftaran', 'langganan']);
            $table->decimal('jumlah', 10, 2);
            $table->unsignedBigInteger('payment_id')->nullable(); // Foreign key ke payments.id
            $table->timestamps();

            // Foreign key ke tabel members
            $table->foreign('no_kartu')->references('no_kartu')->on('members')->onDelete('cascade');

            // Foreign key ke tabel payments
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};