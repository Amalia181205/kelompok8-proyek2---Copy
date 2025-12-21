<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Order;
use App\Models\PaymentConfirmation;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        $title = 'Admin Dashboard';
        $slug  = 'dashboard';

        // Pesan pelanggan terbaru
        $messages = Contact::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Statistik box
        $totalBooking   = Order::count();
        $todayBooking   = Order::whereDate('created_at', Carbon::today())->count();
        $pendingPayment = PaymentConfirmation::where('status', 'pending')->count();

        // 🔥 INI YANG SEBELUMNYA BIKIN ERROR
        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('Admin.layoutadmin.dashboard', compact(
            'title',
            'slug',
            'messages',
            'totalBooking',
            'todayBooking',
            'pendingPayment',
            'recentOrders'
        ));
    }
}
