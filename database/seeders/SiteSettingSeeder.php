<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [

            // =========================
            // GENERAL
            // =========================

            [
                'key' => 'site_name',
                'value' => 'BD Katalog',
            ],
            [
                'key' => 'tagline',
                'value' => 'Ruang Tumbuh Produk Mahasiswa',
            ],
            [
                'key' => 'about',
                'value' => 'BD Katalog merupakan platform digital untuk memperkenalkan dan menghubungkan berbagai produk karya mahasiswa dalam satu ekosistem.',
            ],
            [
                'key' => 'vision',
                'value' => 'Menjadi ruang yang mendukung mahasiswa dalam memperkenalkan, mengembangkan, dan menghubungkan produk serta potensi bisnis mereka.',
            ],
            [
                'key' => 'mission',
                'value' => 'Membangun ekosistem katalog produk mahasiswa yang informatif, mudah diakses, dan mendukung kolaborasi antar mahasiswa.',
            ],

            // =========================
            // CONTACT
            // =========================

            [
                'key' => 'whatsapp',
                'value' => '6289508721206',
            ],
            [
                'key' => 'instagram',
                'value' => 'https://instagram.com/',
            ],
            [
                'key' => 'tiktok',
                'value' => 'https://tiktok.com/',
            ],
            [
                'key' => 'email',
                'value' => 'businessdevelopment@example.com',
            ],
            [
                'key' => 'address',
                'value' => 'Kampus / Sekretariat Business Development',
            ],

            // =========================
            // ABOUT HERO
            // =========================

            [
                'key' => 'about_hero',
                'value' => 'BD adalah wadah bagi mahasiswa untuk memamerkan karya, membangun bisnis, dan tumbuh bersama lewat kolaborasi bersama HMPS.',
            ],
            [
                'key' => 'about_hero_title',
                'value' => 'Wadah Ide, Karya, dan Kolaborasi Mahasiswa',
            ],

            // =========================
            // ABOUT VISION
            // =========================

            [
                'key' => 'about_vision_title',
                'value' => 'Menjadikan setiap ide kecil mahasiswa berdampak besar.',
            ],
            [
                'key' => 'about_vision_description',
                'value' => 'Menjadi wadah terdepan yang menumbuhkan wirausaha muda, dari kampus untuk masyarakat luas.',
            ],

            // =========================
            // MISSIONS
            // =========================

            [
                'key' => 'mission_1_title',
                'value' => 'Etalase karya mahasiswa',
            ],
            [
                'key' => 'mission_1_description',
                'value' => 'Menampilkan produk dan jasa mahasiswa dalam satu katalog yang mudah dijangkau.',
            ],

            [
                'key' => 'mission_2_title',
                'value' => 'Pembinaan wirausaha muda',
            ],
            [
                'key' => 'mission_2_description',
                'value' => 'Memberi pelatihan, mentoring, dan pendampingan pemasaran secara berkala.',
            ],

            [
                'key' => 'mission_3_title',
                'value' => 'Jejaring kolaborasi',
            ],
            [
                'key' => 'mission_3_description',
                'value' => 'Membangun kerja sama dengan HMPS, komunitas, dan mitra industri.',
            ],

            [
                'key' => 'mission_4_title',
                'value' => 'Ekosistem yang berkelanjutan',
            ],
            [
                'key' => 'mission_4_description',
                'value' => 'Menciptakan lingkungan bisnis mahasiswa yang saling mendukung dan terus berkembang.',
            ],

            // =========================
            // VALUES
            // =========================

            [
                'key' => 'value_1_title',
                'value' => 'Kreatif',
            ],
            [
                'key' => 'value_1_description',
                'value' => 'Berani mencoba hal baru dan melihat peluang dari ide sederhana.',
            ],

            [
                'key' => 'value_2_title',
                'value' => 'Kolaboratif',
            ],
            [
                'key' => 'value_2_description',
                'value' => 'Bertumbuh bersama lewat kerja sama lintas prodi dan komunitas.',
            ],

            [
                'key' => 'value_3_title',
                'value' => 'Berdampak',
            ],
            [
                'key' => 'value_3_description',
                'value' => 'Setiap karya diarahkan untuk memberi manfaat nyata.',
            ],

            [
                'key' => 'value_4_title',
                'value' => 'Berintegritas',
            ],
            [
                'key' => 'value_4_description',
                'value' => 'Jujur dan transparan dalam setiap proses bisnis.',
            ],

            // =========================
            // TIMELINE
            // =========================

            [
                'key' => 'timeline_1_period',
                'value' => 'Awal 2026',
            ],
            [
                'key' => 'timeline_1_title',
                'value' => 'Ide Dimulai',
            ],
            [
                'key' => 'timeline_1_description',
                'value' => 'BD dirancang sebagai wadah produk mahasiswa.',
            ],

            [
                'key' => 'timeline_2_period',
                'value' => 'Agustus 2026',
            ],
            [
                'key' => 'timeline_2_title',
                'value' => 'Kolaborasi Perdana',
            ],
            [
                'key' => 'timeline_2_description',
                'value' => 'Bazar dan pelatihan bersama HMPS dan komunitas.',
            ],

            [
                'key' => 'timeline_3_period',
                'value' => 'September 2026',
            ],
            [
                'key' => 'timeline_3_title',
                'value' => 'Katalog Diluncurkan',
            ],
            [
                'key' => 'timeline_3_description',
                'value' => 'Produk mahasiswa resmi tampil dalam satu katalog.',
            ],

            [
                'key' => 'timeline_4_period',
                'value' => 'Oktober 2026',
            ],
            [
                'key' => 'timeline_4_title',
                'value' => 'Hadir di Website',
            ],
            [
                'key' => 'timeline_4_description',
                'value' => 'Akses produk dan peluang bisnis lebih mudah.',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
