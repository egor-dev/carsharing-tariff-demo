<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edges', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('graph_id');
            $table->unsignedInteger('source_node_id');
            $table->unsignedInteger('target_node_id');
            $table->timestamps();

            $table->foreign('graph_id')->references('id')->on('graphs');
            $table->foreign('source_node_id')->references('id')->on('nodes');
            $table->foreign('target_node_id')->references('id')->on('nodes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edges');
    }
}
