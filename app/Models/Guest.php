<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guest extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $table = 'guests';
    protected $primaryKey = 'id_guest';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_guest',
        'name',
        'email',
        'no_hp',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'id_guest', 'id_guest');
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class, 'id_guest', 'id_guest');
    }

    public function portfolios()
    {
        return $this->belongsToMany(Portfolio::class, 'portfolio_user', 'user_id', 'portfolio_id');
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_user', 'user_id', 'package_id');
    }
}
