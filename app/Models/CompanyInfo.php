<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    protected $table = 'company_infos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'namaPerusahaan',
        'email',
        'nomorWhatsApp',
        'alamat',
        'instagram',
        'facebook',
        'youtube',
        'tiktok',
    ];
}
