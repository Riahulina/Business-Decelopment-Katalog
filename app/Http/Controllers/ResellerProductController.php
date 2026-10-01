<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductHighlight;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResellerProductController extends Controller
{
    public function index(Request $request)
    {
        $reseller = $request->user()->reseller;
        $products = $reseller ? $reseller->products()->with('category')->latest()->get() : collect();
        return view('reseller.products', compact('products'));
    }

    // STEP 3: ambil kategori, lalu tampilkan form (STEP 4-5)
    public function create(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        return view('reseller.products.create', compact('categories'));
    }

    // STEP 6-9: simpan produk, foto, keunggulan, status pending
    public function store(Request $request)
    {
        $reseller = $request->user()->reseller;
        abort_unless($reseller, 403, 'Akun kamu belum terdaftar sebagai reseller.');

        $data = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'category_id'   => ['required', 'exists:categories,id'],
            'price'         => ['required', 'numeric', 'min:0'],
            'description'   => ['required', 'string', 'max:2000'],
            'images'        => ['required', 'array', 'min:1'],
            'images.*'      => ['image', 'max:2048'],
            'highlight_title' => ['nullable', 'array'],
            'highlight_title.*' => ['nullable', 'string', 'max:255'],
        ]);

        // STEP 6: simpan ke products, reseller_id otomatis dari akun login
        $product = Product::create([
            'reseller_id' => $reseller->id,
            'category_id' => $data['category_id'],
            'name'        => $data['name'],
            'slug'        => Str::slug($data['name']) . '-' . Str::random(5),
            'description' => $data['description'],
            'price'       => $data['price'],
            'status'      => 'pending', // STEP 9
        ]);

        // STEP 7: simpan foto ke product_images
        foreach ($request->file('images', []) as $i => $file) {
            $path = $file->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'image'      => $path,
                'sort_order' => $i + 1,
            ]);
        }

        // STEP 8: simpan keunggulan ke product_highlights
        foreach ($request->input('highlight_title', []) as $title) {
            if (trim($title) !== '') {
                ProductHighlight::create([
                    'product_id' => $product->id,
                    'title'      => $title,
                ]);
            }
        }

        return redirect()->route('reseller.products')
            ->with('status', 'Produk berhasil diajukan dan menunggu persetujuan admin.');
    }
}
