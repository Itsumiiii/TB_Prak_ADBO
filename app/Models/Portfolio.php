<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portfolio extends Model
{
    use HasFactory;
    protected $table = 'portfolios';
    protected $primaryKey = 'idPortofolio';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'idPortofolio',
        'judul',
        'deskripsi',
        'kategori',
        'gambarCover',
        'jumlahTayangan',
        'aktif',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'jumlahTayangan' => 'integer',
            'aktif' => 'boolean',
        ];
    }

    // Relationships
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id_admin');
    }

    public function users()
    {
        return $this->belongsToMany(Guest::class, 'portfolio_user', 'portfolio_id', 'user_id');
    }

    public function images()
    {
        return $this->hasMany(PortfolioImage::class, 'portfolio_id', 'idPortofolio');
    }
}
