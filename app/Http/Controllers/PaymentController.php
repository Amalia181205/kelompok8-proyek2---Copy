<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\PaymentConfirmation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Snap;
use Midtrans\Notification;

class PaymentController extends Controller
{
    private function packageAmount(string $packageName): int
    {
        $packageName = strtolower(trim($packageName));
    
    return match ($packageName) {
        'personal'   => 160000,
        'family'     => 500000,
        'Maternity & Baby'  => 600000,
        'prewedding' => 400000,
        default      => throw new \InvalidArgumentException("Invalid package: {$packageName}"),
    };
    }

    public function menu(int $booking)
    {
        $booking = Booking::findOrFail($booking);
        abort_if($booking->user_id !== Auth::id(), 403);

        $amount = $this->packageAmount($booking->package_name);

        $payment = PaymentConfirmation::where('booking_id', $booking->id)
            ->where('status', 'pending')
            ->first();

        return view('payment.menupembayaran', compact(
            'booking',
            'amount',
            'payment'
        ));
    }

    public function create(Request $request, int $booking)
    {
        $booking = Booking::findOrFail($booking);
        abort_if($booking->user_id !== Auth::id(), 403);

        $amount = $this->packageAmount($booking->package_name);

            \Log::info('Payment Debug', [
            'booking_id' => $booking->id,
            'package_name' => $booking->package_name,
            'amount' => $amount,
            'raw_package_name' => var_export($booking->package_name, true)
        ]);

            if ($amount <= 0) {
            return back()->withErrors(['amount' => 'Invalid package or amount is zero']);
        }

        $payment = PaymentConfirmation::create([
            'booking_id'   => $booking->id,
            'order_id'     => 'BOOK-' . $booking->id . '-' . time(),
            'metode'       => 'Midtrans',
            'status'       => 'pending',
            'gross_amount' => $amount,
        ]);

        // $payment = PaymentConfirmation::firstOrCreate(
        //     [
        //         'booking_id' => $booking->id,
        //         'status'     => 'pending',
        //     ],
        //     [
        //         'order_id' => 'BOOK-' . $booking->id . '-' . time(),
        //         'metode'   => 'Midtrans',
        //         'gross_amount'   => $amount,
        //     ]
        // );

        $snapToken = Snap::getSnapToken([
            'transaction_details' => [
                'order_id'     => $payment->order_id,
                'gross_amount' => (int) $amount,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email'      => Auth::user()->email,
            ],
        ]);

        return view('payment.menupembayaran', compact(
            'booking',
            'payment',
            // 'amount',
            'snapToken'
        ));
    }

    public function callback(Request $request)
    {
        $notif = new Notification();
        Log::info('Midtrans Callback', (array) $notif);

        $payment = PaymentConfirmation::where('order_id', $notif->order_id)->first();
        if (!$payment) return response()->json(['message' => 'Not found'], 404);

        $payment->status = match ($notif->transaction_status) {
            'capture', 'settlement' => 'paid',
            'pending'               => 'pending',
            default                 => 'failed',
        };

        $payment->payload = json_encode($notif);
        $payment->save();

        return response()->json(['status' => 'ok']);
    }

    public function finish()
    {
        return view('payment.finish');
    }

    public function history()
    {
        $payments = PaymentConfirmation::whereHas('booking', fn ($q) =>
            $q->where('user_id', Auth::id())
        )->latest()->get();

        return view('payment.history_pembayaran', compact('payments'));
    }
}
