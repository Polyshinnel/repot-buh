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
        Schema::create('reciepts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('customer');
            $table->string('email');
            $table->string('phone');
            $table->decimal('amount');
            $table->decimal('refunded');
            $table->text('request');
            $table->text('response');
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reciepts');
    }
};
