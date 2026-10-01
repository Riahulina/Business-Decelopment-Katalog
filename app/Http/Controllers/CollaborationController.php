<?php

namespace App\Http\Controllers;

use App\Models\Collaboration;
use App\Models\News;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

class CollaborationController extends Controller
{
    public function index()
    {
        $collaborations = Collaboration::where('is_active', true)
            ->latest()
            ->get();

        $news = News::published()
            ->latest('published_at')
            ->get();

        // Strip "Jelajahi Produk Lainnya"
        $products = Product::with('images')
            ->where('status', 'approved')          // SESUAIKAN: nilai status produk yang tampil publik
            ->latest()
            ->take(4)
            ->get()
            ->map(function ($product) {
                $image = $product->images->first();

                return [
                    'name'  => $product->name,
                    'price' => $product->price,
                    // SESUAIKAN: nama kolom path foto di tabel product_images
                    'image' => News::resolveUrl($image?->path),
                    // SESUAIKAN: nama route detail produk
                    'url'   => Route::has('products.show')
                        ? route('products.show', $product->slug)
                        : url('/produk'),
                ];
            });

        return view('collaborations.index', compact(
            'collaborations',
            'news',
            'products'
        ));
    }
}
