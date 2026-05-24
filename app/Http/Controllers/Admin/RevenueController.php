<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Carbon\Carbon;

class RevenueController extends Controller
{
    public function index(Request $request)
    {
        // Lấy năm được chọn (mặc định là năm hiện tại)
        $year = $request->input('year', now()->year);

        // Lấy tổng doanh thu theo tháng
        $revenues = Order::select(
                DB::raw('MONTH(order_date) as month'),
                DB::raw('SUM(total_money) as total')
            )
            ->whereYear('order_date', $year)
            ->groupBy(DB::raw('MONTH(order_date)'))
            ->orderBy(DB::raw('MONTH(order_date)'))
            ->get();

        // Tách dữ liệu cho biểu đồ
        $months = $revenues->pluck('month');
        $totals = $revenues->pluck('total');

        // Tổng doanh thu cả năm
        $totalYear = $revenues->sum('total');

        // Trả về view dashboard (hoặc revenue dashboard)
        return view('admin.dashboard', compact('months', 'totals', 'year', 'totalYear'));
    }
}
