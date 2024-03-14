<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = [];

    public function scopeFilter($query, $colors, $sizes, $min, $max)
    {
        if (!empty($colors))
        {
            $query->whereIn('color', $colors);
        }

        if (!empty($sizes))
        {
            $query->whereIn('size', $sizes);
        }

        if (!empty($min) && !empty($max))
        {
            $query->where('price', '>=', $min)
                ->where('price', '<=', $max);
        }

        return $query;
    }

    public function categories(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

}
