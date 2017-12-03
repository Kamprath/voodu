<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueColumnName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('columns', function (Blueprint $table) {
            $table->index(['name', 'board_id'], 'column_title_board_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('columns', function (Blueprint $table) {
            $table->dropIndex('column_title_board_index');
        });
    }
}
