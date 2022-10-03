<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->unique();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('address');
            $table->string('number');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('country', 2);
            $table->string('po_box', 100)->nullable();
            $table->string('apartment', 100)->nullable();
            $table->string('apartment_unit', 100)->nullable();
            $table->string('formatted_address', 255)->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
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
        Schema::dropIfExists('addresses');
    }
}
