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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('site_id');
            $table->unsignedBigInteger('payment_id');
            $table->string('shop_id');
            $table->string('api_key');
            $table->timestamps();

            $table->index('site_id', 'settings_site_id_idx');
            $table->index('payment_id', 'settings_payment_id_idx');
            $table->foreign('site_id', 'settings_site_id_fk')
                ->on('sites')
                ->references('id');
            $table->foreign('payment_id', 'settings_payment_id_fk')
                ->on('payment_systems')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
