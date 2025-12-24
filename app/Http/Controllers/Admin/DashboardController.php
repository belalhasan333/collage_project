<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard statistics and recent activities.
     */
    public function index()
    {
        // Total counts
        $totalBooks  = Book::count();
        $totalOrders = Order::count();
        $totalUsers  = User::count();

        // Today's date
        $today = Carbon::today();

        // Today's Orders
        $todayOrders = Order::whereDate('created_at', $today)->count();

        // Sales today (sum of price * quantity for completed orders)
        $todaySales = Order::whereDate('created_at', $today)
                        ->where('status', 'completed')
                        ->with('book')
                        ->get()
                        ->sum(function($order) {
                            return $order->book ? $order->book->price * $order->quantity : 0;
                        });

        // Weekly sales (last 7 days, for sales trend chart)
        $startOfWeek = Carbon::now()->startOfWeek();
        $weeklySales = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $sales = Order::whereDate('created_at', $date)
                          ->where('status', 'completed')
                          ->with('book')
                          ->get()
                          ->sum(function($order) {
                              return $order->book ? $order->book->price * $order->quantity : 0;
                          });
            $weeklySales[] = $sales;
        }

        // Percentage change in today's orders compared to yesterday
        $yesterday = Carbon::yesterday();
        $yesterdayOrders = Order::whereDate('created_at', $yesterday)->count();
        $todayOrdersChange = $yesterdayOrders > 0
            ? round((($todayOrders - $yesterdayOrders) / $yesterdayOrders) * 100, 1)
            : ($todayOrders > 0 ? 100 : 0);

        // 5 Most recent orders (for recent order table)
        $recentOrders = Order::with(['user', 'book'])
                            ->latest()
                            ->take(5)
                            ->get();

        return view('dashboard', [
            'totalBooks'        => $totalBooks,
            'totalOrders'       => $totalOrders,
            'totalUsers'        => $totalUsers,
            'todayOrders'       => $todayOrders,
            'todaySales'        => $todaySales,
            'todayOrdersChange' => $todayOrdersChange,
            'weeklySales'       => $weeklySales,
            'recentOrders'      => $recentOrders,
        ]);
    }

}

