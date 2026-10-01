<?php

namespace Database\Seeders;

use App\Models\Reseller;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ResellerSeeder extends Seeder
{
    public function run(): void
    {
        $resellers = [
            [
                'name' => 'Aulia Rahma',
                'email' => 'aulia@bdkatalog.test',
                'nama_lengkap' => 'Aulia Rahma',
                'prodi' => 'Manajemen Informatika',
                'whatsapp' => '6281234567890',
                'bio' => 'Mahasiswa yang mengembangkan produk makanan dan minuman kreatif.',
                'instagram' => '@auliarahma',
                'tiktok' => '@auliarahma',
            ],
            [
                'name' => 'Shinta Dewi',
                'email' => 'shinta@bdkatalog.test',
                'nama_lengkap' => 'Shinta Dewi',
                'prodi' => 'Manajemen Informatika',
                'whatsapp' => '6281234567891',
                'bio' => 'Mengembangkan produk fashion dan kerajinan handmade.',
                'instagram' => '@shintadewi',
                'tiktok' => '@shintadewi',
            ],
            [
                'name' => 'Nabila Putri',
                'email' => 'nabila@bdkatalog.test',
                'nama_lengkap' => 'Nabila Putri',
                'prodi' => 'Manajemen Informatika',
                'whatsapp' => '6281234567892',
                'bio' => 'Berfokus pada produk minuman dan usaha kreatif mahasiswa.',
                'instagram' => '@nabilaputri',
                'tiktok' => '@nabilaputri',
            ],
            [
                'name' => 'Farhan Aziz',
                'email' => 'farhan@bdkatalog.test',
                'nama_lengkap' => 'Farhan Aziz',
                'prodi' => 'Manajemen Informatika',
                'whatsapp' => '6281234567893',
                'bio' => 'Menawarkan produk fashion dan kebutuhan mahasiswa.',
                'instagram' => '@farhanaziz',
                'tiktok' => '@farhanaziz',
            ],
            [
                'name' => 'Salsa Mutiara',
                'email' => 'salsa@bdkatalog.test',
                'nama_lengkap' => 'Salsa Mutiara',
                'prodi' => 'Manajemen Informatika',
                'whatsapp' => '6281234567894',
                'bio' => 'Mengembangkan produk beauty dan health untuk mahasiswa.',
                'instagram' => '@salsamutiara',
                'tiktok' => '@salsamutiara',
            ],
        ];

        foreach ($resellers as $data) {
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('reseller123'),
                    'role' => 'reseller',
                ]
            );

            Reseller::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_lengkap' => $data['nama_lengkap'],
                    'prodi' => $data['prodi'],
                    'whatsapp' => $data['whatsapp'],
                    'bio' => $data['bio'],
                    'instagram' => $data['instagram'],
                    'tiktok' => $data['tiktok'],
                ]
            );
        }
    }
}
