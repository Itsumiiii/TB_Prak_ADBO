<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = \App\Models\Booking::all();

        if ($bookings->count() > 0) {
            // Create payments for some bookings, assuming ID relationship is handled by Factory referencing Booking factory or existing booking
            // To be safe and linked to existing bookings:
            
            $bookings->each(function ($booking) {
                if (rand(0, 1)) { // 50% chance to have a payment
                    Payment::factory()->state([
                        'idBooking' => $booking->idBooking
                    ])->create();
                }
            });
        }
    }
}
