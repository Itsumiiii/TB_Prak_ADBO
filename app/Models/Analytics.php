<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    protected $table = 'analytics';
    protected $primaryKey = 'analyticsId';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'analyticsId',
        'date',
        'pageViews',
        'uniqueVisitors',
        'popularPortfolio',
        'conversionRate',
        'trafficSource',
        'userAgent',
        'ipAddress',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'date',
            'pageViews' => 'integer',
            'uniqueVisitors' => 'integer',
            'conversionRate' => 'decimal:2',
        ];
    }
}
