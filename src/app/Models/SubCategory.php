<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\DateTimeTimezone;

class SubCategory extends Model
{
    use HasFactory;
    
    protected $table = 'sub_categories';

    protected $fillable = [
        'name',
        'category_id'
    ];

    protected $casts = [
        'created_at' => DateTimeTimezone::class,
        'updated_at' => DateTimeTimezone::class
    ];
}
