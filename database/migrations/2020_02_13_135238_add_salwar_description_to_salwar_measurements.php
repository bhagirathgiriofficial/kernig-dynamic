<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSalwarDescriptionToSalwarMeasurements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salwar_measurements', function (Blueprint $table) {
                $table->text('salwar_description')->after('salwar_measurement_chart')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salwar_measurements', function (Blueprint $table) {
            //
        });
    }
}
