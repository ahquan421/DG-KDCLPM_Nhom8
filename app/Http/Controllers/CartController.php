<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Thêm sản phẩm vào giỏ hàng
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $userId = Auth::id(); // Lấy id của người dùng hiện tại

        // Kiểm tra xem sản phẩm đã có trong giỏ chưa
        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            // Nếu sản phẩm đã có trong giỏ, tăng số lượng lên
            $cartItem->update([
                'quantity' => $cartItem->quantity + $request->quantity
            ]);
        } else {
            // Nếu sản phẩm chưa có trong giỏ, thêm mới
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }

    // Hiển thị giỏ hàng
    public function index()
    {
        $userId = Auth::id();
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();
        
        return view('cart.index', compact('cartItems'));
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($cartId)
    {
        Cart::findOrFail($cartId)->delete();
        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }
}
