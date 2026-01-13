<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idNotifikasi' => 'NOT' . \Illuminate\Support\Str::upper(\Illuminate\Support\Str::random(8)),
            'type' => fake()->randomElement(['booking', 'payment', 'contact']),
            'judul' => fake('id_ID')->sentence(),
            'pesan' => fake('id_ID')->sentence(),
            'link' => '#',
            'sudahDibaca' => fake()->boolean(),
            'recipient_type' => 'admin',
            'recipient_id' => 'ADM001',
        ];
    }
}
