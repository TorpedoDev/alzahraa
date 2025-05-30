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
        Schema::create('deficiency_milks', function (Blueprint $table) {
            $table->id();
            $table->string('driver');
            $table->double('value');
            $table->enum('type' , ['buff' , 'cow']);
            $table->date('date');
            $table->foreignId('user_id')->constrained()->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deficiency_milks');
    }
};
