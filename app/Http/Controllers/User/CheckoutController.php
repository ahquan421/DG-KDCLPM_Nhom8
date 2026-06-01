<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Address;

class CheckoutController extends Controller
{
    // ==========================
    // CHECKOUT 1 SẢN PHẨM
    // ==========================
    public function show($id)
    {
        $book = Product::findOrFail($id);

        session(['back_book' => url()->previous()]);

        return view('user.checkout', compact('book'));
    }

    public function process(Request $request, $id)
    {
        $book = Product::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $book->quantity,
        ]);

        $quantity = $request->quantity;

        // lấy địa chỉ đầu tiên của user
        $address = Address::where('user_id', Auth::id())->first();

        // nếu chưa có địa chỉ
        if (!$address) {
            return back()->with(
                'error',
                'Vui lòng cập nhật địa chỉ trước khi đặt hàng'
            );
        }

        $total = $book->price * $quantity;

        // lưu orders
        $order = Order::create([
            'date' => now(),
            'status' => 'pending',
            'total_money' => $total,
            'customer_id' => Auth::id(),
            'address_id' => $address->id,
        ]);

        // lưu order_details
        OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => $book->id,
            'quantity' => $quantity,
            'price' => $book->price,
        ]);

        return redirect()
            ->route('user.orders.index')
            ->with('success', 'Đặt hàng thành công!');
    }
    // ==========================
    // CHECKOUT NHIỀU SẢN PHẨM
    // ==========================
    public function showMultiple(Request $request)
    {
        $selectedItems =
            $request->selected_items;

        if (!$selectedItems) {
            return back()->with(
                'error',
                'Vui lòng chọn sản phẩm'
            );
        }

        $cartItems = Cart::with('product')
            ->where(
                'user_id',
                Auth::id()
            )
            ->whereIn(
                'id',
                $selectedItems
            )
            ->get();

        $books = [];

        foreach ($cartItems as $item) {
            $books[] = [
                'id' =>
                $item->product->id,
                'name' =>
                $item->product->name,
                'author' =>
                $item->product->author,
                'image' =>
                $item->product->image,
                'price' =>
                $item->product->price,
                'quantity' =>
                $item->quantity,
                'stock' =>
                $item->product->quantity,
            ];
        }

        return view(
            'user.checkout_multiple',
            compact('books')
        );
    }

    // ==========================
    // PROCESS MULTIPLE
    // ==========================
    public function processMultiple(
        Request $request
    ) {
        $selectedItems =
            $request->selected_items;

        if (!$selectedItems) {
            return back()->with(
                'error',
                'Không có sản phẩm'
            );
        }

        $cartItems = Cart::with('product')
            ->where(
                'user_id',
                Auth::id()
            )
            ->whereIn(
                'product_id',
                $selectedItems
            )
            ->get();

        $total = 0;

        foreach ($cartItems as $item) {
            $total +=
                $item->product->price *
                $item->quantity;
        }

        // mã giảm giá
        if (
            $request->coupon &&
            strtoupper(
                $request->coupon
            ) === 'COLIEN'
        ) {
            $total *= 0.9;
        }

        // tạo order
        $order = Order::create([
            'date' => now(),
            'status' => 'pending',
            'total_money' => $total,
            'customer_id' => Auth::id(),
            'address_id' => null,
        ]);

        // tạo order details
        foreach ($cartItems as $item) {

            OrderDetail::create([
                'quantity' =>
                $item->quantity,
                'price' =>
                $item->product->price,
                'order_id' =>
                $order->id,
                'product_id' =>
                $item->product->id,
            ]);

            // trừ kho
            $item->product->decrement(
                'quantity',
                $item->quantity
            );

            // xóa khỏi cart
            $item->delete();
        }

        return redirect()
            ->route(
                'user.orders.index'
            )
            ->with(
                'success',
                'Đặt hàng thành công!'
            );
    }
}
