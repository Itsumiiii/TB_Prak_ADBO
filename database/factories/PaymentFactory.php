<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idPembayaran' => 'PAY' . Str::upper(Str::random(8)),
            'idBooking' => Booking::factory(),
            'jumlah' => fake()->numberBetween(1000000, 10000000),
            'metodePembayaran' => fake()->randomElement(['BCA Transfer', 'Mandiri Transfer', 'Credit Card']),
            'statusPembayaran' => fake()->randomElement(['pending', 'success', 'failed']),
            'tanggalBayar' => fake()->dateTime(),
            'buktiPembayaran' => 'payments/dummy_payment.jpg',
        ];
    }
}
