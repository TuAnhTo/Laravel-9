<?php

namespace App\Models;
use App\Casts\DateTimeTimezone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $table = 'product_variations';

    protected $fillable = [
        'product_id',
        'product_sku_id',
        'attribute_id',
        'attribute_value_id',
        'created_by',
        'updated_by',
    ];
    
    protected $casts = [
        'created_at' => DateTimeTimezone::class,
        'updated_at' => DateTimeTimezone::class
    ];
}
