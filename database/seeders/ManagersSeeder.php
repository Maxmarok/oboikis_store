<?php

namespace Database\Seeders;

use App\Models\Managers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ManagersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = config('oboikis.admin.email');
        $password = config('oboikis.admin.password');
        
        $arr = [
            'email' => $email,
            'password' => Hash::make($password),
        ];

        Managers::insert($arr);
    }
}
