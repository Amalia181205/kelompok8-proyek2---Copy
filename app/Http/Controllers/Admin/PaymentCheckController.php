<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentConfirmation;

class PaymentCheckController extends Controller
{
    public function index()
    {
        $payments = PaymentConfirmation::with(['booking.user'])
            ->latest()
            ->get();

        return view('admin.payment.index', compact('payments'));
    }
}
