<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function subCategory()
    {
        return $this->hasMany(Category::class, 'parent_category', 'id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'parent_category');
    }

    public function getTotalProductCount()
    {
        $total = $this->products->count();

        foreach ($this->subCategory as $childCategory)
        {
            $total = $total + $childCategory->products->count();
        }

        return $total;
    }
}
