<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with stats and latest products.
     */
    public function index(): View
    {
        $totalProducts = Product::count();
        $totalImages   = ProductImage::count();
        $latestProducts = Product::with('images')
            ->latest()
            ->take(5)
            ->get();

        $activeProducts   = Product::where('status', 'active')->count();
        $inactiveProducts = Product::where('status', 'inactive')->count();

        return view('dashboard', compact(
            'totalProducts',
            'totalImages',
            'latestProducts',
            'activeProducts',
            'inactiveProducts'
        ));
    }
}
