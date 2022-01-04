<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('desc_ar');
            $table->string('desc_en');
            $table->string('tearm_ar');
            $table->string('tearm_en');
            $table->string('type');
            $table->string('value');
            $table->date('start_at');
            $table->date('end_at');
            $table->enum('special_days', ['active', 'deactive']);
            $table->enum('special_time', ['active', 'deactive']);
            $table->string('image');
            $table->text('days')->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
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
        Schema::dropIfExists('coupons');
    }
}
