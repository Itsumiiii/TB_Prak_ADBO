<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;
    protected $table = 'packages';
    protected $primaryKey = 'idPaket';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'idPaket',
        'namaPaket',
        'deskripsi',
        'hargaDasar',
        'inklusi',
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
            'hargaDasar' => 'decimal:2',
            'inklusi' => 'array', // Cast to array since it's stored as JSON
            'aktif' => 'boolean',
        ];
    }

    // Relationships
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id_admin');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'idPaket', 'idPaket');
    }

    public function users()
    {
        return $this->belongsToMany(Guest::class, 'package_user', 'package_id', 'user_id');
    }
}
