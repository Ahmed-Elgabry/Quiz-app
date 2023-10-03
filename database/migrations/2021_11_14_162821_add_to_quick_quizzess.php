<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToQuickQuizzess extends Migration
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
            $table->bigInteger('category')->unsigned()->nullable();
            $table->foreign('category')->references('id')->on('category_quizzes')->onDelete('set null');

            $table->boolean('is_featured')->default(false);
            $table->timestamp('featured_at')->useCurrent()->nullable();

            $table->enum('lang',['non','ar','en'])->default('non');
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
