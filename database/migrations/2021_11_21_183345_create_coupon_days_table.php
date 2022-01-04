<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_days', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->time('from_0');
            $table->time('from_1');
            $table->time('from_2');
            $table->time('from_3');
            $table->time('from_4');
            $table->time('from_5');
            $table->time('from_6');
            $table->time('to_0');
            $table->time('to_1');
            $table->time('to_2');
            $table->time('to_3');
            $table->time('to_4');
            $table->time('to_5');
            $table->time('to_6');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
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
        Schema::dropIfExists('coupon_days');
    }
}
