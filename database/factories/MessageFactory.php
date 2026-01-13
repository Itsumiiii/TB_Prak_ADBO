<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake('id_ID')->name(),
            'email' => fake('id_ID')->safeEmail(),
            'subject' => fake('id_ID')->sentence(),
            'message' => fake('id_ID')->paragraph(),
            'is_read' => fake()->boolean(),
        ];
    }
}
