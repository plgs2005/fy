<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audiences', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->unsigned();
                $table->foreign('category_id')->references('id')->on('category')
                    ->onDelete('cascade');
            $table->integer('brand_id')->unsigned();
                $table->foreign('brand_id')->references('id')->on('user')
                    ->onDelete('cascade');
            $table->string('influencer_size');
            $table->string('audience_gender');
            $table->string('audience_age');
            $table->string('audience_location');
            $table->string('audience_language');
            $table->string('audience_name');

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
        Schema::dropIfExists('audiences');
    }
}
