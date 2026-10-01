<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $news = [
            [
                'title' => 'BD Resmi Meluncurkan Katalog Produk Mahasiswa',
                'excerpt' => 'Kolaborasi mahasiswa untuk menghadirkan produk kreatif unggulan dalam satu platform.',
                'content' => 'Business Development resmi menghadirkan katalog produk mahasiswa sebagai ruang untuk memperkenalkan dan mengembangkan berbagai produk kreatif mahasiswa.',
                'cover_image' => 'images/news/bd-launching.jpg',
                'status' => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Diskon Spesial Produk Mahasiswa Selama Bulan Oktober!',
                'excerpt' => 'Jangan lewatkan promo menarik dari produk unggulan mahasiswa.',
                'content' => 'Berbagai produk mahasiswa menghadirkan promo spesial selama bulan Oktober. Temukan produk favoritmu dan dukung karya mahasiswa.',
                'cover_image' => 'images/news/promo-produk.jpg',
                'status' => 'published',
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Workshop: Membangun Brand untuk Bisnis Mahasiswa',
                'excerpt' => 'Tingkatkan kemampuan branding dan strategi pemasaranmu bersama BD.',
                'content' => 'Workshop branding dan pemasaran ditujukan bagi mahasiswa yang ingin mengembangkan identitas serta strategi bisnis mereka.',
                'cover_image' => 'images/news/workshop-branding.jpg',
                'status' => 'published',
                'published_at' => now()->subDay(),
            ],
            [
                'title' => 'BD Kini Hadir di Website!',
                'excerpt' => 'Akses produk dan peluang lebih mudah melalui platform digital BD.',
                'content' => 'Website BD hadir sebagai ruang digital untuk mempertemukan produk mahasiswa, informasi kegiatan, kolaborasi, dan berbagai peluang pengembangan bisnis.',
                'cover_image' => 'images/news/website-bd.jpg',
                'status' => 'published',
                'published_at' => now(),
            ],
        ];

        foreach ($news as $item) {
            News::updateOrCreate(
                ['slug' => Str::slug($item['title'])],
                $item
            );
        }
    }
}
