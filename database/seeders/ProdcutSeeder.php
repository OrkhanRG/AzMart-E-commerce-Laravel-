<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProdcutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $size = ['S', 'M', 'L'];
        $color = ['Ağ', 'Qırmızı', 'Qara'];
        $image = ['img/cloth_1.jpg', 'img/shoe_1.jpg', 'img/cloth_2.jpg'];
        $name = 'Məhsul Adı ';

        for ($i = 0; $i < 3; $i++) {
            Product::query()->create([
                'name' => $name . ($i + 1),
                'slug' => Str::slug($name . (($i + 1))),
                'short_name' => 'Məhsulun Qısa Adı ' . ($i + 1),
                'content' => '<p> Test Content Test Content Test Content Test Content Test Content Test Content </p>',
                'image' => $image[$i],
                'price' => rand(50, 500),
                'size' => $size[$i],
                'color' => $color[$i],
                'status' => 1
            ]);
        }
    }
}
