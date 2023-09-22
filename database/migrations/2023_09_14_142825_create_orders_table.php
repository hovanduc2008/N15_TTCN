<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table -> id();
            $table -> unsignedBigInteger('user_id');
            $table -> string('order_title');
            $table -> string('shipping_address');
            $table -> bigInteger('total_amount');
            $table -> string('payment_method');
            $table -> enum('payment_status', [0, 1]) -> default(0);
            $table -> enum('order_status', [0, 1, 2]) -> default(0);
            $table -> string('order_code');
            $table -> string('order_note');
            $table -> datetime('successfully_delivery_at');
            $table -> datetime('deleted_at');
            $table -> timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
}
