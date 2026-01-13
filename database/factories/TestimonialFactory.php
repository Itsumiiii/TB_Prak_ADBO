<?php

namespace Database\Factories;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $comments = [
            'Sangat puas dengan hasilnya! Videonya jernih dan editingnya keren banget.',
            'Tim Vidiooo sangat profesional dan ramah. Hasil videonya melebihi ekspektasi kami.',
            'Harganya terjangkau tapi kualitasnya juara. Recommended banget!',
            'Terima kasih sudah mengabadikan momen pernikahan kami dengan sangat indah.',
            'Respon admin cepat, pengerjaan tepat waktu, dan hasilnya memuaskan.',
            'Kreatif banget konsepnya, suka banget sama color gradingnya.',
            'Nyesel baru tau Vidiooo sekarang, tau gitu dari dulu pake jasa mereka.'
        ];

        return [
            'idTestimoni' => Str::uuid()->toString(),
            'id_guest' => Guest::factory(),
            'rating' => fake()->numberBetween(4, 5),
            'komentar' => fake()->randomElement($comments),
            'disetujui' => true,
            'gambar' => 'testimonials/dummy_testimonial.jpg',
        ];
    }
}
