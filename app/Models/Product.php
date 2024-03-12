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

    public function scopeFilter($query, $color, $size, $pricemin, $pricemax)
    {
        if (!empty($color))
        {
            $query->where('color', $color);
        }

        if (!empty($size))
        {
            $query->where('size', $size);
        }

        if (!empty($pricemin) && !empty($pricemax))
        {
            $query->where('price', '>=', $pricemin)
                ->where('price', '<=', $pricemax);
        }

        return $query;
    }

    public function categories(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

}
