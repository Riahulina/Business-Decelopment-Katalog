<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $reseller = $request->user()->reseller;

        abort_unless(
            $reseller,
            403,
            'Akun kamu belum terdaftar sebagai reseller.'
        );

        $products = $reseller->products();

        $totalProducts = (clone $products)->count();

        $approvedProducts = (clone $products)
            ->where('status', 'approved')
            ->count();

        $pendingProducts = (clone $products)
            ->where('status', 'pending')
            ->count();

        $rejectedProducts = (clone $products)
            ->where('status', 'rejected')
            ->count();

        $recentProducts = (clone $products)
            ->with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'approvedProducts',
            'pendingProducts',
            'rejectedProducts',
            'recentProducts'
        ));
    }
}
