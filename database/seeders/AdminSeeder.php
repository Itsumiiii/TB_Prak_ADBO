<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'id_admin' => 'ADM001',
            'name' => 'Super Admin',
            'username' => 'admin',
            'email' => 'admin@vidiooo.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
        ]);

        // Additional dummy admins
        Admin::factory()->count(5)->create();
    }
}
