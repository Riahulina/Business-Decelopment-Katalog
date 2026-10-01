<?php

namespace Database\Seeders;

use App\Models\ChatbotFaq;
use Illuminate\Database\Seeder;

class ChatbotFaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apa itu BD Katalog?',
                'answer' => 'BD Katalog adalah platform digital yang menampilkan dan memperkenalkan berbagai produk karya mahasiswa dalam satu katalog.',
                'category' => 'Umum',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana cara melihat produk?',
                'answer' => 'Kamu bisa membuka halaman Produk melalui menu navigasi, lalu mencari produk berdasarkan nama produk atau nama mahasiswa dan menggunakan filter kategori.',
                'category' => 'Produk',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana cara memesan produk?',
                'answer' => 'Pilih produk yang kamu inginkan, buka halaman detail produk, lalu klik tombol Pesan via WhatsApp untuk menghubungi pemilik produk secara langsung.',
                'category' => 'Produk',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah BD Katalog menyediakan pembayaran online?',
                'answer' => 'Tidak. BD Katalog merupakan katalog digital dan tidak menyediakan transaksi atau pembayaran secara langsung di dalam website.',
                'category' => 'Produk',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'question' => 'Siapa saja yang bisa menjadi reseller?',
                'answer' => 'Mahasiswa yang memiliki produk atau usaha dan ingin memperkenalkannya melalui BD Katalog dapat mendaftarkan diri sebagai reseller.',
                'category' => 'Reseller',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana cara mendaftarkan produk?',
                'answer' => 'Daftar sebagai reseller terlebih dahulu. Setelah memiliki akun, kamu dapat mengakses dashboard reseller dan mengajukan produk untuk ditampilkan di katalog.',
                'category' => 'Reseller',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'question' => 'Berapa lama produk ditampilkan setelah diajukan?',
                'answer' => 'Produk akan melalui proses pemeriksaan oleh Super Admin terlebih dahulu. Setelah disetujui, produk dapat ditampilkan di katalog publik.',
                'category' => 'Reseller',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana cara menghubungi Business Development?',
                'answer' => 'Kamu dapat mengunjungi halaman Kontak untuk melihat informasi kontak dan media sosial Business Development.',
                'category' => 'Kontak',
                'sort_order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            ChatbotFaq::updateOrCreate(
                ['question' => $faq['question']],
                $faq
            );
        }
    }
}
