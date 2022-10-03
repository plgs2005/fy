<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->id();

            $table->integer('social_media_id')->unsigned();
            $table->foreign('social_media_id')->references('id')->on('social_medias')
                ->onDelete('cascade');
            $table->integer('campaign_id')->unsigned()->nullable();
            $table->foreign('campaign_id')->references('id')->on('campaign')
                ->onDelete('cascade');
            $table->string('post_id')->unique();
            $table->string('timestamp');
            $table->string('permalink');
            $table->string('type');
            $table->string('media_type')->nullable();
            $table->text('media_url')->nullable();
            $table->text('caption')->nullable();
            $table->text('hashtags')->nullable();
            $table->integer('like_count')->nullable();
            $table->integer('comments_count')->nullable();
            $table->text('status');//->default('update_1min');

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
        Schema::dropIfExists('post');
    }
}
