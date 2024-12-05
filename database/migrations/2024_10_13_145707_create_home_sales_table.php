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
        Schema::create('home_sales', function (Blueprint $table) {
            $table->id();
            $table->enum('product' , ['buff_milk' , 'cow_milk' , 'other']);
            $table->double('quantity');
            $table->double('price');
            $table->double('total_price');
            $table->foreignId('user_id')->constrained()->on('users');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_sales');
    }
};
