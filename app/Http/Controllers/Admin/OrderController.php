<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Address;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách đơn hàng (kèm lọc, tìm kiếm, phân trang)
     */
    public function index(Request $request)
    {
        $query = Order::with(['customer', 'address', 'orderDetails.product']);

        // ===== LỌC THEO TRẠNG THÁI =====
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // ===== TÌM KIẾM THEO ID HOẶC TÊN SẢN PHẨM =====
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhereHas('orderDetails.product', function ($sub) use ($search) {
                      $sub->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // ===== PHÂN TRANG (page_size) =====
        $pageSize = $request->get('page_size', 9);
        $orders = $query->latest()->paginate($pageSize);

        // ===== ĐẾM SỐ LƯỢNG ĐƠN THEO TRẠNG THÁI =====
        $shippingCount  = Order::where('status', 'shipping')->count();
        $completedCount = Order::where('status', 'completed')->count();
        $cancelledCount = Order::where('status', 'cancelled')->count();

        return view('admin.orders.index', compact(
            'orders',
            'shippingCount',
            'completedCount',
            'cancelledCount'
        ));
    }

    /**
     * Xem chi tiết đơn hàng
     */
    public function show($id)
    {
        $order = Order::with(['customer', 'address', 'orderDetails.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Form thêm đơn hàng mới
     */
    public function create()
    {
        $customers = User::where('usertype', 'user')->get();
        $addresses = Address::all();
        $products  = Product::all();

        return view('admin.orders.create', compact('customers', 'addresses', 'products'));
    }

    /**
     * Lưu đơn hàng mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'address_id'  => 'required|exists:addresses,id',
        ]);

        Order::create([
            'customer_id' => $request->customer_id,
            'address_id'  => $request->address_id,
            'status'      => 'pending',
            'total_money' => 0, // sẽ cập nhật sau khi thêm chi tiết đơn
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Thêm đơn hàng thành công');
    }

    /**
     * Form chỉnh sửa đơn hàng
     */
    public function edit($id)
    {
        $order = Order::with(['customer', 'address', 'orderDetails.product'])->findOrFail($id);
        $customers = User::where('usertype', 'user')->get();
        $addresses = Address::all();
        $statuses  = ['pending', 'confirmed', 'shipping', 'completed', 'cancelled'];

        return view('admin.orders.edit', compact('order', 'customers', 'addresses', 'statuses'));
    }

    /**
     * Cập nhật trạng thái đơn hàng
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,confirmed,shipping,completed,cancelled'
        ]);

        $order->update([
            'status'       => $request->status,
            'total_money'  => $this->calculateTotalMoney($order->id),
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công');
    }

    /**
     * Tính tổng tiền đơn hàng
     */
    private function calculateTotalMoney($orderId)
    {
        $orderDetails = Order::find($orderId)->orderDetails;
        $total = 0;

        foreach ($orderDetails as $detail) {
            $total += $detail->price * $detail->quantity;
        }

        return $total;
    }

    /**
     * Xóa đơn hàng
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Xóa đơn hàng thành công');
    }
}
