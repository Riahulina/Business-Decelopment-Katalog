<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin default
        User::updateOrCreate(
            ['email' => 'admin@bd.katalog'],
            [
                'name' => 'BD Katalog Admin',
                'password' => Hash::make('BDKatalog2026'),
                'role' => 'super_admin',
            ]
        );


        $this->call([
            CategorySeeder::class,
            ChatbotFaqSeeder::class,
            SiteSettingSeeder::class,
        ]);
    }
}
