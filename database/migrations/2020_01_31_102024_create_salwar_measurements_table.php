<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalwarMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salwar_measurements', function (Blueprint $table) {
            $table->bigIncrements('salwar_measurement_id');
            $table->string('salwar_measurement_titles')->nullable();
            $table->float('salwar_measurement_price')->nullable();
            $table->text('salwar_measurement_chart')->nullable();
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
        Schema::dropIfExists('salwar_measurements');
    }
}
