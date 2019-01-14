<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentDistanceLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_distance_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rent_id');
            $table->decimal('distance');
            $table->date('date');
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
        Schema::dropIfExists('rent_distance');
    }
}
