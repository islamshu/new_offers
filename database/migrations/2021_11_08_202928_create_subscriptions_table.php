<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->text('desc_ar');
            $table->text('desc_en');
            $table->text('terms_ar');
            $table->text('terms_en');
            $table->double('price');
            $table->integer('balance');
            $table->enum('expire_date_type', ['days', 'months','years']);
            $table->string('image');
            $table->enum('type', ['coupons', 'points'])->nullable();
            $table->enum('add_members', ['active', 'deactive']);
            $table->integer('number_of_members');
            $table->enum('type_paid',['trial','paid']);
            $table->integer('days_of_trial')->nullable();
            $table->integer('number_of_dayes');
            $table->unsignedBigInteger('brands_id')->nullable();
            $table->unsignedBigInteger('enterprises_id')->nullable();
            $table->string('sub_type')->nullable();
            $table->foreign('brands_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->foreign('enterprises_id')->references('id')->on('enterprises')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('subscriptions');
    }
}
