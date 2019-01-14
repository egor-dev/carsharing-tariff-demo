<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentStageLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_stage_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rent_id');
            $table->unsignedInteger('stage_id')->comment('Новый этап поездки');
            $table->timestamps();

            $table->foreign('rent_id')->references('id')->on('rents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_logs');
    }
}
