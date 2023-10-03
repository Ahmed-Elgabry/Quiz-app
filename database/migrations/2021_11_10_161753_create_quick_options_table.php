<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuickOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quick_options', function (Blueprint $table) {
            $table->id();
            $table->string('option_text');
            $table->float('weight', 8, 2)->default(0);
            //question
            $table->bigInteger('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('quick_questions')->onDelete('cascade');

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
        Schema::dropIfExists('quick_options');
    }
}
