<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuickQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quick_quizzes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('quiz_name');
            $table->string('slug')->unique();
            $table->integer('grade')->default(0);
            $table->string('owner_name');
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
        Schema::dropIfExists('quick_quizzes');
    }
}
