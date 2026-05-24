<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Trang danh sách sản phẩm (Shop Page)
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // ====== Lọc theo danh mục ======
        if ($categoryId = $request->input('category')) {
            $query->where('category_id', $categoryId);
        }

        // ====== Sắp xếp ======
        switch ($request->input('sort')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // ====== Lấy dữ liệu ======
        $products = $query->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->get();

        // Trả về view chính xác
        return view('user.products.index', compact('products', 'categories'));
    }

    /**
     * Trang chi tiết sản phẩm
     */
    public function show($id)
    {
        // Lấy sản phẩm kèm danh mục
        $book = Product::with('category')->findOrFail($id);

        // Lấy các sản phẩm khác cùng danh mục (trừ sản phẩm hiện tại)
        $relatedBooks = Product::where('category_id', $book->category_id)
                            ->where('id', '!=', $book->id)
                            ->take(4)
                            ->get();

        return view('user.products.show', compact('book', 'relatedBooks'));
    }
}
