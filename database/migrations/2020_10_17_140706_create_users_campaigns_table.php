<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'users_campaigns', function (Blueprint $table) {
                $table->integer('user_id')->unsigned();
                $table->integer('campaign_id')->unsigned();
                $table->boolean('brand_accept')->nullable();
                $table->boolean('influencer_accept')->nullable();
                $table->string('influencer_decline_motive', 500)->nullable();
                $table->integer('score')->nullable();
                $table->integer('impressions')->nullable();
                $table->string('rating')->default(0);
                $table->integer('value')->nullable();
                $table->boolean('paid')->nullable();
                $table->boolean('influencer_complete')->nullable();
                $table->boolean('manual_add')->nullable();
                $table->integer('tracking_link_id')->nullable();
                $table->string('tracking_link_url')->nullable();
                $table->boolean('admin_accept')->nullable();
                $table->boolean('startingNotification')->default(0);
                $table->boolean('startedNotification')->default(0);
                $table->timestamps();

                //FOREIGN KEY CONSTRAINTS
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');

                //SETTING THE PRIMARY KEYS
                $table->primary(['user_id','campaign_id']);
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_campaigns');
    }
}
