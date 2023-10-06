<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('added_by');
            $table -> string('name');
            $table -> text('biography') -> nullable();
            $table -> string('email') -> nullable();
            $table -> string('phone_number') -> nullable();
            $table -> string('address') -> nullable();
            $table -> enum('gender', ['male', 'female']) -> nullable();
            $table -> date('date_of_birth') -> nullable();
            $table -> string('image') -> default('');
            $table->string('thumbnail');
            $table->enum('status', [0, 1]) -> default(1);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('added_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authors');
    }
}
