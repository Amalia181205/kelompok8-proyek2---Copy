<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentConfirmation extends Model
{
    protected $table = 'payment_confirmations';

    protected $fillable = [
        'booking_id',
        'order_id',
        'status',
        'metode',
        'gross_amount',
        'payload',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
