<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'bookings'; 

    protected $fillable = [
        'booking_id',
        'total_price',
        'payment_method',
        'payment_status',
        'order_status',
        'notes',
    ];

    // Relasi ke Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    // OPTIONAL: relasi langsung ke user (melewati booking)
    public function user()
    {
        return $this->hasOneThrough(
            User::class,     // model tujuan
            Booking::class,  // model perantara
            'id',            // foreign key di bookings (id booking)
            'id',            // foreign key di users
            'booking_id',    // foreign key di orders
            'user_id'        // foreign key di bookings
        );
    }
}
