<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // relasi ke booking(frontend)
            $table->foreignId('booking_id')
                  ->constrained('booking')
                  ->onDelete('cascade');

            $table->integer('total_price')->default(0);

            $table->string('payment_method')->nullable(); // transfer, cod, e-wallet
            $table->string('payment_status')->default('unpaid'); // unpaid, paid
            $table->string('order_status')->default('pending');   // pending, processing, completed, cancelled
            
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};