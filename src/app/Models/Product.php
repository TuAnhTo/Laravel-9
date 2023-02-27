<?php

namespace App\Models;

use App\Casts\DateTimeTimezone;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @method $this whereStoreId(string $storeId)
 * @method $this whereId(int $id)
 * @package App\Models
 */
class Product extends Model
{
    protected $fillable = [
        'title',
        'store_id',
        'description',
        'media',
        'price',
        'compare_at_price',
        'cost_per_item',
        'change_tax',
        'sku',
        'barcode',
        'track_quantity',
        'continue_selling',
        'physical_product',
        'weight',
        'country_of_origin',
        'hs_code',
        'option',
        'status',
        'product_type',
        'category_id'
    ];

    protected $casts = [
        'created_at' => DateTimeTimezone::class,
        'updated_at' => DateTimeTimezone::class
    ];
}
