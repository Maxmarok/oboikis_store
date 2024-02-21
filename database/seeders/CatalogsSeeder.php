<?php

namespace Database\Seeders;

use App\Models\Catalogs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                'name' => 'Обои', 
                'seo_title' => 'Купить Обои в Перми',
                'url' => 'wallpaper', 
                'icon' => '/svg/wallpaper1.svg'
            ],
            
            [
                'name' => 'Фотообои', 
                'seo_title' => 'Купить Фотообои в Перми',
                'url' => 'photo', 
                'icon' => '/svg/wallpaper2.svg'
            ],

            [
                'name' => 'Фрески', 
                'seo_title' => 'Купить Фрески в Перми',
                'url' => 'fresk', 
                'icon' => '/svg/wallpaper3.svg'
            ],

            [
                'name' => 'Лепной декор', 
                'seo_title' => 'Купить Лепной декор в Перми',
                'url' => 'decor', 
                'icon' => '/svg/wallpaper4.svg'
            ],

            [
                'name' => 'Клей', 
                'seo_title' => 'Купить Клей для обоев в Перми',
                'url' => 'glue', 
                'icon' => '/svg/bucket.svg'
            ],
        ];

        Catalogs::insert($data);
    }
}
