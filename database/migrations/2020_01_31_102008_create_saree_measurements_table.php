<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSareeMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saree_measurements', function (Blueprint $table) {
            $table->bigIncrements('saree_measurement_id');
            $table->string('saree_measurement_title',100)->unique();
            $table->float('saree_measurement_price');
            $table->unsignedBigInteger('saree_custom_id')->nullable();
            $table->foreign('saree_custom_id')->references('measurement_id')->on('measurements');
            $table->boolean('saree_measurement_status')->default(1)->comment('1 = Active , 0 = Inactive');
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
        Schema::dropIfExists('saree_measurements');
    }
}
