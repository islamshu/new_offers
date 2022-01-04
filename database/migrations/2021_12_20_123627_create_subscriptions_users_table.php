<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions_users', function (Blueprint $table) {
            $table->id();
            $table->enum('payment_type',['cash','visa']);
            $table->date('expire_date');
            $table->enum('status',['active','deactive']);
            $table->integer('balnce');
            $table->bigInteger('purchases_no')->nullable();
            $table->unsignedBigInteger('sub_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sub_id')->references('id')->on('subscriptions')->onDelete('cascade');
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
        Schema::dropIfExists('subscriptions__users');
    }
}
