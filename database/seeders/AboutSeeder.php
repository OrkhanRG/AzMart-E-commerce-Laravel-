<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        About::query()->create([
            'name' => 'AzMart - Biz kimik?',
            'content' => 'Bu platformada əsas öncəliyimiz müştəri məmnuniyyətidir. Son model geyimləri AzMart dan tapa bilərsiz 😏',
            'image' => null,
            'text_1' => 'PULSUZ ÇATDIRILMA',
            'text_1_icon' => 'icon-truck',
            'text_1_content' => 'Sifarişlərinizi pulsuz, 1 həftə ərzində çatdırırıq',
            'text_2' => 'MALIN GERI QAYTARILMASI',
            'text_2_icon' => 'icon-refresh2',
            'text_2_content' => 'Aldığınız malları problem olduğu halda geri qaytara bilərsiniz',
            'text_3' => 'MÜŞTƏRI XIDMƏTI',
            'text_3_icon' => 'icon-help',
            'text_3_content' => 'Köməy lazım olduq 7/24 burdayıq dostum :)'
        ]);
    }
}
