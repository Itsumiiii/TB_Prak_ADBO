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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->string('idPortofolio')->primary();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('kategori');
            $table->string('klien')->nullable();
            $table->date('tanggalSelesai')->nullable();
            $table->string('linkVideo')->nullable();
            $table->string('gambarCover');
            $table->integer('jumlahTayangan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
