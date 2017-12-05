<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeSwimlaneNameNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('swimlanes', function (Blueprint $table) {
            $table->string('name', 50)->nullable()->change();
            $table->boolean('is_default')->default(true)->after('position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('swimlanes', function (Blueprint $table) {
            $table->string('name', 50)->change();
            $table->dropColumn('is_default');
        });
    }
}
