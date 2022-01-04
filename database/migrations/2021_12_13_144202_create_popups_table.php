<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popups', function (Blueprint $table) {
            $table->id();
            $table->string('type_show');
            $table->string('image')->nullable();
            $table->text('text')->nullable();
            $table->enum('type',['vendor','category']);
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('categoty_id')->nullable();
            $table->enum('show_as',['home','category']);
            $table->enum('show_for',['piad','trial','free','all']);
            $table->enum('num_show',['ones','every_time','hour']);
            $table->integer('number_of_hour')->nullable();

            $table->date('start_date');
            $table->date('end_date');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->foreign('categoty_id')->references('id')->on('categories')->onDelete('cascade');



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
        Schema::dropIfExists('popups');
    }
}
