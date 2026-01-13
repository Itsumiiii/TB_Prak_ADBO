<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
    use HasFactory;
    protected $table = 'testimonials';
    protected $primaryKey = 'idTestimoni';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'idTestimoni',
        'id_guest',
        'rating',
        'komentar',
        'gambar',
        'disetujui',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'disetujui' => 'boolean',
        ];
    }

    // Relationships
    public function guest()
    {
        return $this->belongsTo(Guest::class, 'id_guest', 'id_guest');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'idTestimoni');
    }
}
