<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $color = ['Ağ', 'Qırmızı', 'Qara', 'Göy', 'Yaşıl'];
        $size = ['S', 'M', 'L', 'XL'];
        $name = 'Product '.$size[random_int(0, 3)].' '.$color[random_int(0, 4)];
        return [
            'name' => $name,
            'slug' => Str::slug($name.'-'.uniqid()),
            'short_name' => 'product short content',
            'content' => '<p> Test Content Test Content Test Content Test Content Test Content Test Content </p>',
            'image' => 'img/default.png',
            'price' => random_int(15, 200),
            'category_id' => random_int(1, 12),
            'size' => $size[random_int(0, 3)],
            'color' => $color[random_int(0, 4)],
            'status' => 1
        ];
    }
}
