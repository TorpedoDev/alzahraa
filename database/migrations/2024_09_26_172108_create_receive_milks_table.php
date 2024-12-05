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
        Schema::create('receive_milks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->on('customers');
            $table->foreignId('user_id')->constrained()->on('users');
            $table->double("buffalo_milk_qty")->nullable()->default(0);
            $table->double("cow_milk_qty")->nullable()->default(0);
            $table->double("buffalo_pont")->nullable()->default(0);
            $table->double("cow_pont")->nullable()->default(0);
            $table->date("date");
            $table->enum("period" , ["am" , "pm"]);
            $table->boolean('is_paid')->default(0);
            $table->text("notes")->nullable();
            $table->double("price");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receive_milks');
    }
};
