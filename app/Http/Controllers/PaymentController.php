<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    private function packageAmount($packageName)
    {
        switch ($packageName) {
            case 'personal': return 160000;
            case 'family': return 50000;
            case 'maternity': return 600000;
            case 'prewedding': return 400000;
            default: return 0;
        }
    }

    // Show payment menu for a booking
    public function menu($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $amount = $this->packageAmount($booking->package_name);

        return view('payment.menu_pembayaran', compact('booking', 'amount'));
    }

    // Create a payment record and display QRIS placeholder
    public function create(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $payment = Payment::create([
            'booking_id' => $booking->id,
            'status' => 'pending',
            'metode' => 'QRIS',
            'amount' => $this->packageAmount($booking->package_name),
        ]);

        $amount = $payment->amount;

        return view('payment.menu_pembayaran', compact('booking', 'payment', 'amount'));
    }

    // Simulated confirmation (in real world a webhook would handle this)
    public function confirm($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        if ($payment->booking->user_id !== Auth::id()) {
            abort(403);
        }

        $payment->status = 'paid';
        $payment->save();

        return redirect()->route('payment.history')->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

    // Show transaction history for logged in user
    public function history()
    {
        $userId = Auth::id();

        $payments = Payment::whereHas('booking', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->with('booking')->orderBy('created_at', 'desc')->get();

        return view('payment.history_pembayaran', compact('payments'));
    }
}
