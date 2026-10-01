<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductHighlight;
use App\Models\ProductImage;
use App\Models\Reseller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $aulia = Reseller::whereHas('user', function ($query) {
            $query->where('email', 'aulia@bdkatalog.test');
        })->first();

        $shinta = Reseller::whereHas('user', function ($query) {
            $query->where('email', 'shinta@bdkatalog.test');
        })->first();

        $nabila = Reseller::whereHas('user', function ($query) {
            $query->where('email', 'nabila@bdkatalog.test');
        })->first();

        $farhan = Reseller::whereHas('user', function ($query) {
            $query->where('email', 'farhan@bdkatalog.test');
        })->first();

        $salsa = Reseller::whereHas('user', function ($query) {
            $query->where('email', 'salsa@bdkatalog.test');
        })->first();

        $makanan = Category::where('name', 'Makanan & Minuman')->first();
        $fashion = Category::where('name', 'Fashion')->first();
        $craft = Category::where('name', 'Craft')->first();
        $digital = Category::where('name', 'Digital')->first();
        $jasa = Category::where('name', 'Jasa')->first();
        $stationery = Category::where('name', 'Stationery')->first();
        $beauty = Category::where('name', 'Beauty & Health')->first();

        $products = [
            [
                'reseller_id' => $aulia->id,
                'category_id' => $makanan->id,
                'name' => 'Matcha Latte',
                'description' => 'Minuman matcha creamy dengan rasa lembut yang cocok untuk menemani aktivitas mahasiswa.',
                'price' => 18000,
                'is_featured' => true,
                'is_new' => true,
                'image' => 'images/products/matcha-latte.jpg',
                'highlights' => [
                    ['title' => 'Fresh & Creamy', 'description' => 'Dibuat dengan bahan berkualitas.', 'icon' => 'sparkles'],
                    ['title' => 'Student Favorite', 'description' => 'Cocok dinikmati kapan saja.', 'icon' => 'heart'],
                ],
            ],
            [
                'reseller_id' => $shinta->id,
                'category_id' => $fashion->id,
                'name' => 'Crochet Bag',
                'description' => 'Tas crochet handmade dengan desain unik dan cocok digunakan untuk berbagai aktivitas.',
                'price' => 85000,
                'is_featured' => true,
                'is_new' => false,
                'image' => 'images/products/crochet-bag.jpg',
                'highlights' => [
                    ['title' => 'Handmade', 'description' => 'Dibuat secara handmade dengan detail.', 'icon' => 'heart'],
                    ['title' => 'Unique Design', 'description' => 'Setiap produk memiliki karakter tersendiri.', 'icon' => 'sparkles'],
                ],
            ],
            [
                'reseller_id' => $nabila->id,
                'category_id' => $makanan->id,
                'name' => 'Dalgona Coffee',
                'description' => 'Kopi dalgona dengan perpaduan rasa manis dan creamy yang nikmat.',
                'price' => 15000,
                'is_featured' => true,
                'is_new' => true,
                'image' => 'images/products/dalgona-coffee.jpg',
                'highlights' => [
                    ['title' => 'Creamy Taste', 'description' => 'Tekstur creamy dengan rasa kopi yang kuat.', 'icon' => 'sparkles'],
                    ['title' => 'Fresh Made', 'description' => 'Dibuat fresh untuk setiap pesanan.', 'icon' => 'clock'],
                ],
            ],
            [
                'reseller_id' => $farhan->id,
                'category_id' => $fashion->id,
                'name' => 'Tote Bag Canvas',
                'description' => 'Tote bag berbahan canvas yang simpel, kuat, dan cocok untuk kebutuhan sehari-hari.',
                'price' => 75000,
                'is_featured' => true,
                'is_new' => false,
                'image' => 'images/products/tote-bag-canvas.jpg',
                'highlights' => [
                    ['title' => 'Durable', 'description' => 'Material canvas yang kuat dan tahan lama.', 'icon' => 'shield-check'],
                    ['title' => 'Minimalist', 'description' => 'Desain simpel yang mudah dipadukan.', 'icon' => 'sparkles'],
                ],
            ],
            [
                'reseller_id' => $aulia->id,
                'category_id' => $stationery->id,
                'name' => 'Aesthetic Notebook',
                'description' => 'Notebook dengan desain aesthetic untuk mencatat ide, tugas, dan aktivitas harian.',
                'price' => 35000,
                'is_featured' => true,
                'is_new' => true,
                'image' => 'images/products/aesthetic-notebook.jpg',
                'highlights' => [
                    ['title' => 'Aesthetic Design', 'description' => 'Desain menarik untuk menemani aktivitasmu.', 'icon' => 'sparkles'],
                    ['title' => 'Practical', 'description' => 'Mudah dibawa ke kampus maupun tempat kerja.', 'icon' => 'package'],
                ],
            ],
            [
                'reseller_id' => $salsa->id,
                'category_id' => $beauty->id,
                'name' => 'Skincare Natural',
                'description' => 'Produk perawatan kulit dengan konsep natural untuk kebutuhan perawatan sehari-hari.',
                'price' => 60000,
                'is_featured' => true,
                'is_new' => false,
                'image' => 'images/products/skincare-natural.jpg',
                'highlights' => [
                    ['title' => 'Natural Concept', 'description' => 'Mengusung konsep bahan natural.', 'icon' => 'leaf'],
                    ['title' => 'Daily Care', 'description' => 'Cocok untuk rutinitas perawatan harian.', 'icon' => 'heart'],
                ],
            ],
            [
                'reseller_id' => $shinta->id,
                'category_id' => $craft->id,
                'name' => 'Beaded Keychain',
                'description' => 'Gantungan kunci handmade dengan kombinasi warna yang dapat disesuaikan.',
                'price' => 25000,
                'is_featured' => false,
                'is_new' => true,
                'image' => 'images/products/beaded-keychain.jpg',
                'highlights' => [
                    ['title' => 'Customizable', 'description' => 'Pilihan warna dapat disesuaikan.', 'icon' => 'sparkles'],
                    ['title' => 'Handmade', 'description' => 'Dibuat dengan proses handmade.', 'icon' => 'heart'],
                ],
            ],
            [
                'reseller_id' => $farhan->id,
                'category_id' => $digital->id,
                'name' => 'Template CV ATS',
                'description' => 'Template CV modern dan ATS-friendly untuk membantu mahasiswa mempersiapkan karier.',
                'price' => 20000,
                'is_featured' => false,
                'is_new' => true,
                'image' => 'images/products/template-cv-ats.jpg',
                'highlights' => [
                    ['title' => 'ATS Friendly', 'description' => 'Dibuat agar mudah dibaca sistem ATS.', 'icon' => 'circle-check'],
                    ['title' => 'Editable', 'description' => 'Mudah disesuaikan dengan kebutuhan.', 'icon' => 'wrench'],
                ],
            ],
            [
                'reseller_id' => $nabila->id,
                'category_id' => $jasa->id,
                'name' => 'Jasa Desain Poster',
                'description' => 'Layanan desain poster untuk event, organisasi, promosi, dan kebutuhan lainnya.',
                'price' => 50000,
                'is_featured' => false,
                'is_new' => false,
                'image' => 'images/products/jasa-desain-poster.jpg',
                'highlights' => [
                    ['title' => 'Custom Design', 'description' => 'Desain dibuat sesuai kebutuhan.', 'icon' => 'wrench'],
                    ['title' => 'Creative', 'description' => 'Konsep visual disesuaikan dengan target audience.', 'icon' => 'sparkles'],
                ],
            ],
            [
                'reseller_id' => $salsa->id,
                'category_id' => $craft->id,
                'name' => 'Custom Gift Box',
                'description' => 'Gift box dengan isi dan desain yang dapat disesuaikan untuk berbagai momen spesial.',
                'price' => 95000,
                'is_featured' => false,
                'is_new' => true,
                'image' => 'images/products/custom-gift-box.jpg',
                'highlights' => [
                    ['title' => 'Custom', 'description' => 'Isi dan desain dapat disesuaikan.', 'icon' => 'sparkles'],
                    ['title' => 'Gift Ready', 'description' => 'Siap diberikan sebagai hadiah.', 'icon' => 'heart'],
                ],
            ],
        ];

        foreach ($products as $data) {
            $slug = Str::slug($data['name']);

            $product = Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'reseller_id' => $data['reseller_id'],
                    'category_id' => $data['category_id'],
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'status' => 'approved',
                    'rejection_reason' => null,
                    'is_featured' => $data['is_featured'],
                    'is_new' => $data['is_new'],
                ]
            );

            ProductImage::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'sort_order' => 1,
                ],
                [
                    'image' => $data['image'],
                ]
            );

            foreach ($data['highlights'] as $index => $highlight) {
                ProductHighlight::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'title' => $highlight['title'],
                    ],
                    [
                        'description' => $highlight['description'],
                        'icon' => $highlight['icon'],
                        'sort_order' => $index + 1,
                    ]
                );
            }
        }
    }
}
