<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            //home
            $table->longtext('Home1')->nullable();
            $table->longtext('Home2')->nullable();
            //quizzes
            $table->longtext('quizzes1')->nullable();
            $table->longtext('quizzes2')->nullable();
            //articles
            $table->longtext('articles1')->nullable();
            $table->longtext('articles2')->nullable();
            //view_article
            $table->longtext('view_article1')->nullable();
            $table->longtext('view_article2')->nullable();
            $table->longtext('view_article3')->nullable();
            //do_quiz
            $table->longtext('do_quiz1')->nullable();
            $table->longtext('do_quiz2')->nullable();
            //Quick Access
            $table->longtext('quick_access1')->nullable();
            $table->longtext('quick_access2')->nullable();
            //results_all
            $table->longtext('results1')->nullable();
            $table->longtext('results2')->nullable();
            //Sahre Quiz
            $table->longtext('share_quiz1')->nullable();
            $table->longtext('share_quiz2')->nullable();
            //about
            $table->longtext('about1')->nullable();
            //contact
            $table->longtext('contact1')->nullable();
            //guest_result
            $table->longtext('guest_result1')->nullable();
            $table->longtext('guest_result2')->nullable();

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
        Schema::dropIfExists('ads');
    }
}
