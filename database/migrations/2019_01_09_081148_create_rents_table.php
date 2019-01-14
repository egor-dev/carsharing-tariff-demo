<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('car_id');
            $table->unsignedInteger('tariff_id');
            $table->unsignedInteger('stage_id')->comment('Текущий этап поездки');
            $table->timestamps();
            $table->timestamp('finished_at')->comment('Дата и время завершения аренды');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('car_id')->references('id')->on('cars');
            $table->foreign('tariff_id')->references('id')->on('tariffs');
            $table->foreign('stage_id')->references('id')->on('stages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rents');
    }
}
