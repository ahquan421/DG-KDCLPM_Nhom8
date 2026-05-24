<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // 10 sản phẩm hiển thị trong phần "Best Online Bookstore"
        $products = Product::latest()->take(10)->get();

        // 5 sản phẩm mới nhất hiển thị ở "Recently Added"
        $recentBooks = Product::orderBy('created_at', 'desc')->take(5)->get();

        return view('user.dashboard', compact('products', 'recentBooks'));
    }
}
