<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameOffersColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function(Blueprint $table)
    {
        $table->integer('price')->nullable();
        $table->integer('price_befor_discount')->nullable();
        $table->integer('sale')->nullable();
        $table->integer('discount_value')->nullable();
        $table->enum('discount_type',['value','persantage'])->nullable();
        // $table->integer('sale');

    });
}
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
