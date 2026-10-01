<?php

namespace Database\Seeders;

use App\Models\Collaboration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CollaborationSeeder extends Seeder
{
    public function run(): void
    {
        $collaborations = [
            [
                'name' => 'HMPS Manajemen Informatika',
                'description' => 'Kolaborasi dalam pengembangan kegiatan dan ekosistem bisnis mahasiswa.',
                'logo' => 'images/collaborations/hmps-mi.png',
                'link' => '#',
                'is_active' => true,
            ],
            [
                'name' => 'HMPS Akuntansi',
                'description' => 'Kolaborasi untuk mendukung pengembangan dan pengelolaan bisnis mahasiswa.',
                'logo' => 'images/collaborations/hmps-akuntansi.png',
                'link' => '#',
                'is_active' => true,
            ],
            [
                'name' => 'HMPS Administrasi Bisnis',
                'description' => 'Kolaborasi dalam kegiatan kewirausahaan dan pengembangan produk mahasiswa.',
                'logo' => 'images/collaborations/hmps-adbis.png',
                'link' => '#',
                'is_active' => true,
            ],
            [
                'name' => 'Komunitas Kreatif Mahasiswa',
                'description' => 'Partner kolaborasi dalam bidang kreativitas, branding, dan pengembangan produk.',
                'logo' => 'images/collaborations/komunitas-kreatif.png',
                'link' => '#',
                'is_active' => true,
            ],
        ];

        foreach ($collaborations as $collaboration) {
            Collaboration::updateOrCreate(
                ['name' => $collaboration['name']],
                $collaboration
            );
        }
    }
}
