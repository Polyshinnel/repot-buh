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
        Schema::create('reciept_purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reciept_id');
            $table->string('name');
            $table->string('sku');
            $table->integer('quantity');
            $table->decimal('price');
            $table->decimal('amount');
            $table->decimal('refunded');
            $table->integer('vat');
            $table->timestamps();

            $table->foreign('reciept_id')->references('id')->on('reciepts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reciept_purchases');
    }
};
