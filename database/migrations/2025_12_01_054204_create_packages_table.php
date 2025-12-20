<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->integer('duration'); // dalam jam
            $table->integer('photo_count'); // jumlah foto
            $table->text('features'); // JSON atau text
            $table->string('image')->nullable();
            $table->enum('category', ['wedding', 'family', 'prewedding', 'babymaternity', 'personal','other']);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
};