<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guests = \App\Models\Guest::all();

        if ($guests->count() > 0) {
            Testimonial::factory()->count(15)->recycle($guests)->create();
        }
    }
}
