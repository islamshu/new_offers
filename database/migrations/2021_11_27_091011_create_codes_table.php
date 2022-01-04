<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codes', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->enum('type',['single','multi']);
            $table->enum('type_code',['auto','manual']);
            $table->integer('number_of_code')->nullable();
            $table->integer('total_remain')->nullable();
            $table->enum('type_of_limit',['limit','unlimit']);
            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();


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
        Schema::dropIfExists('codes');
    }
}
