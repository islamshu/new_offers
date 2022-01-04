<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->text('desc_ar');
            $table->text('desc_en');
            $table->text('terms_ar');
            $table->text('terms_en');
            $table->enum('member_type', ['free', 'paid', 'all']);
            $table->enum('usege_member', ['limit', 'unlimit']);
            $table->integer('usage_member_number');
            $table->enum('usege_system', ['limit', 'unlimit']);
            $table->integer('usage_number_system');
            $table->enum('datetime_use', ['active', 'deactive']);
            $table->enum('datatime_use_type', ['days', 'hours']);
            $table->integer('datatime_number');
            $table->enum('systemCoupon_use', ['active', 'deactive']);
            $table->integer('count_systemCoupon_use');
            $table->integer('points');
            $table->enum('exchange_points', ['active', 'deactive']);
            $table->integer('exchange_points_number');
            $table->enum('exchange_cash', ['active', 'deactive']);
            $table->integer('exchange_cash_number');
            $table->enum('payment_type', ['cash', 'visa']);
            $table->integer('sort');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('offer_type');
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('enterprises_id')->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->foreign('enterprises_id')->references('id')->on('enterprises')->onDelete('cascade');

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
        Schema::dropIfExists('offers');
    }
}
