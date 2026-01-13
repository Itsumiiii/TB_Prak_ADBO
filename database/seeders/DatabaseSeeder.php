<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            CompanyInfoSeeder::class,
            GuestSeeder::class,
            PackageSeeder::class,
            PortfolioSeeder::class,
            BookingSeeder::class, // Depends on Guest and Package
            PaymentSeeder::class, // Depends on Booking
            TestimonialSeeder::class, // Depends on Guest
            MessageSeeder::class,
            NotificationSeeder::class,
        ]);
    }
}
