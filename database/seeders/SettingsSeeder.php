<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['email', 'phone', 'address'];
        $content = ['orxanismayilov851@gmail.com', '+994-55-878-37-00', 'Azerbaijan Baku 28 May'];

        for ($i=0; $i<count($data); $i++)
        {
            Setting::query()->create([
                'name' => $data[$i],
                'content' => $content[$i]
            ]);
        }


    }
}
