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
            $table -> string('full_name');
            $table -> string('shipping_address');
            $table -> bigInteger('total_order_value');
            $table -> enum('order_status', [0, 1, 2]) -> default(0);
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
