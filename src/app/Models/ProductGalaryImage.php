<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\DateTimeTimezone;

class ProductGalaryImage extends Model
{
    use HasFactory;

    protected $table = 'product_galary_images';

    protected $fillable = [
        'product_id',
        'images_source',
        'media_id',
    ];

    protected $casts = [
        'created_at' => DateTimeTimezone::class,
        'updated_at' => DateTimeTimezone::class
    ];
}
