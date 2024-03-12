<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = ['Kişi', 'Qadın', 'Uşaq'];
        $image = ['img/men.jpg', 'img/women.jpg', 'img/children.jpg'];

        for ($i=0; $i<count($name); $i++)
        {
            $slug = Str::slug($name[$i]);

            Category::query()->create([
                'image' => $image[$i],
                'name' => $name[$i],
                'slug' => $slug,
                'parent_category' => null
            ]);
        }

        $manName = ['Kişi Ayaqqabı', 'Kişi T-Shirt', 'Kişi Sweeter'];
        for ($i=0; $i<count($name); $i++)
        {
            $slug = Str::slug($manName[$i]);

            Category::query()->create([
                'image' => null,
                'name' => $manName[$i],
                'slug' => $slug,
                'parent_category' => 1
            ]);
        }

        $womanName = ['Qadın Ayaqqabı', 'Qadın T-Shirt', 'Qadın Sweeter'];
        for ($i=0; $i<count($name); $i++)
        {
            $slug = Str::slug($womanName[$i]);

            Category::query()->create([
                'image' => null,
                'name' => $womanName[$i],
                'slug' => $slug,
                'parent_category' => 2
            ]);
        }

        $childName = ['Uşaq Ayaqqabı', 'Uşaq T-Shirt', 'Uşaq Sweeter'];
        for ($i=0; $i<count($name); $i++)
        {
            $slug = Str::slug($childName[$i]);

            Category::query()->create([
                'image' => null,
                'name' => $childName[$i],
                'slug' => $slug,
                'parent_category' => 3
            ]);
        }

    }
}
