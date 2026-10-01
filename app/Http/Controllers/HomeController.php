<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Collaboration;
use App\Models\News;
use App\Models\Product;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with(['reseller', 'category', 'images'])
            ->where('status', 'approved')
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        $newProducts = Product::with(['reseller', 'category', 'images'])
            ->where('status', 'approved')
            ->where('is_new', true)
            ->latest()
            ->take(6)
            ->get();

        $news = News::where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get();

        $collaborations = Collaboration::where('is_active', true)
            ->get();

        $categories = Category::withCount([
            'products' => function ($query) {
                $query->where('status', 'approved');
            }
        ])->get();

        $settings = SiteSetting::pluck('value', 'key');

        return view('welcome', compact(
            'featuredProducts',
            'newProducts',
            'news',
            'collaborations',
            'categories'
        ));
    }
}
