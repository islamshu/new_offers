<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnterpriseNeighberhoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprise_neighberhoods', function (Blueprint $table) {
            $table->bigIncrements('id');
           $table->unsignedBigInteger('enterprise_id')->nullable();
            $table->foreign('enterprise_id')->references('id')->on('enterprises')->onDelete('cascade');

            $table->unsignedBigInteger('neighborhood_id')->nullable();
            $table->foreign('neighborhood_id')->references('id')->on('neighborhoods')->onDelete('cascade');
            $table->enum('status',['active','deactive']);
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
        Schema::dropIfExists('enterprise_neighberhoods');
    }
}
