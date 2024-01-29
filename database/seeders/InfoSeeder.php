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
            'phone' => '79922224244',
            'email' => 'oboikis@yandex.ru',
            'logo' => '/svg/horizontal.svg',
            'vk' => 'https://vk.com/oboikisgroup',
            'telegram' => 'https://t.me/oboikisgroup',
            'whatsapp' => 'https://wa.me/79922224244',
            'viber' => 'viber://chat?number=79922224244',
            'instagram' => 'https://www.instagram.com/oboikis',
            'file_1' => null,
            'file_2' => Storage::url('docs/oferta.docx'),
        ]);

    }
}
