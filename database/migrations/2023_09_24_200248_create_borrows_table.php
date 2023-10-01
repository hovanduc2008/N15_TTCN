<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table -> id();
            $table -> unsignedBigInteger('user_id');
            $table -> unsignedBigInteger('product_id');
            $table -> datetime('borrow_date');
            $table -> datetime('return_date');
            $table -> datetime('actual_return_date') -> nullable();
            $table -> datetime('deleted_at') -> nullable();
            $table -> timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrows');
    }
}
