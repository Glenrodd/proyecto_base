<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('type_campus_id');
            $table->integer('deparment_id');
            $table->integer('province_id');
            $table->string('address');
            $table->string('phones');
            $table->foreign('type_campus_id')->references('id')->on('types_campus');
            $table->foreign('deparment_id')->references('id')->on('deparments');
            $table->foreign('province_id')->references('id')->on('provinces');
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
        Schema::dropIfExists('campus');
    }
}
