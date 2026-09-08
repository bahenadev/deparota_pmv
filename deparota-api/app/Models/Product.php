<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'sku', 'description',
        'price', 'is_visible', 'image_url', 'dimensions',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}