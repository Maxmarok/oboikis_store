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
            ['name' => 'Обои', 'url' => 'wallpaper', 'icon' => '/svg/wallpaper1.svg'],
            ['name' => 'Фотообои', 'url' => 'photo', 'icon' => '/svg/wallpaper2.svg'],
            ['name' => 'Фрески', 'url' => 'fresk', 'icon' => '/svg/wallpaper3.svg'],
            ['name' => 'Лепной декор', 'url' => 'decor', 'icon' => '/svg/wallpaper4.svg'],
            ['name' => 'Клей', 'url' => 'glue', 'icon' => '/svg/bucket.svg'],
        ];

        Catalogs::insert($data);
    }
}
