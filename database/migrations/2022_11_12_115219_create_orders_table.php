<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('exchange_rate');
            $table->float('surcharge_percentage');
            $table->float('surcharge_amount');
            $table->float('amount_purchased');
            $table->float('amount_paid');
            $table->float('discount_percentage')->nullable();
            $table->float('discount_amount')->nullable();

            $table->string('currency_code');
            $table->foreign('currency_code')
                ->references('code')
                ->on('currencies')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
