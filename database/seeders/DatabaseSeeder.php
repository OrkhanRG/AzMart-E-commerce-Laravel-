<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            SliderSeeder::class,
            AboutSeeder::class,
            CategorySeeder::class,
            SettingsSeeder::class,
            ProdcutSeeder::class,
            ]);

        User::query()->create([
            'name' =>  'Orxan',
            'email' =>  'orxanismayilov851@gmail.com',
            'password' =>  bcrypt('admin'),
        ]);

        Product::factory(100)->create();

    }
}
