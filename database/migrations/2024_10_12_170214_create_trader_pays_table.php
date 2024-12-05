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
        Schema::create('trader_pays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trader_id')->constrained()->on('traders');
            $table->foreignId('user_id')->constrained()->on('users');
            $table->double("value");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trader_pays');
    }
};
