<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_option', function (Blueprint $table) {
            $table->unsignedInteger('car_id');
            $table->unsignedInteger('option_id');
            $table->timestamps();

            $table->foreign('car_id')->references('id')->on('cars');
            $table->foreign('option_id')->references('id')->on('options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option_tariff');
    }
}
