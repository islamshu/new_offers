<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('desc_en');
            $table->string('desc_ar');
            $table->string('uuid');
            $table->string('owner_name');
            $table->bigInteger('commercial_registration_number');
            $table->bigInteger('telephoone');
            $table->bigInteger('mobile');
            $table->string('address');
            $table->enum('status', ['active', 'deactive']);
            $table->enum('vat_type', ['value ', 'percentage']);
            $table->integer('vat');
            $table->string('image');
            $table->string('cover_image');
            $table->unsignedBigInteger('enterprise_id');
            $table->foreign('enterprise_id')->references('id')->on('enterprises')->onDelete('cascade');
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
        Schema::dropIfExists('brands');
    }
}
