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
            'name' => 'Обои', 'url' => 'wallpapper', 'icon' => '/svg/wallpaper1.svg'
        ];

        Catalogs::insert($data);
    }
}
