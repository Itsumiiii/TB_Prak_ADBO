<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we fetch existing IDs so foreign keys match
        $guests = \App\Models\Guest::all();
        $packages = \App\Models\Package::all();

        if ($guests->count() > 0 && $packages->count() > 0) {
            Booking::factory()->count(20)->recycle($guests)->recycle($packages)->create();
        }
    }
}
