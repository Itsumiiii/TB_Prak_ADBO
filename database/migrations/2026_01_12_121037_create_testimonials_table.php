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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->string('idTestimoni')->primary();
            $table->string('id_guest'); // Foreign key to users table
            $table->integer('rating'); // 1-5
            $table->text('komentar');
            $table->string('gambar')->nullable();
            $table->boolean('disetujui')->default(false);
            $table->timestamps();

            $table->foreign('id_guest')->references('id_guest')->on('guests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
