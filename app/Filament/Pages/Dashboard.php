<?php

namespace App\Filament\Pages;

use App\Models\Product;
use App\Models\Reseller;
use App\Models\Category;
use Filament\Pages\Page;
use BackedEnum;
use Filament\Support\Icons\Heroicon;

class Dashboard extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Dashboard';
    protected string $view = 'filament.pages.dashboard';

    public function getStats(): array
    {
        return [
            'total_products'    => Product::count(),
            'pending_products'  => Product::where('status', 'pending')->count(),
            'approved_products' => Product::where('status', 'approved')->count(),
            'total_resellers'   => Reseller::count(),
            'total_categories'  => Category::count(),
        ];
    }
}
