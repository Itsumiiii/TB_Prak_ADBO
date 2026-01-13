<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Portfolio>
 */
class PortfolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['Pernikahan', 'Korporat', 'Acara', 'Iklan', 'Video Musik'];

        $titles = [
            'Wedding Adat Jawa Putri & Putra', 'Company Profile PT Sinar Mas', 
            'Grand Opening Cafe Kopi Senja', 'Music Video Band Lokal - "Rindu"', 
            'Dokumentasi Ulang Tahun ke-17 Alya', 'Iklan Produk SkinCare Glowing',
            'Pre-Wedding di Pantai Indah Kapuk', 'Workshop Digital Marketing 2024',
            'Seminar Nasional Mahasiswa', 'Teaser Film Pendek "Harapan"'
        ];

        $descriptions = [
            'Video highlight berdurasi 3 menit yang menampilkan momen-momen terbaik.',
            'Pengambilan gambar menggunakan 3 kamera dan drone untuk hasil maksimal.',
            'Dokumentasi acara formal dengan gaya elegan dan profesional.',
            'Video iklan pendek yang dirancang untuk kebutuhan sosial media.',
            'Proyek kolaborasi kreatif dengan konsep visual yang estetik.'
        ];

        return [
            'idPortofolio' => 'PRT' . Str::upper(Str::random(8)),
            'judul' => fake()->randomElement($titles),
            'kategori' => fake('id_ID')->randomElement($categories),
            'klien' => fake('id_ID')->company(),
            'tanggalSelesai' => fake('id_ID')->date(),
            'deskripsi' => fake()->randomElement($descriptions),
            'linkVideo' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Placeholder
            'gambarCover' => 'portfolios/dummy_portfolio.jpg', // Placeholder Image
            'aktif' => true,
        ];
    }
}
