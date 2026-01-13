<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Portfolio;

class PortfolioImage extends Model
{
    use HasFactory;

    protected $fillable = ['portfolio_id', 'image_path'];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class, 'portfolio_id', 'idPortofolio');
    }
}
