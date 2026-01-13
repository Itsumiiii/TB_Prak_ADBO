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
        Schema::create('analytics', function (Blueprint $table) {
            $table->string('analyticsId')->primary();
            $table->date('date');
            $table->integer('pageViews')->default(0);
            $table->integer('uniqueVisitors')->default(0);
            $table->string('popularPortfolio')->nullable(); // ID of most viewed portfolio
            $table->decimal('conversionRate', 5, 2)->default(0.00); // Percentage
            $table->string('trafficSource')->nullable(); // Where the visitor came from
            $table->string('userAgent')->nullable(); // Browser/device info
            $table->string('ipAddress')->nullable(); // IP address of visitor
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics');
    }
};
