<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserQuizOptiosOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_quiz_optios_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            //quiz
            $table->bigInteger('quiz_id')->unsigned();
            $table->foreign('quiz_id')->references('id')->on('user_quizzes')->onDelete('cascade');

            $table->integer('op1');
            $table->integer('op2');
            $table->integer('op3');
            $table->integer('op4');

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
        Schema::dropIfExists('user_quiz_optios_orders');
    }
}
