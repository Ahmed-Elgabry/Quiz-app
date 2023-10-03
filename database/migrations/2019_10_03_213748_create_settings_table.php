<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sitename_ar')->default('المقياس');
            $table->string('sitename_en')->default('Almigias');
            $table->string('logo')->default('images/default3.png');
            $table->longtext('description_ar')->nullable();
            $table->longtext('description_en')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('facebook')->nullable()->default('https://www.facebook.com/Almiqias/posts/?ref=page_internal');
            $table->string('twitter')->nullable()->default('https://twitter.com/almiqias');
            $table->string('snapshat')->nullable()->default('https://www.snapchat.com/add/almiqias');
            $table->string('instagram')->nullable()->default('https://www.instagram.com/almiqias/');

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
        Schema::dropIfExists('settings');
    }
}
