<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_medias', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('social_media');
            $table->string('handler')->nullable();
            $table->string('media_user_id')->unique();
            $table->string('media_username')->nullable();
            $table->string('profile_picture_url', 500)->nullable();
            $table->string('token');
            $table->boolean('token_valid')->default(1);
            $table->string('url')->nullable();
            $table->string('impressions')->nullable();
            $table->string('avgImpressions')->nullable();
            $table->string('reach')->nullable();
            $table->string('avgReach')->nullable();
            $table->string('avgEngagement')->nullable();
            $table->string('avgEngagementPercent')->nullable();
            $table->integer('postQuant')->nullable();
            $table->integer('followers')->nullable();
            $table->boolean('active')->nullable();
            $table->string('page_name')->nullable();
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
        Schema::dropIfExists('social_medias');
    }
}
