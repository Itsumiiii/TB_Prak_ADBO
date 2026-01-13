<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $primaryKey = 'idBooking';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'idBooking',
        'id_guest',
        'idPaket',
        'tanggalAcara',
        'waktuAcara',
        'lokasiAcara',
        'status',
        'totalHarga',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggalAcara' => 'date',
            'waktuAcara' => 'string', // 'time' cast is not standard in Laravel, using string for H:i:s
            'totalHarga' => 'decimal:2',
        ];
    }

    // Relationships
    public function guest()
    {
        return $this->belongsTo(Guest::class, 'id_guest', 'id_guest');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'idPaket', 'idPaket');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'idBooking', 'idBooking');
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class, 'booking_id', 'idBooking'); // Assuming a booking has one schedule
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'booking_id', 'idBooking');
    }
}
