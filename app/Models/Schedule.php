<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';
    protected $primaryKey = 'idJadwal';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'idJadwal',
        'tanggal',
        'tersedia',
        'alasanDiblokir',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'tersedia' => 'boolean',
        ];
    }

    // Relationships
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'idJadwal');
    }
}
