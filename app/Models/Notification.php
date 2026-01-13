<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $primaryKey = 'idNotifikasi';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'idNotifikasi',
        'judul',
        'pesan',
        'sudahDibaca',
        'recipient_type',
        'recipient_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sudahDibaca' => 'boolean',
        ];
    }

    // Relationships
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'idNotifikasi');
    }
}
