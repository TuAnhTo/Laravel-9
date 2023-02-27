<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\DateTimeTimezone;

class TransportProtocol extends Model
{
    use HasFactory;

    protected $table = 'shipping_methods';

    protected $fillable = [
        'shipping_method_id',
        'live_status',
        'username',
        'pasword',
        'pickup_address_line1',
        'pickup_suburb',
        'pickup_postcode',
        'pickup_country',
    ];

    protected $casts = [
        'created_at' => DateTimeTimezone::class,
        'updated_at' => DateTimeTimezone::class
    ];
}

