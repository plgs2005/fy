<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable();
            $table->date('birth')->nullable();
            $table->string('password')->nullable();
            $table->string('stripe_subscription_id')->nullable();
            $table->string('stripe_cus_id')->nullable();
            $table->string('stripe_acc')->nullable();
            $table->boolean('stripe_onboarding_complete')->default(0)->nullable();
            $table->string('checkout_session')->nullable();
            $table->integer('referrer')->unsigned()->nullable();
            $table->foreign('referrer')->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('avatarImg')->nullable();
            $table->string('brand_logo')->nullable();
            $table->string('clickmeter_tag')->nullable();
            $table->boolean('profile_completed')->default(0);
            $table->enum('active', ['Y', 'N'])->default('Y');
            $table->enum('receive_products', ['Y', 'N'])->default('N');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
