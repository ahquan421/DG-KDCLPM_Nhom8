<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Hiển thị trang checkout 1 sản phẩm
    public function show($id)
    {
        $book = Product::findOrFail($id);

        // lưu trang trước
        session(['back_book' => url()->previous()]);

        return view('user.checkout', compact('book'));
    }

    // Xử lý thanh toán 1 sản phẩm
    public function process(Request $request, $id)
    {
        $book = Product::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $book->quantity,
        ]);

        $quantity = $request->quantity;
        $coupon = $request->coupon;

        // tính tiền
        $total = $book->price * $quantity;

        if ($coupon && strtoupper($coupon) === 'COLIEN') {
            $total = $total * 0.9; // giảm 10%
        }

        session()->forget('back_book');

        return back()->with(
            'success',
            "✅ Thanh toán thành công! Tổng tiền: " .
            number_format($total) . " ₫"
        );
    }

    // CHECKOUT NHIỀU SẢN PHẨM
    public function showMultiple(Request $request)
    {
        $selectedItems = $request->selected_items;

        // chưa chọn sản phẩm
        if (!$selectedItems) {
            return back()->with(
                'error',
                'Vui lòng chọn sản phẩm'
            );
        }

        // lấy các item trong cart đã tick
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->whereIn('id', $selectedItems)
            ->get();

        // tạo mảng books gửi sang view
        $books = [];

        foreach ($cartItems as $item) {
            $books[] = [
                'id' => $item->product->id,
                'name' => $item->product->name,
                'author' => $item->product->author,
                'image' => $item->product->image,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
                'stock' => $item->product->quantity,
            ];
        }

        return view(
            'user.checkout_multiple',
            compact('books')
        );
    }
}