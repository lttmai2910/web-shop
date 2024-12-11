<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class StatisticController extends Controller
{
    public function index(Request $request): Response
    {
        $year = $request->input('year', Carbon::now()->year);
        $today = Carbon::today();

        // Thống kê theo tháng
        $monthlyStatistic = OrderDetail::selectRaw('MONTH(orders.date_order) as month, SUM(order_details.quantity) as total_products_sold, SUM(order_details.quantity * order_details.discount_price) as total_revenue')
            ->join('orders', 'order_details.id_order', '=', 'orders.id')
            ->whereYear('orders.date_order', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Thống kê theo quý
        $quarterlyStatistic = OrderDetail::selectRaw('QUARTER(orders.date_order) as quarter, SUM(order_details.quantity) as total_products_sold, SUM(order_details.quantity * order_details.discount_price) as total_revenue')
            ->join('orders', 'order_details.id_order', '=', 'orders.id')
            ->whereYear('orders.date_order', $year)
            ->groupBy('quarter')
            ->orderBy('quarter')
            ->get();

        // Thống kê theo năm
        $years = OrderDetail::selectRaw('YEAR(orders.date_order) as year, SUM(order_details.quantity) as total_products_sold, SUM(order_details.quantity * order_details.discount_price) as total_revenue')
            ->join('orders', 'order_details.id_order', '=', 'orders.id')
            ->whereYear('orders.date_order', $year)
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        // Đếm số đơn hàng trong ngày hôm nay
        $todayOrders = Order::whereDate('date_order', $today)->count();

        // Lưu thông tin thống kê vào bảng Statistic
        foreach ($monthlyStatistic as $statistic) {
            // $date_statistic = Carbon::createFromDate($year, $statistic->month, 1)->endOfMonth();
            // $total_revenue = $statistic->total_revenue;
            // $total_products_sold = $statistic->total_products_sold;

            // Statistic::updateOrCreate(
            //     ['date_statistic' => $date_statistic],
            //     ['total_revenue' => $total_revenue, 'total_products_sold' => $total_products_sold]
            // );
        }

        return Inertia::render('Admin/Statistic/Index', [
            'monthlyStatistic' => $monthlyStatistic,
            'quarterlyStatistic' => $quarterlyStatistic,
            'years' => $years,
            'year' => $year,
            'todayOrders' => $todayOrders,
        ]);
    }
}
