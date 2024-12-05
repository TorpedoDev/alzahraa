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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('address')->nullable();
            $table->string('phone')->nullable()->unique();
            $table->enum('line' , [1,2,3,4,5,6]);
            $table->enum('type' , ["pont" , "kilo" , "kilo_and_pont"]);
            $table->double('cow_pont_price')->nullable()->default(0);
            $table->double('buffalo_pont_price')->nullable()->default(0);
            $table->double('cow_kilo_price')->nullable()->default(0);
            $table->double('buffalo_kilo_price')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
