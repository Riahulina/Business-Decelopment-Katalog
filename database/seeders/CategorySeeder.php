<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Makanan & Minuman',
                'description' => 'Produk makanan dan minuman karya mahasiswa.',
            ],
            [
                'name' => 'Fashion',
                'description' => 'Produk fashion dan aksesoris karya mahasiswa.',
            ],
            [
                'name' => 'Craft',
                'description' => 'Produk kerajinan dan karya kreatif mahasiswa.',
            ],
            [
                'name' => 'Digital',
                'description' => 'Produk dan layanan digital karya mahasiswa.',
            ],
            [
                'name' => 'Jasa',
                'description' => 'Berbagai layanan dan jasa yang ditawarkan mahasiswa.',
            ],
            [
                'name' => 'Stationery',
                'description' => 'Produk alat tulis dan kebutuhan kreatif mahasiswa.',
            ],
            [
                'name' => 'Beauty & Health',
                'description' => 'Produk kecantikan dan kesehatan karya mahasiswa.',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                [
                    'slug' => Str::slug($category['name']),
                    'description' => $category['description'],
                ]
            );
        }
    }
}