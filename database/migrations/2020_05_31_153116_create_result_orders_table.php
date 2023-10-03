<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->float('from', 8, 2);
            $table->float('to', 8, 2);

            $table->bigInteger('quiz_user_id')->unsigned()->nullable();
            $table->foreign('quiz_user_id')->references('id')->on('user_quizzes')->onDelete('cascade');

            $table->longtext('text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result_orders');
    }
}
