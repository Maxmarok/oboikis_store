<?php

namespace Database\Seeders;

use App\Models\Info;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Info::insert([
            'phone' => config('oboikis.link.phone'),
            'email' => config('oboikis.link.email'),
            'vk' => config('oboikis.link.vk'),
            'telegram' => config('oboikis.link.telegram'),
            'whatsapp' => config('oboikis.link.whatsapp'),
            'viber' => config('oboikis.link.viber'),
            'instagram' => config('oboikis.link.instagram'),
        ]);

    }
}
