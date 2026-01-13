<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $packages = [
            'Cinematic Pernikahan', 'Acara Perusahaan', 'Video Musik', 'Iklan Produk', 
            'Pesta Ulang Tahun', 'Highlight Tunangan', 'Dokumenter', 'Film Pendek'
        ];

        $descriptions = [
            'Paket lengkap untuk mengabadikan momen spesial Anda dengan kualitas sinematik terbaik.',
            'Solusi dokumentasi profesional untuk kebutuhan branding dan acara kantor Anda.',
            'Video kreatif dengan konsep unik yang disesuaikan dengan keinginan klien.',
            'Dokumentasi full day dengan hasil editing yang memukau dan cepat.',
            'Abadikan kenangan manis dengan paket hemat namun tetap berkualitas tinggi.'
        ];
        
        return [
            'idPaket' => 'PKG' . Str::upper(Str::random(8)),
            'namaPaket' => fake()->randomElement($packages) . ' ' . fake()->numerify('##'),
            'deskripsi' => fake()->randomElement($descriptions),
            'hargaDasar' => fake()->numberBetween(5, 50) * 1000000,
            'inklusi' => ['4K Video', 'Drone Shot', '3 Min Highlight', 'Full Documentation'],
            'aktif' => true,
        ];
    }
}
