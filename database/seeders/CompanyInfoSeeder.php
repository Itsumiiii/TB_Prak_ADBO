<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanyInfo;

class CompanyInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyInfo::create([
            'namaPerusahaan' => 'Vidiooo Creative Production',
            'email' => 'contact@vidiooo.com',
            'nomorWhatsApp' => '6281234567890',
            'alamat' => 'Jl. Merdeka No. 10, Jakarta Pusat, Indonesia',
            'instagram' => 'vidiooo_creative',
            'facebook' => 'Vidiooo Creative',
            'youtube' => 'Vidiooo Channel',
            'tiktok' => 'vidiooo.official',
        ]);
    }
}
