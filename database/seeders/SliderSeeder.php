<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i<200; $i++)
        {
            Slider::query()->create([
                'title' => fake()->name,
                'description' => fake()->text,
                'image' => '/images/',
                'link' => fake()->url,
            ]);
        }
    }
}
