<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_confirmations', function (Blueprint $table) {
            $table->id();

            // relasi ke bookings
            $table->foreignId('booking_id')
                  ->constrained('bookings')
                  ->cascadeOnDelete();

            $table->string('order_id')->unique();
            $table->string('metode')->default('Midtrans');

            $table->integer('gross_amount');

            $table->enum('status', ['pending', 'paid', 'failed'])
                  ->default('pending');

            // simpan callback midtrans
            $table->longText('payload')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_confirmations');
    }
};
