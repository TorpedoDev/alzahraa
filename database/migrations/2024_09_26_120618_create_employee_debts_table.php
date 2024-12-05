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
        Schema::create('employee_debts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->on('employees');
            $table->foreignId('user_id')->constrained()->on('users');
            $table->double('value');
            $table->double('paid')->nullable()->default(0);
            $table->double('rest')->nullable()->default(0);
            $table->date('date');
            $table->boolean('is_paid')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_debts');
    }
};
