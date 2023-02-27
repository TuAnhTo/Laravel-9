<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\DateTimeTimezone;

class GiftCard extends Model
{
    use HasFactory;

    protected $table = 'gift_cards';

    protected $fillable = [
        'name',
        'sku',
        'selling_price',
        'thumbnail_image',
        'discount',
        'discount_type',
        'start_date',
        'end_date',
        'description',
        'status',
        'avg_rating',
        'created_by',
        'updated_by',
        'shipping_id',
    ];
    
    protected $casts = [
        'created_at' => DateTimeTimezone::class,
        'updated_at' => DateTimeTimezone::class
    ];
}
