<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Lấy danh sách đơn hàng của user kèm chi tiết
        $orders = Order::with(['orderDetails.product', 'address'])
                       ->where('customer_id', $user->id)
                       ->latest()
                       ->get();

        return view('user.orders.index', compact('orders'));
    }
}
