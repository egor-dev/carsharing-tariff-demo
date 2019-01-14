<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('car_class_id');
            $table->boolean('is_available')->default(false);
            $table->point('geom', 'GEOMETRY', 4326);
            $table->timestamps();

            $table->foreign('car_class_id')->references('id')->on('car_classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
