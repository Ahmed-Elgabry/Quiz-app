<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');
            $table->longText('content');
            $table->string('image');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_arabic')->default(true);
            $table->enum('status',['P','A','R'])->default('P'); // ['قيد الإنتظار','تم الموافقة','مرفوض']

            $table->bigInteger('writer_id')->unsigned()->nullable();
            $table->foreign('writer_id')->references('id')->on('users')->onDelete('cascade');

            $table->softDeletes();
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
        Schema::dropIfExists('articles');
    }
}
