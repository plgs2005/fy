<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'users_categories', function (Blueprint $table) {
                $table->integer('user_id')->unsigned();
                $table->integer('category_id')->unsigned();

                //FOREIGN KEY CONSTRAINTS
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

                //SETTING THE PRIMARY KEYS
                $table->primary(['user_id','category_id']);
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
        Schema::dropIfExists('users_categories');
    }
}
