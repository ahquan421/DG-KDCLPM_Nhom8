<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Hiển thị giỏ hàng của user hiện tại
     */
    public function index()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();

        return view('user.cart.index', compact('cartItems'));
    }



    /**
     * Thêm sản phẩm vào giỏ
     */
    public function add(Request $request, $id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($id);

        // Tìm hoặc tạo mới sản phẩm trong giỏ
        $cartItem = Cart::firstOrCreate(
            ['user_id' => $user->id, 'product_id' => $id],
            ['quantity' => 0]
        );

        $cartItem->quantity += $request->input('quantity', 1);
        $cartItem->save();

        return redirect()->back()->with('success', 'Added to cart successfully!');
    }

    /**
     * Cập nhật số lượng (+ / -)
     */
    public function update(Request $request, $id)
    {
        $cartItem = Cart::findOrFail($id);

        if ($request->action === 'increase') {
            $cartItem->quantity++;
        } elseif ($request->action === 'decrease' && $cartItem->quantity > 1) {
            $cartItem->quantity--;
        }

        $cartItem->save();

        return redirect()->back()->with('success', 'Cart updated!');
    }

    /**
     * Xóa sản phẩm khỏi giỏ
     */
    public function remove($id)
    {
        $user = Auth::user();

        Cart::where('user_id', $user->id)
            ->where('id', $id)
            ->delete();

        return redirect()->back()->with('success', 'Item removed from cart.');
    }
    public function checkoutMultiple(Request $request)
    {
        $selected = $request->input('selected_items', []);

        if (empty($selected)) {
            return redirect()->back()->with('error', 'Vui lòng chọn ít nhất 1 sản phẩm để thanh toán.');
        }

        $cart = session()->get('cart', []);
        $books = [];

        foreach ($selected as $id) {
            if (isset($cart[$id])) {
                $books[] = $cart[$id];
            }
        }

        return view('user.checkout_multiple', compact('books'));
    }
}
