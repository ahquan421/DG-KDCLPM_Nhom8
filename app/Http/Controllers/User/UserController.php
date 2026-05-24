<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class UserController extends Controller
{
    public function index()
    {
        // Lấy toàn bộ sách từ DB
        $products = Product::all();

        // Truyền sang view user.dashboard
        return view('user.dashboard', compact('products'));
    }

}
