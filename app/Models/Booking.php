<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_name',
        'booking_date',
        'status',
    ];

    // Relationship to user (User model uses buat_akun table)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Helper to check if a user has booked a package
    public static function userHasBooked($userId, $packageName)
    {
        return self::where('user_id', $userId)
            ->where('package_name', $packageName)
            ->where(function($q){ $q->where('status', 'pending')->orWhere('status', 'booked'); })
            ->exists();
    }
}
