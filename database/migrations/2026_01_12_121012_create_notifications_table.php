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
        Schema::create('notifications', function (Blueprint $table) {
            $table->string('idNotifikasi')->primary();
            $table->string('judul');
            $table->text('pesan');
            $table->boolean('sudahDibaca')->default(false);
            $table->string('recipient_type'); // admin or user
            $table->string('recipient_id'); // id of the recipient
            $table->string('type')->nullable(); // booking, payment, etc
            $table->string('link')->nullable();
            $table->string('booking_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
