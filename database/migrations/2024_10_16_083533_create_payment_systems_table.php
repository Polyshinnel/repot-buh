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
        Schema::create('payment_systems', function (Blueprint $table) {
            $table->id();
            $table->string('payment_name');
            $table->timestamps();
        });

        $data_items = [
            [
                'payment_name' => 'Yookassa'
            ]
        ];
        foreach ($data_items as $item) {
            DB::table('payment_systems')->insert($item);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_systems');
    }
};
