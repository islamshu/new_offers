<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->enum('gender',['male','female']);
            $table->string('nationality')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('city_id');
            $table->enum('type_of_subscribe',['paid','unpiad','trial']);
            $table->bigInteger('number_of_operations')->default(0);
            $table->timestamp('date_of_register')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->integer('otp')->nullable();
            $table->text('token')->nullable();
            $table->text('register_mobile')->nullable();
            $table->string('mobile_type')->nullable();
            $table->string('language')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default('active');
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
        Schema::dropIfExists('clinets');
    }
}
