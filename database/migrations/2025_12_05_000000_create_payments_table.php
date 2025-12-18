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
        $table->foreignId('booking_id')->constrained()->onDelete('cascade');
        $table->string('order_id')->unique();
        $table->string('metode');
        $table->string('status')->default('pending');
        $table->string('payment_type')->nullable();
        $table->integer('gross_amount');
        $table->string('snap_token')->nullable();
        $table->json('payload')->nullable();
        $table->timestamps();
    });

    }


    public function down(): void
    {
        Schema::dropIfExists('payment_confirmations');
    }

};
