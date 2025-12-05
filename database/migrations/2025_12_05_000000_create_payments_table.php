<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->integer('amount')->default(0);
            $table->string('metode')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
