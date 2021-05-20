<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModiftyTopsalwarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('top_salwar_measurements', function (Blueprint $table) {
            $table->unsignedBigInteger('salwar_measurement_id')->after('top_id');
            $table->foreign('salwar_measurement_id')->references('salwar_measurement_id')->on('salwar_measurements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
