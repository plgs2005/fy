<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'campaigns', function (Blueprint $table) {
                $table->id();
                $table->integer('brand_id')->unsigned();
                    $table->foreign('brand_id')->references('id')->on('user')
                        ->onDelete('cascade');
                $table->string('name')->nullable();
                $table->string('type')->nullable();
                $table->string('goal')->nullable();
                

                $table->integer('audience_id')->unsigned()->nullable();
                    $table->foreign('audience_id')->references('id')->on('audience')
                        ->onDelete('cascade');
                
                $table->boolean('social_platform_instagram')->nullable();
                $table->boolean('social_platform_facebook')->nullable();
                $table->string('format')->nullable();
                $table->boolean('format_type_feed')->nullable();
                $table->boolean('format_type_story')->nullable();
                $table->string('style')->nullable();
                $table->string('goal_description')->nullable();
                $table->string('goal_images')->nullable();
                $table->boolean('physical_product')->nullable();
                $table->boolean('digital_product')->nullable();
                $table->boolean('service')->nullable();
                $table->string('product_description')->nullable();
                $table->string('product_images')->nullable();
                $table->string('url')->nullable();
                $table->string('instructions')->nullable();
                $table->string('instruction_images')->nullable();

                $table->string('budget');
                $table->timestamp('datetime')->nullable();

                $table->boolean('different_influencers')->nullable();
                $table->boolean('manual_select_influencers')->nullable();

                $table->string('checkout_session')->nullable();
                $table->boolean('paid')->nullable();
                $table->integer('clickmeter_group_id')->nullable();
                $table->integer('clickmeter_conversion_id')->nullable();
                $table->boolean('partial')->default(0);
                $table->boolean('endedNotification')->default(0);
                
                $table->timestamps();
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
        Schema::dropIfExists('campaigns');
    }
}
