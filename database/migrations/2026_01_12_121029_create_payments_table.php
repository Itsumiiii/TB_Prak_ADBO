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
            $table->string('idPembayaran')->primary();
            $table->string('idBooking'); // Foreign key to bookings table
            $table->decimal('jumlah', 10, 2);
            $table->string('metodePembayaran');
            $table->string('statusPembayaran')->default('pending'); // pending, success, failed
            $table->dateTime('tanggalBayar')->nullable();
            $table->string('buktiPembayaran')->nullable(); // Path to uploaded proof of payment
            $table->timestamps();

            $table->foreign('idBooking')->references('idBooking')->on('bookings')->onDelete('cascade');
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
