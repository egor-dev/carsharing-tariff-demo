<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStageTariffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stage_tariff', function (Blueprint $table) {
            $table->unsignedInteger('stage_id');
            $table->unsignedInteger('tariff_id');

            $table->decimal('cost_per_minute');
            $table->unsignedTinyInteger('free_period_since_hour')->nullable();
            $table->unsignedTinyInteger('free_period_till_hour')->nullable();
            $table->unsignedSmallInteger('free_minutes_at_start')->nullable();
            $table->decimal('cost_per_kilometer')->nullable();
            $table->unsignedSmallInteger('free_kilometers_per_day')->nullable();
            $table->unsignedTinyInteger('car_class_id');
            $table->unsignedTinyInteger('user_group_id');

            $table->foreign('stage_id')->references('id')->on('stages');
            $table->foreign('tariff_id')->references('id')->on('tariffs');
            $table->foreign('car_class_id')->references('id')->on('car_classes');
            $table->foreign('user_group_id')->references('id')->on('user_groups');

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
        Schema::dropIfExists('stage_tariff_per_minute');
    }
}
