<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // ===== BỘ LỌC NĂM / THÁNG =====
        $year  = $request->input('year', now()->year);
        $month = $request->input('month');

        // ===== THỐNG KÊ CƠ BẢN =====
        $totalProducts   = Product::count();
        $totalCategories = Category::count();
        $totalOrders     = Order::count();
        $totalClients    = User::where('usertype', 'user')->count();

        // ===== 5 ĐƠN HÀNG MỚI NHẤT =====
        $recentOrders = Order::with(['customer', 'address'])
            ->latest()
            ->take(5)
            ->get();

        $recentOrdersTotal = $recentOrders->sum('total_money');

        // ===== DOANH THU THEO THÁNG / NĂM =====
        $revenuesQuery = Order::selectRaw('MONTH(order_date) as month, SUM(total_money) as total')
            ->whereYear('order_date', $year)
            ->whereIn('status', ['completed', 'paid', 'done'])
            ->groupBy('month')
            ->orderBy('month');

        if ($month) {
            $revenuesQuery->whereMonth('order_date', $month);
        }

        $revenues = $revenuesQuery->get();

        // Dữ liệu cho biểu đồ và tổng kết
        $months = $revenues->pluck('month');   
        $totals = $revenues->pluck('total');   
        $totalYear = $revenues->sum('total'); 

        // ===== TOP 5 SẢN PHẨM BÁN CHẠY =====
        $topProductsQuery = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                DB::raw('SUM(order_details.quantity) as total_sold'),
                DB::raw('SUM(order_details.price * order_details.quantity) as total_revenue')
            )
            ->whereIn('orders.status', ['completed', 'paid', 'done'])
            ->whereYear('orders.order_date', $year);

        if ($month) {
            $topProductsQuery->whereMonth('orders.order_date', $month);
        }

        $topProducts = $topProductsQuery
            ->groupBy('products.id', 'products.name', 'products.price')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        // ===== TRẢ DỮ LIỆU RA VIEW =====
        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalOrders',
            'totalClients',
            'recentOrders',
            'recentOrdersTotal',
            'revenues',
            'months',
            'totals',
            'totalYear',
            'year',
            'month',
            'topProducts'
        ));
    }
}
