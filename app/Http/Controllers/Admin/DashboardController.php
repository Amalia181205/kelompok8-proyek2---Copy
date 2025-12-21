<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Buyer;
use App\Models\PaymentConfirmation;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        $title = 'Admin Dashboard';
        $slug = 'dashboard';

        // Ambil semua pesan dari kontak terbaru
        $messages = Contact::orderBy('created_at', 'desc')->get();

        // Statistik untuk small boxes
        $totalBooking   = Order::count(); // Total semua booking
        $todayBooking   = Order::whereDate('created_at', now())->count(); // Booking hari ini
        $pendingPayment = PaymentConfirmation::where('status', 'pending')->count(); // Pembayaran pending

        // Kirim semua data ke view
        return view('Admin.layoutadmin.dashboard', compact(
            'title',
            'slug',
            'messages',        
            'totalBooking',
            'todayBooking',
            'pendingPayment'
        ));
    }
}

//namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\Contact;

// class DashboardController extends Controller
// {
//     /**
//      * Show admin dashboard
//      */
//     public function index()
//     {
//         $title = 'Admin Dashboard';
//         $slug = 'dashboard';

//         // Ambil semua pesan dari kontak
//     $messages = Contact::orderBy('created_at', 'desc')->get();

//         return view('Admin.layoutadmin.dashboard', compact('title', 'slug', 'messages'));
//     }
// } 