<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('columns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20);
            $table->string('description')->nullable();
            $table->string('color', 6)->nullable();
            $table->integer('position')->default(0);
            $table->integer('created_by')->unsigned();
            $table->integer('board_id')->unsigned();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('board_id')->references('id')->on('boards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('columns');
    }
}
