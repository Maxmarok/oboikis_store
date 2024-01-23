<?php

namespace Database\Seeders;

use App\Models\Catalogs;
use App\Models\Items;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory;
use Illuminate\Support\Facades\Log;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('ru_RU');
        $catalogs = Catalogs::all()->pluck('id');

        $sources = [
            '/img/image_2.png',
            '/img/image_4.png',
            '/img/image_5.png',
        ];

        $names = [
            'CHILDRENs PARADISE',
            'Project',
            'Coloretto Stripes & Plains'
        ];

        $producers = [
            'Marburg',
            'Fipar',
        ];

        $countries = [
            'Германия', 'Бельгия', 'Россия'
        ];

        $materials = [
            'Винил', 'Флизелин', 'Под покраску',
        ];

        $sizes = [
            '10.05 х 0.53', '5.00 х 0.17', '25.00 х 1.06',
        ];

        $discountes = [
            5000, 10000
        ];

        for($i = 0; $i < 1000; $i++) {

            $price = $faker->numberBetween(2000, 10000);
            $discount = $faker->randomElement($discountes);

            if($discount >= $price) $discount = 0;

            $data[] = [
                'catalog_id'    => $faker->randomElement($catalogs),
                'name'          => $faker->randomElement($names),
                'url'           => Str::uuid(),
                'price'         => $price,
                'discount'      => $discount,
                'stock'         => $faker->numberBetween(0, 10),
                'image'         => $faker->randomElement($sources),
                'gallery'       => implode(',', [$faker->randomElement($sources), $faker->randomElement($sources)]),
                'country'       => $faker->randomElement($countries),
                'producer'      => $faker->randomElement($producers),
                'material'      => $faker->randomElement($materials),
                'size'          => $faker->randomElement($sizes),
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }

        Items::insert($data);

    }
}
