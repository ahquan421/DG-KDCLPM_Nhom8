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

        // ✅ Thêm dòng này để lưu lại trang trước (trang chi tiết sách)
        session(['back_book' => url()->previous()]);

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

        // (Tuỳ chọn) Xóa session sau khi thanh toán xong
        session()->forget('back_book');

        return back()->with('success', "✅ Thanh toán thành công! Tổng tiền: " . number_format($total) . " ₫");
    }
}
