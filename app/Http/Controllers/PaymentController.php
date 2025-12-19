<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\PaymentConfirmation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Setup Midtrans config
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    private function packageAmount(string $packageName): int
    {
        $packageName = strtolower(trim($packageName));
        
        return match ($packageName) {
            'personal gallery' => 160000,
            'family' => 500000,
            'maternity & baby' => 600000,
            'prewedding' => 400000,
            default => throw new \InvalidArgumentException("Invalid package: {$packageName}"),
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

    \Log::info('Payment Create', [
        'booking_id' => $booking->id,
        'package' => $booking->package_name,
        'amount' => $amount,
        'user' => Auth::id()
    ]);

    if ($amount <= 0) {
        return back()->withErrors(['amount' => 'Invalid package or amount is zero']);
    }

    // Buat payment record
    $payment = PaymentConfirmation::create([
        'booking_id' => $booking->id,
        'order_id' => 'BOOK-' . $booking->id . '-' . time() . '-' . rand(100, 999),
        'metode' => 'Midtrans',
        'status' => 'pending',
        'gross_amount' => $amount,
        'user_id' => Auth::id(),
    ]);

    // Buat parameter untuk Snap
    $params = [
        'transaction_details' => [
            'order_id' => $payment->order_id,
            'gross_amount' => (int) $amount,
        ],
        'customer_details' => [
            'first_name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'phone' => Auth::user()->phone ?? '081234567890',
        ],
        'callbacks' => [
            'finish' => url('/payment/finish'),
        ]
    ];

    try {
        $snapToken = Snap::getSnapToken($params);
        
        \Log::info('✅ Snap Token Generated', [
            'order_id' => $payment->order_id,
            'token_length' => strlen($snapToken),
            'token_preview' => substr($snapToken, 0, 50) . '...'
        ]);
        
    } catch (\Exception $e) {
        \Log::error('❌ Midtrans Snap Error: ' . $e->getMessage());
        return back()->withErrors(['midtrans' => 'Gagal membuat transaksi: ' . $e->getMessage()]);
    }

    // ✅ PASTIKAN RENDER VIEW payment.pay
    return view('payment.pay', compact(
        'booking',
        'payment',
        'snapToken'
    ));
}    public function callback(Request $request)
    {
        try {
            $notif = new Notification();
            
            \Log::info('========== MIDTRANS CALLBACK START ==========');
            \Log::info('Notification Object:', (array) $notif);
            \Log::info('Raw POST:', $_POST);
            \Log::info('Raw GET:', $_GET);
            
            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $order_id = $notif->order_id;
            $fraud = $notif->fraud_status;

            \Log::info('Parsed Data:', [
                'order_id' => $order_id,
                'transaction_status' => $transaction,
                'payment_type' => $type,
                'fraud_status' => $fraud,
                'status_code' => $notif->status_code
            ]);

            // Cari payment berdasarkan order_id
            $payment = PaymentConfirmation::where('order_id', $order_id)->first();
            
            if (!$payment) {
                \Log::error('Payment not found for order_id: ' . $order_id);
                return response()->json(['message' => 'Payment not found'], 404);
            }

            \Log::info('Payment Found:', [
                'payment_id' => $payment->id,
                'current_status' => $payment->status
            ]);

            // Update status berdasarkan notifikasi Midtrans
            if ($transaction == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $payment->status = 'challenge';
                    } else {
                        $payment->status = 'paid';
                    }
                }
            } elseif ($transaction == 'settlement') {
                $payment->status = 'paid';
            } elseif ($transaction == 'pending') {
                $payment->status = 'pending';
            } elseif ($transaction == 'deny') {
                $payment->status = 'failed';
            } elseif ($transaction == 'expire') {
                $payment->status = 'expired';
            } elseif ($transaction == 'cancel') {
                $payment->status = 'canceled';
            }

            // Simpan payload lengkap
            $payment->payload = json_encode($notif);
            $payment->transaction_id = $notif->transaction_id ?? null;
            $payment->payment_type = $type;
            $payment->transaction_time = $notif->transaction_time ?? null;
            $payment->settlement_time = $notif->settlement_time ?? null;
            
            $payment->save();
            
            \Log::info('Payment Updated:', [
                'new_status' => $payment->status,
                'payment_type' => $payment->payment_type
            ]);

            // Jika berhasil, update booking status juga
            if ($payment->status == 'paid') {
                $booking = Booking::find($payment->booking_id);
                if ($booking) {
                    $booking->payment_status = 'paid';
                    $booking->save();
                    \Log::info('Booking updated to paid:', ['booking_id' => $booking->id]);
                }
            }

            \Log::info('========== MIDTRANS CALLBACK END ==========');

            return response()->json(['status' => 'ok', 'message' => 'Callback processed']);

        } catch (\Exception $e) {
            \Log::error('Callback Error: ' . $e->getMessage());
            \Log::error('Stack Trace: ' . $e->getTraceAsString());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function finish(Request $request)
    {
        $order_id = $request->query('order_id');
        $status_code = $request->query('status_code');
        $transaction_status = $request->query('transaction_status');
        
        \Log::info('Finish Page Accessed', [
            'order_id' => $order_id,
            'status_code' => $status_code,
            'transaction_status' => $transaction_status,
            'all_params' => $request->all()
        ]);

        if ($order_id) {
            $payment = PaymentConfirmation::where('order_id', $order_id)->first();
            
            if ($payment) {
                // Jika status masih pending, cek manual ke Midtrans
                if ($payment->status == 'pending') {
                    // Anda bisa tambahkan logic untuk cek status via API Midtrans
                }
                
                return view('payment.finish', [
                    'success' => in_array($payment->status, ['paid', 'settlement', 'capture']),
                    'payment' => $payment,
                    'status' => $payment->status,
                    'message' => $this->getStatusMessage($payment->status)
                ]);
            }
        }

        // Fallback
        return view('payment.finish', [
            'success' => false,
            'message' => 'Transaksi tidak ditemukan'
        ]);
    }

    public function error(Request $request)
    {
        \Log::info('Payment Error Page', $request->all());
        
        return view('payment.error', [
            'order_id' => $request->query('order_id'),
            'status_code' => $request->query('status_code'),
            'message' => 'Terjadi kesalahan dalam pembayaran'
        ]);
    }

    public function pending(Request $request)
    {
        return view('payment.pending', [
            'order_id' => $request->query('order_id')
        ]);
    }

    private function getStatusMessage($status)
    {
        return match($status) {
            'paid', 'settlement' => 'Pembayaran berhasil!',
            'pending' => 'Menunggu pembayaran',
            'failed', 'deny' => 'Pembayaran gagal',
            'expired' => 'Pembayaran kadaluarsa',
            'cancel' => 'Pembayaran dibatalkan',
            default => 'Status pembayaran tidak diketahui'
        };
    }

    public function history()
    {
        $payments = PaymentConfirmation::where('user_id', Auth::id())
            ->with('booking')
            ->latest()
            ->get();

        return view('payment.history_pembayaran', compact('payments'));
    }
}