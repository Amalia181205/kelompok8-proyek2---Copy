<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class ScheduleController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('user')
        ->orderBy('booking_date')
        ->get();


        return view('admin.schedule.index', compact('bookings'));
    }
}
