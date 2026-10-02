<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Reseller;

class ProductController extends Controller
{
    public function index()
    {
        $query = Product::with(['reseller', 'category', 'images'])
            ->where('status', 'approved');

        if (request()->filled('category')) {
            $query->whereHas('category', function ($q) {
                $q->where('slug', request('category'));
            });
        }

        if (request()->filled('q')) {
            $search = request('q');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('reseller', function ($q) use ($search) {
                        $q->where('nama_lengkap', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        $products = $query
            ->latest()
            ->get();

        $popularProducts = Product::with(['reseller', 'category', 'images'])
            ->where('status', 'approved')
            ->where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();

        $newProducts = Product::with(['reseller', 'category', 'images'])
            ->where('status', 'approved')
            ->where('is_new', true)
            ->latest()
            ->take(3)
            ->get();

        $categories = Category::withCount([
            'products' => function ($query) {
                $query->where('status', 'approved');
            }
        ])->get();

        $resellers = Reseller::with('products')
            ->whereHas('products', function ($query) {
                $query->where('status', 'approved');
            })
            ->take(5)
            ->get();

        return view('products.index', compact(
            'products',
            'categories',
            'popularProducts',
            'newProducts',
            'resellers'
        ));
    }

    public function show(string $slug)
    {
        $product = Product::with([
            'reseller',
            'category',
            'images',
            'highlights',
        ])
            ->where('slug', $slug)
            ->where('status', 'approved')
            ->firstOrFail();

        $similarProducts = Product::with([
            'reseller',
            'category',
            'images',
        ])
            ->where('status', 'approved')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        return view('products.show', compact(
            'product',
            'similarProducts'
        ));
    }
}
