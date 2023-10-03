<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToQuickQuizzess2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quick_quizzes', function (Blueprint $table) {
            //
            $table->boolean('hide_result_counter')->default(false);
            $table->longtext('result_text')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quick_quizzes', function (Blueprint $table) {
            //
        });
    }
}
