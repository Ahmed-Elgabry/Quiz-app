<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToUserQuizzess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_quizzes', function (Blueprint $table) {
            //
            $table->string('slug')->unique()/* ->nullable() */;
            $table->boolean('hide_result_counter')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_quizzes', function (Blueprint $table) {
            //
        });
    }
}
