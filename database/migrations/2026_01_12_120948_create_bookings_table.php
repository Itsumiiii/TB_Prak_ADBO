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
        Schema::create('bookings', function (Blueprint $table) {
            $table->string('idBooking')->primary();
            $table->string('id_guest'); // Foreign key to users table
            $table->string('idPaket'); // Foreign key to packages table
            $table->date('tanggalAcara');
            $table->time('waktuAcara');
            $table->string('lokasiAcara');
            $table->text('catatan')->nullable();
            $table->string('status')->default('pending'); // pending, confirmed, cancelled
            $table->decimal('totalHarga', 10, 2);
            $table->timestamps();

            $table->foreign('id_guest')->references('id_guest')->on('guests')->onDelete('cascade');
            $table->foreign('idPaket')->references('idPaket')->on('packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
