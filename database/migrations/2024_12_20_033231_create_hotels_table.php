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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('tax_id')->unique();
            $table->string('city');
            $table->string('address');
            $table->string('nit')->unique();
            $table->integer('max_rooms');
            $table->timestamps();
        });

        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['Estándar', 'Junior', 'Suite']);
            $table->enum('accommodation', ['Sencilla', 'Doble', 'Triple', 'Cuádruple']);
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        public function down()
    {
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('hotels');
    }
    }
};
