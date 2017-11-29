<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 65);
            $table->string('description')->nullable();
            $table->integer('position')->default(0);
            $table->integer('created_by')->unsigned();
            $table->integer('board_id')->unsigned();
            $table->integer('column_id')->unsigned();
            $table->integer('swimlane_id')->unsigned();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('board_id')->references('id')->on('boards');
            $table->foreign('column_id')->references('id')->on('columns');
            $table->foreign('swimlane_id')->references('id')->on('swimlanes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
