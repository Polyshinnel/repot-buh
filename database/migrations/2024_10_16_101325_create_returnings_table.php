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
        Schema::create('returnings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('site_id');
            $table->string('payment_sum');
            $table->dateTime('payment_time');
            $table->string('order_id');
            $table->string('payment_order_id');
            $table->timestamps();

            $table->index('site_id', 'returnings_site_id_idx');
            $table->foreign('site_id', 'returnings_site_id_fk')
                ->on('sites')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returnings');
    }
};
