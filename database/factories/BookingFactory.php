<?php

namespace Database\Factories;

use App\Models\Guest;
use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idBooking' => 'BK' . Str::upper(Str::random(8)),
            'id_guest' => Guest::factory(),
            'idPaket' => Package::factory(),
            'tanggalAcara' => fake()->dateTimeBetween('+1 week', '+6 months')->format('Y-m-d'),
            'waktuAcara' => fake()->time('H:i'),
            'lokasiAcara' => fake('id_ID')->address(),
            'catatan' => fake('id_ID')->sentence(),
            'status' => fake()->randomElement(['pending', 'confirmed', 'completed', 'cancelled']),
            'totalHarga' => fake()->numberBetween(5000000, 50000000),
        ];
    }
}
