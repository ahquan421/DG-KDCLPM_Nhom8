<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // Hiển thị trang checkout
    public function show($id)
    {
        $book = Product::findOrFail($id);
        return view('user.checkout', compact('book'));
    }

    // Xử lý khi người dùng submit thanh toán
    public function process(Request $request, $id)
    {
        $book = Product::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $book->quantity,
        ]);

        $quantity = $request->quantity;
        $coupon = $request->coupon;

        // Tính tiền
        $total = $book->price * $quantity;
        if ($coupon && strtoupper($coupon) === 'COLIEN') {
            $total = $total * 0.9; // giảm 10%
        }

        // ⚡ Ở đây bạn có thể tạo Order hoặc redirect tới trang thanh toán thành công
        return back()->with('success', "Thanh toán thành công. Tổng tiền: " . number_format($total) . " ₫");
    }
}
